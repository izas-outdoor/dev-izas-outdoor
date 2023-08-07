<?php

namespace Omnisend\Omnisend\Helper\SearchCriteria;

use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Setup\InstallData;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Quote\Api\Data\CartInterface;

class Quote implements EntityInterface
{
    const QUOTE_CUSTOMER_EMAIL = 'customer_email';

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    protected $filterGroupBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * SearchCriteriaBuilderHelper constructor.
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GeneralConfig $generalConfig
     */
    public function __construct(
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        GeneralConfig $generalConfig
    ) {
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->generalConfig = $generalConfig;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityInStoreByImportStatusSearchCriteria($isImported, $storeId)
    {
        $customerEmailFilter = $this->filterBuilder
            ->create()
            ->setField(self::QUOTE_CUSTOMER_EMAIL)
            ->setConditionType('neq')
            ->setValue(null);

        $isImportedFilter = $this->filterBuilder
            ->create()
            ->setField(InstallData::IS_IMPORTED)
            ->setConditionType('eq')
            ->setValue($isImported);

        $storeFilter = $this->filterBuilder
            ->create()
            ->setField(CartInterface::KEY_STORE_ID)
            ->setConditionType('eq')
            ->setValue($storeId);

        $customerEmailFilterGroup = $this->filterGroupBuilder
            ->create()
            ->setData('filters', [$customerEmailFilter]);

        $isImportedFilterGroup = $this->filterGroupBuilder
            ->create()
            ->setData('filters', [$isImportedFilter]);

        $storeFilterGroup = $this->filterGroupBuilder
            ->create()
            ->setData('filters', [$storeFilter]);

        $searchCriteria = $this->searchCriteriaBuilder
            ->create()
            ->setFilterGroups([$customerEmailFilterGroup, $isImportedFilterGroup, $storeFilterGroup]);

        $searchCriteria->setPageSize($this->generalConfig->getMaximumEntitiesPerCron());

        return $searchCriteria;
    }
}