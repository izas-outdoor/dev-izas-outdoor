<?php


namespace Metagento\Faq\Model\ResourceModel\Category\Grid;


class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable = 'metagento_faq_category',
        $resourceModel = 'Metagento\Faq\Model\ResourceModel\Category'
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    protected function _afterLoad()
    {
        if($this->getSize()){
            foreach ($this as $item){
                $item->setData('store_id',explode(',',$item->getData('store_ids')));
            }
        }
        return parent::_afterLoad();
    }


}