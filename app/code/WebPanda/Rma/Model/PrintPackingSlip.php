<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Directory\Model\CountryFactory;
use Magento\Directory\Model\RegionFactory;
use WebPanda\Rma\Helper\Config as RmaConfigHelper;

/**
 * Class PrintPackingSlip
 * @package WebPanda\Rma\Model
 */
class PrintPackingSlip
{
    const CHARSET = 'UTF-8';

    const X_OFFSET = 25;

    const BOTTOM_OFFSET = 25;

    const COLUMN_WIDTH = 300;

    const ITEMS_TABLE_OFFSET = 0;

    /**
     * @var int
     */
    protected $y;

    /**
     * @var \Zend_Pdf
     */
    protected $pdf;

    /**
     * @var \Zend_Pdf_Page
     */
    protected $page;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $mediaDirectory;

    /**
     * @var Filesystem\Directory\ReadInterface
     */
    protected $rootDirectory;

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * @var CountryFactory
     */
    protected $countryFactory;

    /**
     * @var RegionFactory
     */
    protected $regionFactory;

    /**
     * @var RmaConfigHelper
     */
    protected $configHelper;

    /**
     * PrintPackingSlip constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param Filesystem $filesystem
     * @param TimezoneInterface $localeDate
     * @param CountryFactory $countryFactory
     * @param RegionFactory $regionFactory
     * @param RmaConfigHelper $configHelper
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Filesystem $filesystem,
        TimezoneInterface $localeDate,
        CountryFactory $countryFactory,
        RegionFactory $regionFactory,
        RmaConfigHelper $configHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->rootDirectory = $filesystem->getDirectoryRead(DirectoryList::ROOT);
        $this->localeDate = $localeDate;
        $this->countryFactory = $countryFactory;
        $this->regionFactory = $regionFactory;
        $this->configHelper = $configHelper;
    }

    /**
     * @param $rma
     * @return string
     */
    public function getPdf($rma)
    {
        $this->pdf = new \Zend_Pdf();
        $this->y = 800;
        $this->page = $this->pdf->newPage(\Zend_Pdf_Page::SIZE_A4);

        $this->insertLogo($this->page)
            ->insertTitle(__('Return #%1', $rma->getIncrementId()));



        $y = $this->y;
        $this->insertDetails($rma);
        $yDetails = $this->y;
        $this->y = $y;
        $this->insertAddress($rma->getPackingSlip());
        $yAddress = $this->y;
        $this->y = min($yDetails, $yAddress);

        $this->insertItems($rma->getItemsCollection(), $rma->getStoreId());

        $this->pdf->pages[] = $this->page;
        return $this->pdf->render();
    }

    /**
     * @param $value
     */
    protected function deltaY($value)
    {
        $this->y -= $value;
        if ($this->y < self::BOTTOM_OFFSET) {
            $font = $this->page->getFont();
            $fontSize = $this->page->getFontSize();
            $this->pdf->pages[] = $this->page;
            $this->y = 800;
            $this->page = $this->pdf->newPage(\Zend_Pdf_Page::SIZE_A4);
            $this->page->setFont($font, $fontSize);
        }
    }

    /**
     * @param $text
     * @param $x
     * @param string $charset
     * @param null $blockLen
     * @param int $yStep
     */
    protected function drawText($text, $x, $charset = '', $blockLen = null, $yStep = 10)
    {
        if (!$blockLen) {
            $this->page->drawText($text, $x, $this->y, self::CHARSET);
        } else {
            $text = wordwrap($text, $blockLen, "\n");
            $count = 0;
            $lines = explode("\n", $text);
            foreach ($lines as $line) {
                $this->page->drawText($line, $x, $this->y, $charset);
                if (++$count < count($lines)) {
                    $this->deltaY($yStep);
                }
            }
        }
    }

