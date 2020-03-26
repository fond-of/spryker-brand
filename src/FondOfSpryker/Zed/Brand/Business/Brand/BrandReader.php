<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

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
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface
     */
    protected $brandExpander;

    /**
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface $brandEntityManager
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface $brandRepository
     * @param \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface $brandExpander
     */
    public function __construct(
        BrandEntityManagerInterface $brandEntityManager,
        BrandRepositoryInterface $brandRepository,
        BrandExpanderInterface $brandExpander
    ) {
        $this->brandEntityManager = $brandEntityManager;
        $this->brandRepository = $brandRepository;
        $this->brandExpander = $brandExpander;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer
    {
        $brandCollectionTransfer = $this->brandRepository->getBrandCollection($brandCollectionTransfer);

        return $this->expandBrandCollectionTransfer($brandCollectionTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        $brandCollectionTransfer = $this->brandRepository->getActiveBrands();

        return $this->expandBrandCollectionTransfer($brandCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected function expandBrandCollectionTransfer(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer
    {
        if (!empty($brandCollectionTransfer->getBrands())) {
            foreach ($brandCollectionTransfer->getBrands() as $brandTransfer) {
                $this->brandExpander->expand($brandTransfer);
            }
        }

        return $brandCollectionTransfer;
    }
}
