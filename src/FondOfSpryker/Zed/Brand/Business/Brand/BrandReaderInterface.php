<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use Generated\Shared\Transfer\BrandCollectionTransfer;

interface BrandReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer;
}
