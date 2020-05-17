<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Brand\Persistence\FosBrandQuery;
use Propel\Runtime\Formatter\ArrayFormatter;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\Propel\PropelFilterCriteria;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

/**
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandPersistenceFactory getFactory()
 */
class BrandRepository extends AbstractRepository implements BrandRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandCollection(BrandCollectionTransfer $brandCollectionTransfer): BrandCollectionTransfer
    {
        $brandQuery = $this->getFactory()
            ->createBrandQuery();

        $brandQuery = $this->applyFilterToQuery($brandQuery, $brandCollectionTransfer->getFilter());
        $brandQuery = $this->applyPagination($brandQuery, $brandCollectionTransfer->getPagination());
        $brandQuery->setFormatter(ArrayFormatter::class);
        $this->hydrateBrandListWithBrands($brandCollectionTransfer, $brandQuery->find()->getData());

        return $brandCollectionTransfer;
    }

    /**
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandByName(string $name): ?BrandTransfer
    {
        $spyBrand = $this->getFactory()
            ->createBrandQuery()
            ->filterByName($name)
            ->findOne();

        if ($spyBrand === null) {
            return null;
        }

        $brand = (new BrandTransfer())->fromArray(
            $spyBrand->toArray(),
            true
        );

        return $brand;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrandQuery $fosBrandQuery
     * @param \Generated\Shared\Transfer\FilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    protected function applyFilterToQuery(FosBrandQuery $fosBrandQuery, ?FilterTransfer $filterTransfer): FosBrandQuery
    {
        $criteria = new Criteria();
        if ($filterTransfer !== null) {
            $criteria = (new PropelFilterCriteria($filterTransfer))
                ->toCriteria();
        }

        $fosBrandQuery->mergeWith($criteria);

        return $fosBrandQuery;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrandQuery $fosBrandQuery
     * @param \Generated\Shared\Transfer\PaginationTransfer|null $paginationTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    protected function applyPagination(FosBrandQuery $fosBrandQuery, ?PaginationTransfer $paginationTransfer = null): FosBrandQuery
    {
        if (empty($paginationTransfer)) {
            return $fosBrandQuery;
        }

        $page = $paginationTransfer
            ->requirePage()
            ->getPage();

        $maxPerPage = $paginationTransfer
            ->requireMaxPerPage()
            ->getMaxPerPage();

        $paginationModel = $fosBrandQuery->paginate($page, $maxPerPage);

        $paginationTransfer->setNbResults($paginationModel->getNbResults());
        $paginationTransfer->setFirstIndex($paginationModel->getFirstIndex());
        $paginationTransfer->setLastIndex($paginationModel->getLastIndex());
        $paginationTransfer->setFirstPage($paginationModel->getFirstPage());
        $paginationTransfer->setLastPage($paginationModel->getLastPage());
        $paginationTransfer->setNextPage($paginationModel->getNextPage());
        $paginationTransfer->setPreviousPage($paginationModel->getPreviousPage());

        return $paginationModel->getQuery();
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCollectionTransfer $brandListTransfer
     * @param array $brands
     *
     * @return void
     */
    protected function hydrateBrandListWithBrands(BrandCollectionTransfer $brandListTransfer, array $brands): void
    {
        $brandCollection = new ArrayObject();

        foreach ($brands as $brand) {
            $brandCollection->append(
                $this->getFactory()
                    ->createBrandMapper()
                    ->mapBrandEntityToBrand($brand)
            );
        }

        $brandListTransfer->setBrands($brandCollection);
    }

    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        $query = $this->getFactory()
            ->createBrandQuery()
            ->filterByIsActive(true);

        $brandEntityCollectionTransfer = $this->buildQueryFromCriteria($query)->find();

        return $this->getFactory()->createBrandMapper()->mapCollectionTransfer($brandEntityCollectionTransfer);
    }
}
