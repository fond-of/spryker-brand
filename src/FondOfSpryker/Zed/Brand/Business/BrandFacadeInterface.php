<?php

namespace FondOfSpryker\Zed\Product\Business;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;

interface BrandFacadeInterface
{
    /**
     * Specification:
     * - Get brand.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function getBrand(BrandTransfer $brandTransfer): ?BrandTransfer;

    /**
     * Specification:
     * - Stores brand data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function addBrand(BrandTransfer $brandTransfer): BrandTransfer;

    /**
     * Specification:
     * - Update brand data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function updateBrand(BrandTransfer $brandTransfer): BrandTransfer;

    /**
     * Specification:
     * - Delete brand data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function deleteBrand(BrandTransfer $brandTransfer): bool;

    /**
     * Specification:
     * - Find brand by id
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function findBrandById(BrandTransfer $brandTransfer);

    /**
     * Specification:
     * - Find brand by name
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function findBrandByName(BrandTransfer $brandTransfer);

    /**
     * Specification:
     * - Checks if the brand exists.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function hasBrand(BrandTransfer $brandTransfer): bool;

    /**
     * Specification:
     * - Get brand collection
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $BrandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $BrandCollectionTransfer): BrandCollectionTransfer;
}
