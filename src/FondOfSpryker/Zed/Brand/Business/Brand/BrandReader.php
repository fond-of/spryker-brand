<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

class BrandReader implements BrandReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface
     */
    protected $brandExpander;

    /**
     * @var array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\SearchBrandQueryExpanderPluginInterface>
     */
    protected $searchBrandQueryExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface $entityManager
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface $brandExpander
     * @param array $searchBrandQueryExpanderPlugins
     */
    public function __construct(
        BrandEntityManagerInterface $entityManager,
        BrandRepositoryInterface $repository,
        BrandExpanderInterface $brandExpander,
        array $searchBrandQueryExpanderPlugins = []
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->brandExpander = $brandExpander;
        $this->searchBrandQueryExpanderPlugins = $searchBrandQueryExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer
    {
        $brandCollectionTransfer = $this->repository->getBrandCollection($brandCollectionTransfer);

        return $this->expandBrandCollectionTransfer($brandCollectionTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        $brandCollectionTransfer = $this->repository->getActiveBrands();

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

    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findByBrandList(BrandListTransfer $brandListTransfer): BrandListTransfer
    {
        $brandListTransfer = $this->executeSearchBrandQueryExpanderPlugins($brandListTransfer);

        return $this->repository->findBrands($brandListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    protected function executeSearchBrandQueryExpanderPlugins(BrandListTransfer $brandListTransfer): BrandListTransfer
    {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $brandListTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchBrandQueryExpanderPlugins as $searchBrandQueryExpanderPlugin) {
            if ($searchBrandQueryExpanderPlugin->isApplicable($filterTransfers)) {
                $queryJoinCollectionTransfer = $searchBrandQueryExpanderPlugin->expand(
                    $filterTransfers,
                    $queryJoinCollectionTransfer
                );
            }
        }

        return $brandListTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }
}
