<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use Generated\Shared\Transfer\BrandCollectionTransfer;

interface BrandRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer;
}
