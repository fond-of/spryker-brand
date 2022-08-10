<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use ArrayObject;
use FondOfSpryker\Zed\Brand\BrandConfig;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Business\Exception\BrandNotFoundException;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class Brand implements BrandInterface
{
    use TransactionTrait;

    /**
     * @var string
     */
    protected const MESSAGE_BRAND_DELETE_SUCCESS = 'Brand has been successfully removed.';

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface
     */
    protected $brandEntityManager;

    /**
     * @var \FondOfSpryker\Zed\Brand\BrandConfig
     */
    protected $brandConfig;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface
     */
    protected $brandExpander;

    /**
     * @var array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostSavePluginInterface>
     */
    protected $brandPostSavers;

    /**
     * @var array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostDeletePluginInterface>
     */
    protected $brandPostDeletePlugins;

    /**
     * @var array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPreCreatePluginInterface>
     */
    protected $brandPreCreatePlugins;

    /**
     * @var array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandDeletePreCheckPluginInterface>
     */
    protected $brandDeletePreCheckPlugins;

    /**
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface $queryContainer
     * @param \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface $brandEntityManager
     * @param \FondOfSpryker\Zed\Brand\BrandConfig $brandConfig
     * @param \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface $brandExpander
     * @param array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPreCreatePluginInterface> $brandPreCreatePlugins
     * @param array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostDeletePluginInterface> $brandPostDeletePlugins
     * @param array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostSavePluginInterface> $brandPostSavePlugins
     * @param array<\FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandDeletePreCheckPluginInterface> $brandDeletePreCheckPlugins
     */
    public function __construct(
        BrandQueryContainerInterface $queryContainer,
        BrandEntityManagerInterface $brandEntityManager,
        BrandConfig $brandConfig,
        BrandExpanderInterface $brandExpander,
        array $brandPreCreatePlugins = [],
        array $brandPostDeletePlugins = [],
        array $brandPostSavePlugins = [],
        array $brandDeletePreCheckPlugins = []
    ) {
        $this->queryContainer = $queryContainer;
        $this->brandEntityManager = $brandEntityManager;
        $this->brandConfig = $brandConfig;
        $this->brandExpander = $brandExpander;
        $this->brandPostSavers = $brandPostSavePlugins;
        $this->brandPostDeletePlugins = $brandPostDeletePlugins;
        $this->brandPreCreatePlugins = $brandPreCreatePlugins;
        $this->brandDeletePreCheckPlugins = $brandDeletePreCheckPlugins;
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
            ->setIsSuccessful(true)
            ->setBrandTransfer($brandTransfer);

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function createBrand(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getTransactionHandler()->handleTransaction(function () use ($brandTransfer) {
            return $this->executeCreateBrandTransaction($brandTransfer);
        });
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
        $brandResponseTransfer->setIsSuccessful($isSuccess);

        return $brandResponseTransfer;
    }

    /**
     * @deprecated
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return bool
     */
    public function delete(BrandTransfer $brandTransfer): bool
    {
        $this->deleteBrand($brandTransfer);

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function deleteBrand(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        $brandResponseTransfer = (new BrandResponseTransfer())
            ->setBrand($brandTransfer)
            ->setIsSuccessful(true);

        $brandResponseTransfer = $this->executeBrandDeletePreCheckPlugins($brandResponseTransfer);

        if (!$brandResponseTransfer->getIsSuccessful()) {
            return $brandResponseTransfer;
        }

        return $this->getTransactionHandler()->handleTransaction(function () use ($brandTransfer, $brandResponseTransfer) {
            return $this->executeDeleteBrandTransaction($brandTransfer, $brandResponseTransfer);
        });
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
        return $this->getTransactionHandler()->handleTransaction(function () use ($brandTransfer) {
            return $this->executeUpdateBrandTransaction($brandTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeCreateBrandTransaction(
        BrandTransfer $brandTransfer
    ): BrandResponseTransfer {
        $brandTransfer->requireName();

        $brandResponseTransfer = (new BrandResponseTransfer())->setBrand($brandTransfer);
        $brandResponseTransfer = $this->executeBrandPreCreatePlugins($brandResponseTransfer);
        $brandTransfer = $this->brandEntityManager->createBrand($brandResponseTransfer->getBrand());
        $brandTransfer = $this->executeBrandPostSavePlugins($brandTransfer);

        return $brandResponseTransfer
            ->setBrand($brandTransfer)
            ->setIsSuccessful(true);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeUpdateBrandTransaction(
        BrandTransfer $brandTransfer
    ): BrandResponseTransfer {
        $brandResponseTransfer = (new BrandResponseTransfer())->setBrandTransfer($brandTransfer);

        $brandEntity = $this->getBrand($brandTransfer);
        $brandEntity->fromArray($brandTransfer->modifiedToArray());
        $brandEntity->save();

        $brandTransfer = $this->executeBrandPostSavePlugins($brandTransfer);

        return $brandResponseTransfer
            ->setBrandTransfer($brandTransfer)
            ->setIsSuccessful(true);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeBrandPreCreatePlugins(BrandResponseTransfer $brandResponseTransfer): BrandResponseTransfer
    {
        foreach ($this->brandPreCreatePlugins as $brandPreCreatePlugin) {
            $resultBrandResponseTransfer = $brandPreCreatePlugin->execute($brandResponseTransfer->getBrand());
            $brandResponseTransfer = $this->mergeBrandResponseMessages($brandResponseTransfer, $resultBrandResponseTransfer);
            $brandResponseTransfer->setBrand($resultBrandResponseTransfer->getBrand());
        }

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeBrandDeletePreCheckPlugins(BrandResponseTransfer $brandResponseTransfer): BrandResponseTransfer
    {
        foreach ($this->brandDeletePreCheckPlugins as $brandDeletePreCheckPlugin) {
            $resultBrandResponseTransfer = $brandDeletePreCheckPlugin->execute($brandResponseTransfer->getBrand());
            $brandResponseTransfer = $this->mergeBrandResponseTransfers($brandResponseTransfer, $resultBrandResponseTransfer);
        }

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    protected function executeBrandPostSavePlugins(BrandTransfer $brandTransfer): BrandTransfer
    {
        foreach ($this->brandPostSavers as $brandPostSaver) {
            $brandTransfer = $brandPostSaver->execute($brandTransfer);
        }

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeDeleteBrandTransaction(
        BrandTransfer $brandTransfer,
        BrandResponseTransfer $brandResponseTransfer
    ): BrandResponseTransfer {
        $this->brandEntityManager->deleteBrand($brandTransfer);

        $brandResponseTransfer = $this->executeBrandPostDeletePlugins($brandTransfer, $brandResponseTransfer);

        $brandResponseTransfer->addMessage(
            (new MessageTransfer())->setValue(static::MESSAGE_BRAND_DELETE_SUCCESS),
        );

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeBrandPostDeletePlugins(
        BrandTransfer $brandTransfer,
        BrandResponseTransfer $brandResponseTransfer
    ): BrandResponseTransfer {
        foreach ($this->brandPostDeletePlugins as $brandPostDeletePlugin) {
            $brandResponseTransfer = $brandPostDeletePlugin->execute($brandTransfer);
        }

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
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

    /**
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $resultBrandResponseTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function mergeBrandResponseMessages(
        BrandResponseTransfer $brandResponseTransfer,
        BrandResponseTransfer $resultBrandResponseTransfer
    ): BrandResponseTransfer {
        $messageTransfers = array_merge(
            $brandResponseTransfer->getMessages()->getArrayCopy(),
            $resultBrandResponseTransfer->getMessages()->getArrayCopy(),
        );

        return $brandResponseTransfer
            ->setMessages(new ArrayObject($messageTransfers));
    }

    /**
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer
     * @param \Generated\Shared\Transfer\BrandResponseTransfer $resultBrandResponseTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function mergeBrandResponseTransfers(
        BrandResponseTransfer $brandResponseTransfer,
        BrandResponseTransfer $resultBrandResponseTransfer
    ): BrandResponseTransfer {
        $brandResponseTransfer = $this->mergeBrandResponseMessages(
            $brandResponseTransfer,
            $resultBrandResponseTransfer,
        );

        return $brandResponseTransfer->setIsSuccessful(
            $brandResponseTransfer->getIsSuccessful() && $resultBrandResponseTransfer->getIsSuccessful(),
        );
    }
}
