<?php

namespace FondOfSpryker\Client\Brand\Zed;

use FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

class BrandStub implements BrandStubInterface
{
    /**
     * @var \FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(BrandToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        /** @var \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer */
        $brandCollectionTransfer = $this->zedRequestClient->call(
            '/brand/gateway/get-active-brands',
            new BrandCollectionTransfer()
        );

        return $brandCollectionTransfer;
    }
}
