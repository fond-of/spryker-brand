<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\Brand\Persistence\Base\FosBrandQuery;

interface BrandQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    public function addQueryFilters(
        FosBrandQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): FosBrandQuery;
}
