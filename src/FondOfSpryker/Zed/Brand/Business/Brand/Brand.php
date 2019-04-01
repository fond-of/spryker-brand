<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use FondOfSpryker\Zed\Brand\BrandConfig;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Business\Exception\BrandNotFoundException;
use FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;

class Brand implements BrandInterface
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\Brand\BrandConfig
     */
    protected $brandConfig;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface
     */
    protected $brandExpander;

    /**
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\Brand\BrandConfig $brandConfig
     * @param \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface $brandExpander
     */
    public function __construct(
        BrandQueryContainerInterface $queryContainer,
        BrandConfig $brandConfig,
        BrandExpanderInterface $brandExpander
    ) {
        $this->queryContainer = $queryContainer;
        $this->brandConfig = $brandConfig;
        $this->brandExpander = $brandExpander;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function add(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        $brandEntity = $this->createFosBrandEntity($brandTransfer);
        $brandEntity->save();

        $brandTransfer->setIdBrand($brandEntity->getPrimaryKey());

        $brandResponseTransfer = new BrandResponseTransfer();
        $brandResponseTransfer
            ->setIsSuccess(true)
            ->setBrandTransfer($brandTransfer);

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    protected function createFosBrandEntity(BrandTransfer $brandTransfer): FosBrand
    {
        $brandEntity = new FosBrand();
        $brandEntity->fromArray($brandTransfer->toArray());

        return $brandEntity;
    }

    /**
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function createBrandResponseTransfer($isSuccess = true): BrandResponseTransfer
    {
        $brandResponseTransfer = new BrandResponseTransfer();
        $brandResponseTransfer->setIsSuccess($isSuccess);

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function delete(BrandTransfer $brandTransfer): bool
    {
        $brandEntity = $this->getBrand($brandTransfer);
        $brandEntity->delete();

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function get(BrandTransfer $brandTransfer): BrandTransfer
    {
        $brandEntity = $this->getBrand($brandTransfer);
        $brandTransfer->fromArray($brandEntity->toArray(), true);
        $brandTransfer = $this->brandExpander->expand($brandTransfer);

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function update(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        $brandEntity = $this->getBrand($brandTransfer);
        $brandEntity->fromArray($brandTransfer->modifiedToArray());
        $brandEntity->save();

        $brandResponseTransfer = new BrandResponseTransfer();
        $brandResponseTransfer->setIsSuccess(true);
        $brandResponseTransfer->setBrandTransfer($brandTransfer);
        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null $brandTransfer|null
     */
    public function findById(BrandTransfer $brandTransfer): ?BrandTransfer
    {
        try {
            $brandTransfer->requireIdBrand();
            return $this->get($brandTransfer);
        } catch (BrandNotFoundException $e) {
            return null;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findByName(BrandTransfer $brandTransfer): ?BrandTransfer
    {
        try {
            $brandTransfer->requireName();
            return $this->get($brandTransfer);
        } catch (BrandNotFoundException $e) {
            return null;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function hasBrand(BrandTransfer $brandTransfer): bool
    {
        try {
            $this->getBrand($brandTransfer);
            return true;
        } catch (BrandNotFoundException $e) {
            return false;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @throws \FondOfSpryker\Zed\Brand\Business\Exception\BrandNotFoundException
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    protected function getBrand(BrandTransfer $brandTransfer): FosBrand
    {
        $brandEntity = null;

        if ($brandTransfer->getIdBrand()) {
            $brandEntity = $this->queryContainer->queryBrandById($brandTransfer->getIdBrand())
                ->findOne();
        } elseif ($brandTransfer->getName()) {
            $brandEntity = $this->queryContainer->queryBrandByName($brandTransfer->getName())
                ->findOne();
        }

        if ($brandEntity !== null) {
            return $brandEntity;
        }

        throw new BrandNotFoundException(sprintf('Brand not found by either ID `%s` or name `%s`.', $brandTransfer->getIdBrand(), $brandTransfer->getName()));
    }
}
