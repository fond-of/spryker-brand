<?php

namespace FondOfSpryker\Zed\Brand\Business\BrandExpander;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function expand(BrandTransfer $brandTransfer): BrandTransfer;
}
