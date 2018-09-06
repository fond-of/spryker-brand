<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function get(BrandTransfer $brandTransfer);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function add(BrandTransfer $brandTransfer);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function update(BrandTransfer $brandTransfer);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function delete(BrandTransfer $brandTransfer);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer $brandTransfer|null
     */
    public function findById(BrandTransfer $brandTransfer);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer $brandTransfer|null
     */
    public function findByName(BrandTransfer $brandTransfer);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function hasBrand(BrandTransfer $brandTransfer): bool;
}