    /**
     * Insert logo to pdf page
     *
     * @param \Zend_Pdf_Page &$page
     * @param null $store
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function insertLogo(&$page, $store = null)
    {
        $this->y = $this->y ? $this->y : 815;
        $image = $this->scopeConfig->getValue(
            'sales/identity/logo',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
        if ($image) {
            $imagePath = '/sales/store/logo/' . $image;
            if ($this->mediaDirectory->isFile($imagePath)) {
                $image = \Zend_Pdf_Image::imageWithPath($this->mediaDirectory->getAbsolutePath($imagePath));
                $top = 830;
                //top border of the page
                $widthLimit = 270;
                //half of the page width
                $heightLimit = 270;
                //assuming the image is not a "skyscraper"
                $width = $image->getPixelWidth();
                $height = $image->getPixelHeight();

                //preserving aspect ratio (proportions)
                $ratio = $width / $height;
                if ($ratio > 1 && $width > $widthLimit) {
                    $width = $widthLimit;
                    $height = $width / $ratio;
                } elseif ($ratio < 1 && $height > $heightLimit) {
                    $height = $heightLimit;
                    $width = $height * $ratio;
                } elseif ($ratio == 1 && $height > $heightLimit) {
                    $height = $heightLimit;
                    $width = $widthLimit;
                }

                $y1 = $top - $height;
                $y2 = $top;
                $x1 = 25;
                $x2 = $x1 + $width;

                //coordinates after transformation are rounded by Zend
                $page->drawImage($image, $x1, $y1, $x2, $y2);

                $this->y = $y1 - 10;
            }
        }

        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    protected function insertTitle($text)
    {
        $this->deltaY(20);
        $this->setFontRegular(18);
        $this->drawText((string)$text, self::X_OFFSET, self::CHARSET);
        $this->deltaY(15);

        return $this;
    }

    /**
     * @param $rma
     * @return $this
     */
    protected function insertDetails($rma)
    {
        $textBlockLen = 100;
        $this->page->setLineWidth(0.25);
        $this->page->drawLine(self::X_OFFSET, $this->y, 550, $this->y);
        $this->deltaY(25);

        $this->setFontRegular(18);
        $this->drawText((string)__('Details'), self::X_OFFSET, self::CHARSET, 60);
        $this->deltaY(20);

        $this->setFontBold(12);
        $this->drawText((string)__('ID') . ':', self::X_OFFSET, self::CHARSET, $textBlockLen);
        $this->setFontRegular(12);
        $this->drawText(
            '#' . $rma->getIncrementId(),
            self::X_OFFSET + 80, self::CHARSET, $textBlockLen
        );
        $this->deltaY(14);
        $this->setFontBold(12);
        $this->drawText((string)__('Order ID') . ':', self::X_OFFSET, self::CHARSET, 60);
        $this->setFontRegular(12);
        $this->drawText(
            '#' . $rma->getOrder()->getIncrementId(),
            self::X_OFFSET + 80, self::CHARSET, $textBlockLen
        );
        $this->deltaY(14);
        $this->setFontBold(12);
        $this->drawText((string)__('Name') . ':', self::X_OFFSET, self::CHARSET, 60);
        $this->setFontRegular(12);
        $this->drawMultiLineText(
            $rma->getFinalCustomerName(),
            self::X_OFFSET + 80, 0, $textBlockLen
        );
        $this->deltaY(14);
        $this->setFontBold(12);
        $this->drawText((string)__('Email') . ':', self::X_OFFSET, self::CHARSET, 60);
        $this->setFontRegular(12);
        $this->drawText(
            $rma->getFinalCustomerEmail(),
            self::X_OFFSET + 80, self::CHARSET, $textBlockLen
        );

        $this->deltaY(14);

        return $this;
    }

    /**
     * @param array $addressData
     * @return $this
     */
    protected function insertAddress($addressData)
    {
        $textBlockLen = 50;
        $this->deltaY(25);

        $this->setFontRegular(18);
        $this->drawText((string)__('Return address'), self::X_OFFSET + self::COLUMN_WIDTH, self::CHARSET, $textBlockLen);
        $this->deltaY(20);

        $this->setFontRegular(12);
        $this->drawMultiLineText(
            sprintf("%s %s", $addressData['firstname'], $addressData['lastname']),
            self::X_OFFSET + self::COLUMN_WIDTH, 0, $textBlockLen
        );
        if (strlen($addressData['company']) > 0) {
            $this->deltaY(14);
            $this->drawMultiLineText(
                str_replace('\n', ' ', $addressData['company']),
                self::X_OFFSET + self::COLUMN_WIDTH, 0, $textBlockLen
            );
        }
        $this->deltaY(14);
        $this->drawMultiLineText(
            str_replace('\n', ' ', $addressData['street']),
            self::X_OFFSET + self::COLUMN_WIDTH, 0, $textBlockLen
        );
        $this->deltaY(14);
        $this->drawMultiLineText(
            sprintf("%s, %s, %s", $addressData['city'], $this->getRegionName($addressData), $addressData['postcode']),
            self::X_OFFSET + self::COLUMN_WIDTH, 0, $textBlockLen
        );
        $this->deltaY(14);
        $this->drawText(
            $this->getCountryName($addressData),
            self::X_OFFSET + self::COLUMN_WIDTH, self::CHARSET, $textBlockLen
        );
        $this->deltaY(14);
        $this->drawText($addressData['telephone'], self::X_OFFSET + self::COLUMN_WIDTH, self::CHARSET, $textBlockLen);

        return $this;
    }

