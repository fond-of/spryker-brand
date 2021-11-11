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
    public const PLUGINS_SEARCH_BRAND_QUERY_EXPANDER = 'PLUGINS_SEARCH_BRAND_QUERY_EXPANDER';

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

        return $this->addSearchBrandQueryExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addBrandTransferExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_BRAND_TRANSFER_EXPANDER] = static function () use ($self) {
            return $self->getBrandTransferExpanderPlugins();
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
        $self = $this;

        $container[static::PLUGINS_BRAND_PRE_CREATE] = static function () use ($self) {
            return $self->getBrandPreCreatePlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandPostSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_BRAND_POST_SAVE] = static function () use ($self) {
            return $self->getBrandPostSavePlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandDeletePreCheckPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_BRAND_DELETE_PRE_CHECK] = static function () use ($self) {
            return $self->getBrandDeletePreCheckPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandPostDeletePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_BRAND_POST_DELETE] = static function () use ($self) {
            return $self->getBrandPostDeletePlugins();
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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchBrandQueryExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SEARCH_BRAND_QUERY_EXPANDER] = static function () use ($self) {
            return $self->getSearchBrandQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\SearchBrandQueryExpanderPluginInterface>
     */
    protected function getSearchBrandQueryExpanderPlugins(): array
    {
        return [];
    }
}
