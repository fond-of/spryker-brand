<?php

namespace FondOfSpryker\Zed\Brand\Communication\Controller;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;
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

    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrandsAction(BrandListTransfer $brandListTransfer): BrandListTransfer
    {
        return $this->getFacade()->findBrands($brandListTransfer);
    }
}
