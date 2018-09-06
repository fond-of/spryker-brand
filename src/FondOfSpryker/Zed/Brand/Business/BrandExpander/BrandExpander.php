<?php

namespace FondOfSpryker\Zed\Brand\Business\BrandExpander;

use Generated\Shared\Transfer\BrandTransfer;

class BrandExpander implements BrandExpanderInterface
{
    /**
     * @var array|\FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface[]
     */
    protected $brandTransferExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\Brand\Dependency\Plugin\BrandTransferExpanderPluginInterface[] $brandTransferExpanderPlugins
     */
    public function __construct(array $brandTransferExpanderPlugins)
    {
        $this->brandTransferExpanderPlugins = $brandTransferExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function expand(BrandTransfer $brandTransfer)
    {
        foreach ($this->brandTransferExpanderPlugins as $brandTransferExpanderPlugin) {
            $brandTransfer = $brandTransferExpanderPlugin->expandTransfer($brandTransfer);
        }

        return $brandTransfer;
    }
}
