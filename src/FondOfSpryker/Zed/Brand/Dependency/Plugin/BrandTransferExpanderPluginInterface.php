<?php

namespace FondOfSpryker\Zed\Brand\Dependency\Plugin;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandTransferExpanderPluginInterface
{
    /**
     * Specification
     * - Expands the provided customer transfer object's data and returns the modified object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function expandTransfer(BrandTransfer $customerTransfer): BrandTransfer;
}
