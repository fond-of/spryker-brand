<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface
     */
    protected $brandReader;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandRepositoryMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandEntityManagerMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[]
     */
    protected $brandTransferMocks;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandRepositoryMock = $this->getMockBuilder(BrandRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandEntityManagerMock = $this->getMockBuilder(BrandEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandExpanderMock = $this->getMockBuilder(BrandExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMocks = new ArrayObject([
            $this->brandTransferMock,
        ]);

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandReader = new BrandReader(
            $this->brandEntityManagerMock,
            $this->brandRepositoryMock,
            $this->brandExpanderMock
        );
    }

    /**
     * @return void
     */
    public function testGetBrandCollection(): void
    {
        $this->brandRepositoryMock->expects($this->atLeastOnce())
            ->method('getBrandCollection')
            ->with($this->brandCollectionTransferMock)
            ->willReturn($this->brandCollectionTransferMock);

        $this->brandCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brandTransferMocks);

        $this->brandExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->brandReader->getBrandCollection(
                $this->brandCollectionTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetActiveBrands(): void
    {
        $this->brandRepositoryMock->expects($this->atLeastOnce())
            ->method('getActiveBrands')
            ->willReturn($this->brandCollectionTransferMock);

        $this->brandCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brandTransferMocks);

        $this->brandExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->brandReader->getActiveBrands()
        );
    }
}
