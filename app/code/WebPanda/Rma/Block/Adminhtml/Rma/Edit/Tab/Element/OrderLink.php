<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element;

/**
 * Class OrderLink
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element
 */
class OrderLink extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $localeDate;

    /**
     * OrderLink constructor.
     * @param \Magento\Framework\Data\Form\Element\Factory $factoryElement
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate
     */
    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Magento\Framework\Escaper $escaper,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->orderFactory = $orderFactory;
        $this->url = $url;
        $this->localeDate = $localeDate;
    }

    /**
     * Retrieve Element HTML
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = $this->getBold() ? '<div class="control-value special">' : '<div class="control-value">';
        $html .= $this->getOrderLink() . '</div>';
        $html .= $this->getAfterElementHtml();
        return $html;
    }

    protected function getOrderLink()
    {
        $order = $this->orderFactory->create()->load($this->getValue());

        if ($order->getId()) {
            $link = $this->url->getUrl(
                'sales/order/view',
                ['order_id' => $order->getId()]
            );
            return '<a href="' . $link . '" target="_blank">#' . $order->getIncrementId() . '</a>' .
                ' (' . $this->formatDate($this->localeDate->date(new \DateTime($order->getCreatedAt())), 2, true) . ')';
        } else {
            return __('Order does not exist');
        }
    }

    /**
     * Retrieve formatting date
     *
     * @param null|string|\DateTimeInterface $date
     * @param int $format
     * @param bool $showTime
     * @param null|string $timezone
     * @return string
     */
    public function formatDate(
        $date = null,
        $format = \IntlDateFormatter::LONG,
        $showTime = false,
        $timezone = null
    ) {
        $date = $date instanceof \DateTimeInterface ? $date : new \DateTime($date);
        return $this->localeDate->formatDateTime(
            $date,
            $format,
            $showTime ? $format : \IntlDateFormatter::NONE,
            null,
            $timezone
        );
    }
}
