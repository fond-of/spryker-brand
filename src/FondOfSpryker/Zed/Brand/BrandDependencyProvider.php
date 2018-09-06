<?php
namespace FondOfSpryker\Zed\Brand;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class BrandDependencyProvider extends AbstractBundleDependencyProvider
{
    const PLUGINS_BRAND_TRANSFER_EXPANDER = 'PLUGINS_BRAND_TRANSFER_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addBrandTransferExpanderPlugins($container);

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
     * @return \FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface[]
     */
    protected function getBrandTransferExpanderPlugins(): array
    {
        return [];
    }
}
