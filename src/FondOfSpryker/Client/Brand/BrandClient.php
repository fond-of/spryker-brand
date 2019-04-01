<?php

namespace FondOfSpryker\Client\Brand;

use Generated\Shared\Transfer\BrandCollectionTransfer;
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
}
