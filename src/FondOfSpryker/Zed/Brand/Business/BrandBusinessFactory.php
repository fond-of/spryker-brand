<?php

namespace FondOfSpryker\Zed\Brand\Business;

use FondOfSpryker\Zed\Brand\Business\Brand\Brand;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReader;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface;
use FondOfSpryker\Zed\Brand\BrandDependencyProvider;
use FondOfSpryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\Brand\BrandConfig getConfig()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface getRepository()
 */
class BrandBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface
     */
    public function createBrand()
    {
        $config = $this->getConfig();

        $brand = new Brand(
            $this->getQueryContainer(),
            $config
        );

        return $brand;
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface
     */
    public function createBrandReader(): BrandReaderInterface
    {
        return new BrandReader(
            $this->getEntityManager(),
            $this->getRepository()
        );
    }
}
