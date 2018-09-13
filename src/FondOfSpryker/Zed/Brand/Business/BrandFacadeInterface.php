<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandResponseTransfer;
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
    public function addBrand(BrandTransfer $brandTransfer): BrandResponseTransfer;

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
    public function updateBrand(BrandTransfer $brandTransfer): BrandResponseTransfer;

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
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandById(BrandTransfer $brandTransfer): ?BrandTransfer;

    /**
     * Specification:
     * - Find brand by name
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandByName(BrandTransfer $brandTransfer): ?BrandTransfer;

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
