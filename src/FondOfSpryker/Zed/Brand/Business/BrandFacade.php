<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\Brand\Business\BrandBusinessFactory getFactory()
 */
class BrandFacade extends AbstractFacade implements BrandFacadeInterface
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function addBrand(BrandTransfer $brandTransfer): BrandTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->add($brandTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function updateBrand(BrandTransfer $brandTransfer): BrandTransfer
    {
        return $this->getFactory()
            ->createBrand()
            ->update($brandTransfer);
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function hasBrand(BrandTransfer $brandTransfer): bool
    {
        return $this->getFactory()
            ->createBrand()
            ->hasBrand($brandTransfer);
    }

    /**
     * {@inheritdoc}
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
}
