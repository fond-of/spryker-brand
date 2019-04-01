<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Mapper;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\FosBrandEntityTransfer;

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
}
