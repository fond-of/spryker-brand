<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\FosBrandEntityTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;
use Propel\Runtime\Collection\ObjectCollection;

interface BrandMapperInterface
{
    /**
     * @param array $brand
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandEntityToBrand(array $brand): BrandTransfer;

    /**
     * @param array<\Generated\Shared\Transfer\FosBrandEntityTransfer> $brandEntityTransferCollection
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function mapCollectionTransfer(array $brandEntityTransferCollection): BrandCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\FosBrandEntityTransfer $brandEntityTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandTransfer(FosBrandEntityTransfer $brandEntityTransfer): BrandTransfer;

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $fosBrandEntity
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapEntityToBrandTransfer(
        FosBrand $fosBrandEntity,
        BrandTransfer $brandTransfer
    ): BrandTransfer;

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Orm\Zed\Brand\Persistence\FosBrand $fosBrand
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    public function mapBrandTransferToEntity(
        BrandTransfer $brandTransfer,
        FosBrand $fosBrand
    ): FosBrand;

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    public function mapTransferToEntity(BrandTransfer $brandTransfer): FosBrand;

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $entity
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapEntityToTransfer(FosBrand $entity): BrandTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Brand\Persistence\FosBrand> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\BrandTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array;
}
