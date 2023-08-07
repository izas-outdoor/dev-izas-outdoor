<?php

namespace Omnisend\Omnisend\Model\Attribute\IsImported;

use Omnisend\Omnisend\Model\ResourceModel\QuoteFactory;

class QuoteAttributeUpdater implements AttributeUpdaterInterface
{
    /**
     * @var QuoteFactory
     */
    private $quoteFactory;

    /**
     * @param QuoteFactory $quoteFactory
     */
    public function __construct(QuoteFactory $quoteFactory)
    {
        $this->quoteFactory = $quoteFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsImported($entityId, $isImported)
    {
        $quote = $this->quoteFactory->create();
        $quote->updateIsImported($entityId, $isImported);
    }
}