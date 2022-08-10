<?php

namespace FondOfSpryker\Client\Brand;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class BrandDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\Brand\BrandDependencyProvider
     */
    protected $brandDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandDependencyProvider = new BrandDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->brandDependencyProvider->provideServiceLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
