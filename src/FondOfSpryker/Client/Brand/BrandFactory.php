<?php

namespace FondOfSpryker\Client\Brand;

use FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface;
use FondOfSpryker\Client\Brand\Zed\BrandStub;
use FondOfSpryker\Client\Brand\Zed\BrandStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class BrandFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\Brand\Zed\BrandStubInterface
     */
    public function createZedBrandStub(): BrandStubInterface
    {
        return new BrandStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface
     */
    protected function getZedRequestClient(): BrandToZedRequestClientInterface
    {
        return $this->getProvidedDependency(BrandDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
