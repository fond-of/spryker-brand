<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use Generated\Shared\Transfer\BrandTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandPersistenceFactory getFactory()
 */
class BrandEntityManager extends AbstractEntityManager implements BrandEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function createBrand(BrandTransfer $brandTransfer): BrandTransfer
    {
        return $this->saveBrandEntity(new FosBrand(), $brandTransfer);
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $brandEntity
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    protected function saveBrandEntity(FosBrand $brandEntity, BrandTransfer $brandTransfer): BrandTransfer
    {
        $brandEntity = $this->getFactory()
            ->createBrandMapper()
            ->mapBrandTransferToEntity($brandTransfer, $brandEntity);

        $brandEntity->save();

        $brandTransfer = $this->getFactory()
            ->createBrandMapper()
            ->mapEntityToBrandTransfer($brandEntity, $brandTransfer);

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return void
     */
    public function deleteBrand(BrandTransfer $brandTransfer): void
    {
        $this->getFactory()
            ->createBrandQuery()
            ->findOneByIdBrand($brandTransfer->getIdBrand())
            ->delete();
    }
}
