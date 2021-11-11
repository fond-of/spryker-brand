<?php

namespace FondOfSpryker\Zed\Brand\Communication\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\BrandFacade;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\BrandListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $brandListTransferMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandFacade|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $facadeMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Communication\Controller\GatewayController
     */
    protected $gatewayController;


    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(BrandFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandListTransferMock = $this->getMockBuilder(BrandListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
             */
            protected $brandFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->brandFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->brandFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetActiveBrandsAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getActiveBrands')
            ->willReturn(new BrandCollectionTransfer());

        static::assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->gatewayController->getActiveBrandsAction()
        );
    }

    /**
     * @return void
     */
    public function testFindBrandsAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findBrands')
            ->with($this->brandListTransferMock)
            ->willReturn($this->brandListTransferMock);

        static::assertInstanceOf(
            BrandListTransfer::class,
            $this->gatewayController->findBrandsAction($this->brandListTransferMock)
        );
    }
}
