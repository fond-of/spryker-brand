<?php

namespace FondOfSpryker\Client\Brand\Zed;

use Generated\Shared\Transfer\BrandCollectionTransfer;

interface BrandStubInterface
{
    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer;
}
