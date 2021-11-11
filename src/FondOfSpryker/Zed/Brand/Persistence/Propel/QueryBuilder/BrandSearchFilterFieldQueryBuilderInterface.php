<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\BrandListTransfer;
use Orm\Zed\Brand\Persistence\Base\FosBrandQuery;

interface BrandSearchFilterFieldQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $brandQuery
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    public function addQueryFilters(
        FosBrandQuery $brandQuery,
        BrandListTransfer $brandListTransfer
    ): FosBrandQuery;
}
