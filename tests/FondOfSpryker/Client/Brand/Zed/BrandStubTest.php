<?php

namespace FondOfSpryker\Client\Brand\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

class BrandStubTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\Brand\Zed\BrandStub
     */
    protected $brandStub;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\Dependency\Client\BrandToZedRequestClientInterface
     */
    protected $brandToZedRequestClientInterfaceMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandToZedRequestClientInterfaceMock = $this->getMockBuilder(BrandToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = '/brand/gateway/get-active-brands';

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandStub = new BrandStub($this->brandToZedRequestClientInterfaceMock);
    }

    /**
     * @return void
     */
    public function testGetActiveBrands(): void
    {
        $this->brandToZedRequestClientInterfaceMock->expects($this->atLeastOnce())
            ->method('call')
            ->with($this->url)
            ->willReturn($this->brandCollectionTransferMock);

        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->brandStub->getActiveBrands()
        );
    }
}
