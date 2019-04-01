<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;

interface BrandRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer;

    /**
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandByName(string $name): ?BrandTransfer;

    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer;
}
