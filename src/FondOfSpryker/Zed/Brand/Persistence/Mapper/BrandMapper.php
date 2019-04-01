<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Mapper;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\FosBrandEntityTransfer;

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
                true
            );

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FosBrandEntityTransfer[] $brandEntityTransferCollection
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
}