    /**
     * @param $itemsCollection
     * @param $storeId
     * @return $this
     */
    protected function insertItems($itemsCollection, $storeId)
    {
        $this->deltaY(24);
        $this->setFontRegular(18);
        $this->drawText((string)__('Items to return'), self::X_OFFSET, self::CHARSET);
        $this->deltaY(24);

        $this->setFontBold(12);
        $columns = [
            'name' => ['caption' => 'Product Name', 'width' => 330],
            'sku' => ['caption' => 'SKU', 'width' => 130],
            'qty' => ['caption' => 'Qty', 'width' => 60],
        ];

        $offset = self::X_OFFSET + self::ITEMS_TABLE_OFFSET;
        foreach ($columns as $column) {
            $this->drawText((string)__($column['caption']), $offset, self::CHARSET, $column['width']);
            $offset += $column['width'];
        }

        $this->setFontRegular(12);
        $this->deltaY(10);
        $this->page->setLineWidth(0.1);
        $this->page->drawLine(self::X_OFFSET, $this->y, 540, $this->y);
        $this->deltaY(10);

        foreach ($itemsCollection as $item) {
            $this->deltaY(10);
            $offset = self::X_OFFSET + self::ITEMS_TABLE_OFFSET;
            $this->setFontRegular(11);
            foreach ($columns as $fieldName => $column) {
                $this->drawText($item->getData($fieldName), $offset, self::CHARSET, $column['width']);
                $offset += $column['width'];
            }
            $this->deltaY(15);

            $itemAttributesLwn = 80;
            $offset = self::X_OFFSET + self::ITEMS_TABLE_OFFSET + 10;
            $this->setFontBold(11);
            $this->drawText($this->configHelper->getReasonFrontendLabel() . ':', $offset, self::CHARSET, $itemAttributesLwn);
            $this->deltaY(12);
            $this->setFontRegular(11);
            $this->drawMultiLineText($item->getFinalReason(), $offset + 10, 12, $itemAttributesLwn);

            $this->setFontBold(11);
            $this->drawText($this->configHelper->getItemConditionFrontendLabel() . ':', $offset, self::CHARSET, $itemAttributesLwn);
            $this->deltaY(12);
            $this->setFontRegular(11);
            $this->drawMultiLineText($item->getFinalItemCondition(), $offset + 10, 12, $itemAttributesLwn);

            $this->setFontBold(11);
            $this->drawText($this->configHelper->getResolutionFrontendLabel() . ':', $offset, self::CHARSET, $itemAttributesLwn);
            $this->deltaY(12);
            $this->setFontRegular(11);
            $this->drawMultiLineText($item->getFinalResolution(), $offset + 10, 12, $itemAttributesLwn);

            $this->page->drawLine(self::X_OFFSET, $this->y, 540, $this->y);
            $this->deltaY(10);
            $this->setFontRegular(12);
        }

        return $this;
    }

    /**
     * @param  int $size
     * @return \Zend_Pdf_Resource_Font
     */
    protected function setFontRegular($size = 7)
    {
        $font = \Zend_Pdf_Font::fontWithPath(
            $this->rootDirectory->getAbsolutePath('lib/internal/GnuFreeFont/FreeSerif.ttf')
        );
        $this->page->setFont($font, $size);
        return $font;
    }

    /**
     * @param  int $size
     * @return \Zend_Pdf_Resource_Font
     */
    protected function setFontBold($size = 7)
    {
        $font = \Zend_Pdf_Font::fontWithPath(
            $this->rootDirectory->getAbsolutePath('lib/internal/GnuFreeFont/FreeSerifBold.ttf')
        );
        $this->page->setFont($font, $size);
        return $font;
    }

    /**
     * @param $text
     * @param $offset
     * @param $deltaY
     * @param null $blockLen
     */
    protected function drawMultiLineText($text, $offset, $deltaY, $blockLen = null)
    {
        foreach (explode("\r\n", $text) as $str) {
            $this->drawText(strip_tags(ltrim($str)), $offset, self::CHARSET, $blockLen);
            $this->deltaY($deltaY);
        }
    }

    /**
     * @param array $addressData
     * @return string
     */
    protected function getRegionName($addressData)
    {
        if (isset($addressData['region_id'])) {
            $region = $this->regionFactory->create()
                ->load($addressData['region_id']);

            if ($region->getId()) {
                return $region->getName();
            }
        }

        return isset($addressData['region']) ? $addressData['region'] : '';
    }

    /**
     * @param $addressData
     * @return string
     */
    protected function getCountryName($addressData)
    {
        if (isset($addressData['country_id'])) {
            $country = $this->countryFactory->create()
                ->load($addressData['country_id']);

            if ($country->getId()) {
                return $country->getName();
            }
        }

        return '';
    }
}
