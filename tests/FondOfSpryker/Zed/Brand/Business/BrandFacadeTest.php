<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    protected $brandFacade;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandInterfaceMock;

    /**
     * @var \Generated\Shared\Transfer\BrandTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandTransferMock;

    /**
     * @var \Generated\Shared\Transfer\BrandResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface
     */
    protected $brandReaderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandResponseTransferMock = $this->getMockBuilder(BrandResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandInterfaceMock = $this->getMockBuilder(BrandInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandBusinessFactoryMock = $this->getMockBuilder(BrandBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandReaderInterfaceMock = $this->getMockBuilder(BrandReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandFacade = new BrandFacade();
        $this->brandFacade->setFactory($this->brandBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetBrand(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->once())
            ->method('get')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(
            BrandTransfer::class,
            $this->brandFacade->getBrand($this->brandTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testAddBrand(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->once())
            ->method('add')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandResponseTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandFacade->addBrand($this->brandTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testDeleteBrand(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->once())
            ->method('delete')
            ->with($this->brandTransferMock)
            ->willReturn(true);

        $this->assertTrue(
            $this->brandFacade->deleteBrand($this->brandTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandById(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->once())
            ->method('findById')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(
            BrandTransfer::class,
            $this->brandFacade->findBrandById($this->brandTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByIdReturnNull(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->atLeastOnce())
            ->method('findById')
            ->with($this->brandTransferMock)
            ->willReturn(null);

        $this->assertNull($this->brandFacade->findBrandById($this->brandTransferMock));
    }

    /**
     * @return void
     */
    public function testFindBrandByName(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->once())
            ->method('findByName')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(
            BrandTransfer::class,
            $this->brandFacade->findBrandByName($this->brandTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByNameReturnNull(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->atLeastOnce())
            ->method('findByName')
            ->with($this->brandTransferMock)
            ->willReturn(null);

        $this->assertNull($this->brandFacade->findBrandByName($this->brandTransferMock));
    }

    /**
     * @return void
     */
    public function testHasBrand(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->once())
            ->method('hasBrand')
            ->with($this->brandTransferMock)
            ->willReturn(true);

        $this->assertTrue($this->brandFacade->hasBrand($this->brandTransferMock));
    }

    /**
     * @return void
     */
    public function testGetBrandCollection(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrandReader')
            ->willReturn($this->brandReaderInterfaceMock);

        $this->brandReaderInterfaceMock->expects($this->once())
            ->method('getBrandCollection')
            ->with($this->brandCollectionTransferMock)
            ->willReturn($this->brandCollectionTransferMock);

        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->brandFacade->getBrandCollection($this->brandCollectionTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetActiveBrands(): void
    {
        $this->brandBusinessFactoryMock->expects($this->once())
            ->method('createBrandReader')
            ->willReturn($this->brandReaderInterfaceMock);

        $this->brandReaderInterfaceMock->expects($this->once())
            ->method('getActiveBrands')
            ->willReturn($this->brandCollectionTransferMock);

        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->brandFacade->getActiveBrands()
        );
    }

    /**
     * @return void
     */
    public function testCreateBrand(): void
    {
        $this->brandBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->atLeastOnce())
            ->method('createBrand')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandResponseTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandFacade->createBrand($this->brandTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testUpdateBrand(): void
    {
        $this->brandBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createBrand')
            ->willReturn($this->brandInterfaceMock);

        $this->brandInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandResponseTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandFacade->updateBrand($this->brandTransferMock)
        );
    }
}
