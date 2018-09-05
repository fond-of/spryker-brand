<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;
use FondOfSpryker\Zed\Brand\Business\Exception\BrandNotFoundException;
use FondOfSpryker\Zed\Brand\BrandConfig;
use FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface;

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
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\Brand\BrandConfig $brandConfig
     */
    public function __construct(
        BrandQueryContainerInterface $queryContainer,
        BrandConfig $brandConfig
    ) {
        $this->queryContainer = $queryContainer;
        $this->brandConfig = $brandConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function get(BrandTransfer $brandTransfer)
    {
        $brandEntity = $this->getBrand($brandTransfer);
        $brandTransfer->fromArray($brandEntity->toArray(), true);

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function add(BrandTransfer $brandTransfer)
    {
        $brandEntity = new FosBrand();
        $brandEntity->fromArray($brandTransfer->toArray());
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
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function update(BrandTransfer $brandTransfer)
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
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function delete(BrandTransfer $brandTransfer)
    {
        $brandEntity = $this->getBrand($brandTransfer);
        $brandEntity->delete();

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null $brandTransfer|null
     */
    public function findById(BrandTransfer $brandTransfer)
    {
        $brandTransfer->requireIdBrand();
        $brandEntity = $this->queryContainer->queryBrandById($brandTransfer->getIdBrand())->findOne();

        if ($brandEntity === null) {
            return null;
        }

        return $brandTransfer->fromArray($brandEntity->toArray(), true);;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findByName(BrandTransfer $brandTransfer)
    {
        $brandEntity = $this->queryContainer
            ->queryBrandByName($brandTransfer->getName())
            ->findOne();

        if ($brandEntity === null) {
            return null;
        }

        $brandTransfer = new BrandTransfer();
        return $brandTransfer->fromArray($brandEntity->toArray(), true);;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function hasBrand(BrandTransfer $brandTransfer): bool
    {
        $result = false;
        $brandEntity = null;

        if ($brandTransfer->getIdBrand()) {
            $brandEntity = $this->queryContainer
                ->queryBrandById($brandTransfer->getIdBrand())
                ->findOne();
        } elseif ($brandTransfer->getName()) {
            $brandEntity = $this->queryContainer
                ->queryBrandByName($brandTransfer->getName())
                ->findOne();
        }

        if ($brandEntity !== null) {
            $result = true;
        }

        return $result;
    }

    /**
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function createBrandResponseTransfer($isSuccess = true)
    {
        $brandResponseTransfer = new BrandResponseTransfer();
        $brandResponseTransfer->setIsSuccess($isSuccess);

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @throws \FondOfSpryker\Zed\Brand\Business\Exception\BrandNotFoundException
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    protected function getBrand(BrandTransfer $brandTransfer)
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

        throw new BrandNotFoundException(sprintf(
            'Brand not found by either ID `%s` or name `%s`.',
            $brandTransfer->getIdBrand(),
            $brandTransfer->getName()
        ));
    }
}
