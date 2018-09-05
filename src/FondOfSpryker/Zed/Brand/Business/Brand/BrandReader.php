<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface;

class BrandReader implements BrandReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface
     */
    protected $brandEntityManager;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface
     */
    protected $brandRepository;

    /**
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface $brandEntityManager
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface $brandRepository
     */
    public function __construct(
        BrandEntityManagerInterface $brandEntityManager,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->brandEntityManager = $brandEntityManager;
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer
    {
        return $this->brandRepository->getBrandCollection($brandCollectionTransfer);
    }
}
