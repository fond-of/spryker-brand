<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder;

use FondOfSpryker\Zed\Brand\BrandConfig;
use Generated\Shared\Transfer\BrandListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Orm\Zed\Brand\Persistence\Base\FosBrandQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class BrandSearchFilterFieldQueryBuilder implements BrandSearchFilterFieldQueryBuilderInterface
{
    /**
     * @var string
     */
    protected const FILTER_FIELD_TYPE_ORDER_BY = 'orderBy';

    /**
     * @var string
     */
    protected const DELIMITER_ORDER_BY = '::';

    /**
     * @var \FondOfSpryker\Zed\Brand\BrandConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Zed\Brand\BrandConfig $config
     */
    public function __construct(BrandConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $brandQuery
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    public function addQueryFilters(
        FosBrandQuery $brandQuery,
        BrandListTransfer $brandListTransfer
    ): FosBrandQuery {
        foreach ($brandListTransfer->getFilterFields() as $filterFieldTransfer) {
            $brandQuery = $this->addQueryFilter($brandQuery, $filterFieldTransfer);
        }

        return $brandQuery;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $brandQuery
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addQueryFilter(
        FosBrandQuery $brandQuery,
        FilterFieldTransfer $filterFieldTransfer
    ): FosBrandQuery {
        $filterFieldType = $filterFieldTransfer->getType();

        if (isset($this->config->getFilterFieldTypeMapping()[$filterFieldType])) {
            $brandQuery->add(
                $this->config->getFilterFieldTypeMapping()[$filterFieldType],
                $filterFieldTransfer->getValue(),
                Criteria::EQUAL
            );
        }

        if ($filterFieldType === static::FILTER_FIELD_TYPE_ORDER_BY) {
            return $this->addOrderByFilter(
                $brandQuery,
                $filterFieldTransfer
            );
        }

        return $brandQuery;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $salesOrderQuery
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addOrderByFilter(
        FosBrandQuery $salesOrderQuery,
        FilterFieldTransfer $filterFieldTransfer
    ): FosBrandQuery {
        [$orderColumn, $orderDirection] = explode(static::DELIMITER_ORDER_BY, $filterFieldTransfer->getValue());

        if ($orderColumn) {
            $salesOrderQuery->orderBy($orderColumn, $orderDirection);
        }

        return $salesOrderQuery;
    }
}
