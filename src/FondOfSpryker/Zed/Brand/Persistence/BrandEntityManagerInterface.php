<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function createBrand(BrandTransfer $brandTransfer): BrandTransfer;

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     */
    public function deleteBrand(BrandTransfer $brandTransfer): void;
}
