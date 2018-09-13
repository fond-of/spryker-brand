<?php

namespace FondOfSpryker\Zed\Brand\Business;

use FondOfSpryker\Zed\Brand\BrandDependencyProvider;
use FondOfSpryker\Zed\Brand\Business\Brand\Brand;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReader;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpander;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

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
    public function createBrand(): BrandInterface
    {
        $config = $this->getConfig();

        $brand = new Brand(
            $this->getQueryContainer(),
            $config,
            $this->createBrandExpander()
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
            $this->getRepository(),
            $this->createBrandExpander()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface
     */
    public function createBrandExpander(): BrandExpanderInterface
    {
        return new BrandExpander(
            $this->getBrandTransferExpanderPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface[]
     */
    protected function getBrandTransferExpanderPlugins(): array
    {
        return $this->getProvidedDependency(BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER);
    }
}
