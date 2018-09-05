<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Mapper;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandMapperInterface
{
    /**
     * @param array $brand
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandEntityToBrand(array $brand): BrandTransfer;
}
