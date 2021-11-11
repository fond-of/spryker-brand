<?php

namespace FondOfSpryker\Client\Brand\Zed;

use FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;

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

    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrands(BrandListTransfer $brandListTransfer): BrandListTransfer
    {
        /** @var \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer */
        $brandListTransfer = $this->zedRequestClient->call(
            '/brand/gateway/find-brands',
            $brandListTransfer
        );

        return $brandListTransfer;
    }
}
