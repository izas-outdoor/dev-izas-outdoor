<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab\Element;

/**
 * Class FrontLabel
 * @package WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab\Element
 */
class FrontLabel extends \Magento\Framework\Data\Form\Element\Text
{
    /**
     * @var \Magento\Store\Api\StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * FrontLabel constructor.
     * @param \Magento\Framework\Data\Form\Element\Factory $factoryElement
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Store\Api\StoreRepositoryInterface $storeRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Magento\Framework\Escaper $escaper,
        \Magento\Store\Api\StoreRepositoryInterface $storeRepository,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->storeRepository = $storeRepository;
    }

    /**
     * @param string $idSuffix
     * @param string $scopeLabel
     * @return string
     */
    public function getLabelHtml($idSuffix = '', $scopeLabel = '')
    {
        $store = $this->storeRepository->getById($this->getStoreId());

        return '<label class="label admin__field-label wp-store-label-required" for="' .
            $this->getHtmlId() . $idSuffix . '"' . $this->_getUiId('label') .
            '>' . $store->getName() . '</label>' . "\n"
            ;
    }
}
