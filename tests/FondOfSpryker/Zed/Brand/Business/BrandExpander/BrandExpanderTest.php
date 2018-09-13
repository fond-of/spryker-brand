<?php

namespace FondOfSpryker\Zed\Brand\Business\BrandExpander;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface;

class BrandExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface
     */
    protected $brandExpander;

    /**
     * @var \FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandExpanderPluginMock;

    /**
     * @var \Generated\Shared\Transfer\BrandTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandExpanderPluginMock = $this->getMockForAbstractClass(BrandTransferExpanderPluginInterface::class);
        $this->brandExpander = new BrandExpander([$this->brandExpanderPluginMock]);

        $this->brandTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\BrandTransfer')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExpand()
    {
        $this->brandExpanderPluginMock
            ->expects($this->once())
            ->method('expandTransfer')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->brandExpander->expand($this->brandTransferMock);
    }
}
