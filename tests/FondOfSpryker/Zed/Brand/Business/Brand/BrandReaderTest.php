<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface;

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
     * @return void
     */
    protected function _before(): void
    {
        $this->brandRepositoryMock = $this->getMockForAbstractClass(BrandRepositoryInterface::class);
        $this->brandEntityManagerMock = $this->getMockForAbstractClass(BrandEntityManagerInterface::class);
        $this->brandExpanderMock = $this->getMockForAbstractClass(BrandExpanderInterface::class);

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
        /** @var \Generated\Shared\Transfer\BrandTransfer $brandCollectionTransfer */
        $brandTransfer = $this->getMockBuilder('\Generated\Shared\Transfer\BrandTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer */
        $brandCollectionTransfer = $this->getMockBuilder('\Generated\Shared\Transfer\BrandCollectionTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $brandCollectionTransfer->expects($this->exactly(2))
            ->method('getBrands')
            ->willReturn([$brandTransfer, $brandTransfer, $brandTransfer]);

        $this->brandRepositoryMock
            ->expects($this->once())
            ->method('getBrandCollection')
            ->with($brandCollectionTransfer)
            ->willReturn($brandCollectionTransfer);

        $this->brandExpanderMock
            ->expects($this->exactly(3))
            ->method('expand')
            ->with($brandTransfer);

        $this->brandReader->getBrandCollection($brandCollectionTransfer);
    }
}
