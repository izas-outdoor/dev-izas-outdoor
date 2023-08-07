<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\Config\Source;

use WebPanda\Rma\Model\ResourceModel\Status\CollectionFactory as StatusCollectionFactory;

/**
 * Class Status
 * @package WebPanda\Rma\Model\Config\Source
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var StatusCollectionFactory
     */
    protected $statusCollectionFactory;

    /**
     * Status constructor.
     * @param StatusCollectionFactory $statusCollectionFactory
     */
    public function __construct(StatusCollectionFactory $statusCollectionFactory)
    {
        $this->statusCollectionFactory = $statusCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $statuses = $this->statusCollectionFactory->create()->load();

        $options = [['value' => '', 'label' => __('-- Please Select --')]];
        foreach ($statuses as $status) {
            $options[] = ['value' => $status->getId(), 'label' => $status->getName()];
        }

        return $options;
    }
}
