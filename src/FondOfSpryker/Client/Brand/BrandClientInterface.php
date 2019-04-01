<?php

namespace FondOfSpryker\Client\Brand;

use Generated\Shared\Transfer\BrandCollectionTransfer;

interface BrandClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer;
}
