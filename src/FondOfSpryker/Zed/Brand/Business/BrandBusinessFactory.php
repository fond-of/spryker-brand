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
        return new Brand(
            $this->getQueryContainer(),
            $this->getEntityManager(),
            $this->getConfig(),
            $this->createBrandExpander(),
            $this->getBrandPreCreatePlugins(),
            $this->getBrandPostDeletePlugins(),
            $this->getBrandPostSavePlugins(),
            $this->getBrandDeletePreCheckPlugins()
        );
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

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPreCreatePluginInterface[]
     */
    public function getBrandPreCreatePlugins(): array
    {
        return $this->getProvidedDependency(BrandDependencyProvider::PLUGINS_BRAND_PRE_CREATE);
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostDeletePluginInterface[]
     */
    public function getBrandPostDeletePlugins(): array
    {
        return $this->getProvidedDependency(BrandDependencyProvider::PLUGINS_BRAND_POST_DELETE);
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostSavePluginInterface[]
     */
    public function getBrandPostSavePlugins(): array
    {
        return $this->getProvidedDependency(BrandDependencyProvider::PLUGINS_BRAND_POST_SAVE);
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandDeletePreCheckPluginInterface[]
     */
    public function getBrandDeletePreCheckPlugins(): array
    {
        return $this->getProvidedDependency(BrandDependencyProvider::PLUGINS_BRAND_DELETE_PRE_CHECK);
    }
}
