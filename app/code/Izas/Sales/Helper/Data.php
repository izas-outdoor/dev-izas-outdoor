<?php
namespace Izas\Sales\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use \Magento\Sales\Model\Order\ItemRepository;
use \Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * Class Data
 * @package Izas\Sales\Helper
 */
class Data extends AbstractHelper
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * Data constructor.
     * @param Context $context
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ItemRepository $itemRepository
     * @param PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ItemRepository $itemRepository,
        PriceCurrencyInterface $priceCurrency
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->itemRepository = $itemRepository;
        $this->priceCurrency = $priceCurrency;
        parent::__construct($context);
    }


    /**
     * @param $orderId
     * @return \Magento\Sales\Api\Data\OrderItemInterface[]
     */
    protected function getOrderItems($orderId)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('order_id', $orderId)
            ->addFilter('parent_item_id', '', 'null')->create();

        return $this->itemRepository->getList($searchCriteria);
    }

    /**
     * @param $price
     * @return string
     */
    protected function formatPrice($price)
    {
        return $this->priceCurrency->convert($price) . $this->priceCurrency->getCurrencySymbol();
    }

    /**
     * @param $orderId
     * @return string
     */
    public function getProductsColumnData($orderId)
    {
        $products = [];
        foreach ($this->getOrderItems($orderId) as $item) {
            $products[] = (int)$item->getQtyOrdered() . " x " . $item->getSku() . ': ' . $item->getName() . ' - ' . $this->formatPrice($item->getPrice());
        }

        return implode(' \r\n ', $products);
    }
}
