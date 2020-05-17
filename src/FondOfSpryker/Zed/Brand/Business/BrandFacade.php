<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\Brand\Business\BrandBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface getEntityManager()
 */
class BrandFacade extends AbstractFacade implements BrandFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function getBrand(BrandTransfer $brandTransfer): ?BrandTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->get($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function addBrand(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->add($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function createBrand(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->createBrand($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function updateBrand(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->update($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function deleteBrand(BrandTransfer $brandTransfer): bool
    {
        return $this->getFactory()
            ->createBrand()
            ->delete($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function removeBrand(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->deleteBrand($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandById(BrandTransfer $brandTransfer): ?BrandTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->findById($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandByName(BrandTransfer $brandTransfer): ?BrandTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->findByName($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function hasBrand(BrandTransfer $brandTransfer): bool
    {
        return $this->getFactory()
            ->createBrand()
            ->hasBrand($brandTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $BrandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $BrandCollectionTransfer): BrandCollectionTransfer
    {
        return $this->getFactory()
            ->createBrandReader()
            ->getBrandCollection($BrandCollectionTransfer);
    }

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
    public function findByName(string $name): ?BrandTransfer
    {
        return $this->getRepository()
            ->findBrandByName($name);
    }

    /**
     * Specification:
     * - Get active brand collection
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        return $this->getFactory()->createBrandReader()->getActiveBrands();
    }
}
