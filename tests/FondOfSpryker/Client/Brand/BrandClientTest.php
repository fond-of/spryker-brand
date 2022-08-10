<?php

namespace FondOfSpryker\Client\Brand;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Brand\Zed\BrandStubInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;

class BrandClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\Brand\BrandClient
     */
    protected $brandClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\BrandFactory
     */
    protected $brandFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\Zed\BrandStubInterface
     */
    protected $brandStubInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandListTransfer
     */
    protected $brandListTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandFactoryMock = $this->getMockBuilder(BrandFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandStubInterfaceMock = $this->getMockBuilder(BrandStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandListTransferMock = $this->getMockBuilder(BrandListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandClient = new BrandClient();
        $this->brandClient->setFactory($this->brandFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetActiveBrands(): void
    {
        $this->brandFactoryMock->expects($this->atLeastOnce())
            ->method('createZedBrandStub')
            ->willReturn($this->brandStubInterfaceMock);

        $this->brandStubInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveBrands')
            ->willReturn($this->brandCollectionTransferMock);

        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->brandClient->getActiveBrands(),
        );
    }

    /**
     * @return void
     */
    public function testFindBrands(): void
    {
        $this->brandFactoryMock->expects($this->atLeastOnce())
            ->method('createZedBrandStub')
            ->willReturn($this->brandStubInterfaceMock);

        $this->brandStubInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrands')
            ->with($this->brandListTransferMock)
            ->willReturn($this->brandListTransferMock);

        $this->assertInstanceOf(
            BrandListTransfer::class,
            $this->brandClient->findBrands($this->brandListTransferMock),
        );
    }
}
