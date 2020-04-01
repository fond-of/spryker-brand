<?php

namespace FondOfSpryker\Client\Brand;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface;
use FondOfSpryker\Client\Brand\Zed\BrandStubInterface;
use Spryker\Client\Kernel\Container;

class BrandFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\Brand\BrandFactory
     */
    protected $brandFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface
     */
    protected $brandToZedRequestClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandToZedRequestClientInterfaceMock = $this->getMockBuilder(BrandToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandFactory = new BrandFactory();
        $this->brandFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedBrandStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(BrandDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->brandToZedRequestClientInterfaceMock);

        $this->assertInstanceOf(
            BrandStubInterface::class,
            $this->brandFactory->createZedBrandStub()
        );
    }
}
