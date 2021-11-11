<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;
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
     * - Stores brand data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function createBrand(BrandTransfer $brandTransfer): BrandResponseTransfer;

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
     * - Finds a Brand by BrandTransfer::idBrand.
     * - Deletes Brand.
     * - BrandResponseTransfer::isSuccessful is true if brand was deleted.
     * - BrandResponseTransfer::messages contains error messages if deletion was not performed.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function removeBrand(BrandTransfer $brandTransfer): BrandResponseTransfer;

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
     * - Find brand by name
     *
     * @api
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findByName(string $name): ?BrandTransfer;

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

    /**
     * Specification:
     * - Get active brand collection
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer;

    /**
     * Specification:
     * - Finds brands by criteria from BrandListTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrands(BrandListTransfer $brandListTransfer): BrandListTransfer;
}
