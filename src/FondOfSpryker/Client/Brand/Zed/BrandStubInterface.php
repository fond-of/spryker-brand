<?php

namespace FondOfSpryker\Client\Brand\Zed;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;

interface BrandStubInterface
{
    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrands(BrandListTransfer $brandListTransfer): BrandListTransfer;
}
