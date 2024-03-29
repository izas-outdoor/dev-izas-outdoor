<?php

/**
 * Product:       Xtento_OrderExport
 * ID:            fso5z3a0QaKnCwcGMUjyKBrw+XWvPsrvsDClR8Fc3jg=
 * Last Modified: 2020-04-07T18:18:13+00:00
 * File:          app/code/Xtento/OrderExport/Model/Export/Entity/Eerma.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\OrderExport\Model\Export\Entity;

use Magento\Framework\ObjectManagerInterface;

class Eerma extends AbstractEntity
{
    protected $entityType = \Xtento\OrderExport\Model\Export::ENTITY_EERMA;

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Eerma constructor.
     *
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Xtento\OrderExport\Model\ProfileFactory $profileFactory
     * @param \Xtento\OrderExport\Model\ResourceModel\History\CollectionFactory $historyCollectionFactory
     * @param \Xtento\OrderExport\Model\Export\Data $exportData
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     * @param ObjectManagerInterface $objectManager
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Xtento\OrderExport\Model\ProfileFactory $profileFactory,
        \Xtento\OrderExport\Model\ResourceModel\History\CollectionFactory $historyCollectionFactory,
        \Xtento\OrderExport\Model\Export\Data $exportData,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        ObjectManagerInterface $objectManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->objectManager = $objectManager;
        parent::__construct($context, $registry, $profileFactory, $historyCollectionFactory, $exportData, $timezone, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $rmaCollectionFactory = $this->objectManager->create('\Magento\Rma\Model\ResourceModel\Rma\CollectionFactory');
        $collection = $rmaCollectionFactory->create()
            ->addAttributeToSelect('*');
        $this->collection = $collection;
        parent::_construct();
    }
}