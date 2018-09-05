<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Mapper;

use Generated\Shared\Transfer\BrandTransfer;

class BrandMapper implements BrandMapperInterface
{
    /**
     * @param array $brand
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandEntityToBrand(array $brand): BrandTransfer
    {
        $brandTransfer = (new BrandTransfer())
            ->fromArray(
                $brand,
                true
            );

        return $brandTransfer;
    }
}
