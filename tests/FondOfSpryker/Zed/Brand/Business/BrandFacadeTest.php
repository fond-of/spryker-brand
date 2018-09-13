<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface;
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
    protected $brandMock;

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
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\BrandTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandResponseTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\BrandResponseTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandMock = $this->getMockForAbstractClass(BrandInterface::class);

        $this->brandBusinessFactoryMock = $this->getMockBuilder(BrandBusinessFactory::class)
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
        $this->brandMock
            ->expects($this->once())
            ->method('get')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandFacade->getBrand($this->brandTransferMock);
    }

    /**
     * @return void
     */
    public function testAddBrand(): void
    {
        $this->brandMock
            ->expects($this->once())
            ->method('add')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandResponseTransferMock);

        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandFacade->addBrand($this->brandTransferMock);
    }

    /**
     * @return void
     */
    public function testDeleteBrand(): void
    {
        $this->brandMock
            ->expects($this->once())
            ->method('delete')
            ->with($this->brandTransferMock)
            ->willReturn(true);

        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandFacade->deleteBrand($this->brandTransferMock);
    }

    /**
     * @return void
     */
    public function testFindBrandById(): void
    {
        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandMock
            ->expects($this->once())
            ->method('findById')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(BrandTransfer::class, $this->brandFacade->findBrandById($this->brandTransferMock));
    }

    /**
     * @return void
     */
    public function testFindBrandByIdReturnNull(): void
    {
        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandMock
            ->expects($this->atLeastOnce())
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
        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandMock
            ->expects($this->once())
            ->method('findByName')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(BrandTransfer::class, $this->brandFacade->findBrandByName($this->brandTransferMock));
    }

    /**
     * @return void
     */
    public function testFindBrandByNameReturnNull(): void
    {
        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandMock
            ->expects($this->atLeastOnce())
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
        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrand')
            ->willReturn($this->brandMock);

        $this->brandMock
            ->expects($this->once())
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
        $brandReaderMock = $this->getMockForAbstractClass(BrandReaderInterface::class);

        /** @var \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer */
        $brandCollectionTransfer = $this->getMockBuilder('\Generated\Shared\Transfer\BrandCollectionTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $brandReaderMock
            ->expects($this->once())
            ->method('getBrandCollection')
            ->with($brandCollectionTransfer)
            ->willReturn($brandCollectionTransfer);

        $this->brandBusinessFactoryMock
            ->expects($this->once())
            ->method('createBrandReader')
            ->willReturn($brandReaderMock);

        $this->brandFacade->getBrandCollection($brandCollectionTransfer);
    }
}
