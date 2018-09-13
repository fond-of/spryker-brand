<?php

namespace FondOfSpryker\Zed\Brand;

use Closure;
use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class BrandDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\BrandDependencyProvider
     */
    protected $brandDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandDependencyProvider = new BrandDependencyProvider();
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('offsetSet')
            ->with(
                BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER,
                $this->isInstanceOf(Closure::class)
            );

        $this->brandDependencyProvider->provideBusinessLayerDependencies($this->containerMock);
    }
}
