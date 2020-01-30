<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Mapper;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\FosBrandEntityTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;

interface BrandMapperInterface
{
    /**
     * @param array $brand
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapBrandEntityToBrand(array $brand): BrandTransfer;

    /**
     * @param \Generated\Shared\Transfer\FosBrandEntityTransfer[] $brandEntityTransferCollection
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
}
