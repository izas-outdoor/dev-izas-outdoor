<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Customer\Rma\View;

use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Registry;
use WebPanda\Rma\Helper\Config;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Catalog\Block\Product\ImageBuilder;
use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use Magento\Directory\Helper\Data as DirectoryHelper;

/**
 * Class Contact
 * @package WebPanda\Rma\Block\Customer\Rma\View
 */
class Contact extends \WebPanda\Rma\Block\Customer\Rma\View
{
    /**
     * @var DirectoryHelper
     */
    protected $directoryHelper;

    /**
     * @var CountryInformationAcquirerInterface
     */
    protected $countryInformation;

    /**
     * @var CountryCollectionFactory
     */
    protected $countryCollectionFactory;

    /**
     * @var null|array
     */
    protected $packingSlip = null;

    /**
     * @var null|array
     */
    protected $countryOptions = null;

    /**
     * Contact constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param CustomerSession $customerSession
     * @param ProductFactory $productFactory
     * @param Config $configHelper
     * @param BlockRepositoryInterface $blockRepository
     * @param ImageBuilder $imageBuilder
     * @param DirectoryHelper $directoryHelper
     * @param CountryInformationAcquirerInterface $countryInformation
     * @param CountryCollectionFactory $countryCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        CustomerSession $customerSession,
        ProductFactory $productFactory,
        Config $configHelper,
        BlockRepositoryInterface $blockRepository,
        ImageBuilder $imageBuilder,
        DirectoryHelper $directoryHelper,
        CountryInformationAcquirerInterface $countryInformation,
        CountryCollectionFactory $countryCollectionFactory,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $coreRegistry,
            $customerSession,
            $productFactory,
            $configHelper,
            $blockRepository,
            $imageBuilder,
            $data
        );
        $this->coreRegistry = $coreRegistry;
        $this->customerSession = $customerSession;
        $this->productFactory = $productFactory;
        $this->configHelper = $configHelper;
        $this->directoryHelper = $directoryHelper;
        $this->countryInformation = $countryInformation;
        $this->countryCollectionFactory = $countryCollectionFactory;
    }

    /**
     * @return array|null
     */
    public function getPackingSlip()
    {
        if ($this->packingSlip === null) {
            $this->packingSlip = $this->getRmaModel()->getPackingSlip();
            $this->packingSlip['street'] = explode('\n', $this->packingSlip['street']);
        }

        return $this->packingSlip;
    }

    /**
     * @return string
     */
    public function getAddressJsData()
    {
        $packingSlip = $this->getPackingSlip();

        return \Zend_Json::encode([
            'rma_id' => $this->getRmaModel()->getId(),
            'firstname' => $packingSlip['firstname'],
            'lastname' => $packingSlip['lastname'],
            'company' => $packingSlip['company'],
            'street' => $packingSlip['street'],
            'city' => $packingSlip['city'],
            'region_id' => $packingSlip['region_id'],
            'region' => $packingSlip['region'],
            'country_id' => $packingSlip['country_id'],
            'postcode' => $packingSlip['postcode'],
            'telephone' => $packingSlip['telephone'],
            'country_options' => $this->getCountryOptions()
        ]);
    }

    /**
     * @param $countryId
     * @return string
     */
    public function getCountryName($countryId)
    {
        return $this->countryInformation->getCountryInfo($countryId)->getFullNameLocale();
    }

    /**
     * @return array
     */
    protected function getCountryOptions()
    {
        if ($this->countryOptions === null) {
            $this->countryOptions = $this->countryCollectionFactory->create()->loadByStore()
                ->setForegroundCountries($this->getTopDestinations())
                ->toOptionArray();
        }

        return $this->countryOptions;
    }

    /**
     * @return bool
     */
    public function isOptionalRegionAllowed()
    {
        return $this->_scopeConfig->getValue(
            'general/region/display_all',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array
     */
    protected function getTopDestinations()
    {
        $destinations = (string)$this->_scopeConfig->getValue(
            'general/country/destinations',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return !empty($destinations) ? explode(',', $destinations) : [];
    }

    /**
     * @return string
     */
    public function getRegionJson()
    {
        return $this->directoryHelper->getRegionJson();
    }

    /**
     * @return array|string
     */
    public function getCountriesWithOptionalZip()
    {
        return $this->directoryHelper->getCountriesWithOptionalZip(true);
    }

    /**
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->getUrl('*/*/saveContact');
    }
}
