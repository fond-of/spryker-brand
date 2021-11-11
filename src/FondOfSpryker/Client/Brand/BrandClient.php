<?php

namespace FondOfSpryker\Client\Brand;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\Brand\BrandFactory getFactory()
 */
class BrandClient extends AbstractClient implements BrandClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        return $this->getFactory()->createZedBrandStub()->getActiveBrands();
    }

    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrands(BrandListTransfer $brandListTransfer): BrandListTransfer
    {
        return $this->getFactory()->createZedBrandStub()->findBrands($brandListTransfer);
    }
}
