<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\FosBrandEntityTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;
use Propel\Runtime\Collection\ObjectCollection;

class BrandMapper implements BrandMapperInterface
{
    /**
     * @param array $brand
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandEntityToBrand(array $brand): BrandTransfer
    {
        $brandTransfer = (new BrandTransfer())
            ->fromArray(
                $brand,
                true,
            );

        return $brandTransfer;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FosBrandEntityTransfer> $brandEntityTransferCollection
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function mapCollectionTransfer(array $brandEntityTransferCollection): BrandCollectionTransfer
    {
        $brandCollectionTransfer = new BrandCollectionTransfer();
        foreach ($brandEntityTransferCollection as $brandEntityTransfer) {
            $brandTransfer = $this->mapBrandTransfer($brandEntityTransfer);
            $brandCollectionTransfer->addBrand($brandTransfer);
        }

        return $brandCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FosBrandEntityTransfer $brandEntityTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandTransfer(FosBrandEntityTransfer $brandEntityTransfer): BrandTransfer
    {
        $brandTransfer = new BrandTransfer();

        $brandTransfer->fromArray($brandEntityTransfer->toArray(), true);

        return $brandTransfer;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $fosBrandEntity
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapEntityToBrandTransfer(
        FosBrand $fosBrandEntity,
        BrandTransfer $brandTransfer
    ): BrandTransfer {
        return $brandTransfer->fromArray($fosBrandEntity->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Orm\Zed\Brand\Persistence\FosBrand $fosBrandEntity
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    public function mapBrandTransferToEntity(
        BrandTransfer $brandTransfer,
        FosBrand $fosBrandEntity
    ): FosBrand {
        $fosBrandEntity->fromArray($brandTransfer->toArray());

        return $fosBrandEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    public function mapTransferToEntity(BrandTransfer $brandTransfer): FosBrand
    {
        $fosBrand = new FosBrand();

        $fosBrand->fromArray(
            $brandTransfer->modifiedToArray(false),
        );

        return $fosBrand;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $entity
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapEntityToTransfer(FosBrand $entity): BrandTransfer
    {
        return (new BrandTransfer())
            ->fromArray($entity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Brand\Persistence\FosBrand> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\BrandTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity);
        }

        return $transfers;
    }
}
