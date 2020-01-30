<?php
namespace FondOfSpryker\Zed\Brand;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class BrandDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PLUGINS_BRAND_TRANSFER_EXPANDER = 'PLUGINS_BRAND_TRANSFER_EXPANDER';
    public const PLUGINS_BRAND_POST_SAVE = 'PLUGINS_BRAND_POST_SAVE';
    public const PLUGINS_BRAND_POST_DELETE = 'PLUGINS_BRAND_POST_DELETE';
    public const PLUGINS_BRAND_PRE_CREATE = 'PLUGINS_BRAND_PRE_CREATE';
    public const PLUGINS_BRAND_DELETE_PRE_CHECK = 'PLUGINS_BRAND_DELETE_PRE_CHECK';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addBrandTransferExpanderPlugins($container);
        $container = $this->addBrandPreCreatePlugins($container);
        $container = $this->addBrandPostSavePlugins($container);
        $container = $this->addBrandPostDeletePlugins($container);
        $container = $this->addBrandDeletePreCheckPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addBrandTransferExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_BRAND_TRANSFER_EXPANDER] = function (Container $container) {
            return $this->getBrandTransferExpanderPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandPreCreatePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_BRAND_PRE_CREATE, function (Container $container) {
            return $this->getBrandPreCreatePlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandPostSavePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_BRAND_POST_SAVE, function (Container $container) {
            return $this->getBrandPostSavePlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @throws
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandDeletePreCheckPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_BRAND_DELETE_PRE_CHECK, function (Container $container) {
            return $this->getBrandDeletePreCheckPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @throws
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandPostDeletePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_BRAND_POST_DELETE, function (Container $container) {
            return $this->getBrandPostDeletePlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface[]
     */
    protected function getBrandTransferExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostSavePluginInterface[]
     */
    protected function getBrandPostSavePlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostDeletePluginInterface[]
     */
    protected function getBrandPostDeletePlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPreCreatePluginInterface[]
     */
    protected function getBrandPreCreatePlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandDeletePreCheckPluginInterface[]
     */
    protected function getBrandDeletePreCheckPlugins(): array
    {
        return [];
    }
}
