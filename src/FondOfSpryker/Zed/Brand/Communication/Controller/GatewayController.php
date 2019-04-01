<?php

namespace FondOfSpryker\Zed\Brand\Communication\Controller;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrandsAction(): BrandCollectionTransfer
    {
        return $this->getFacade()->getActiveBrands();
    }
}
