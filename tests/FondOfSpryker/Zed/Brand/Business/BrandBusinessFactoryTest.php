<?php

namespace FondOfSpryker\Zed\Brand\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\BrandConfig;
use FondOfSpryker\Zed\Brand\BrandDependencyProvider;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface;
use FondOfSpryker\Zed\Brand\Business\Brand\BrandReaderInterface;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManager;
use FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainer;
use FondOfSpryker\Zed\Brand\Persistence\BrandRepository;
use Spryker\Zed\Kernel\Container;

class BrandBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandBusinessFactory
     */
    protected $brandBusinessFactory;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\BrandConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->with(BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER)
            ->willReturn([]);

        $this->queryContainerMock = $this->getMockBuilder(BrandQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(BrandRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(BrandEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandConfigMock = $this->getMockBuilder(BrandConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandBusinessFactory = new BrandBusinessFactory();
        $this->brandBusinessFactory->setConfig($this->brandConfigMock);
        $this->brandBusinessFactory->setContainer($this->containerMock);
        $this->brandBusinessFactory->setRepository($this->repositoryMock);
        $this->brandBusinessFactory->setEntityManager($this->entityManagerMock);
        $this->brandBusinessFactory->setQueryContainer($this->queryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateBrand(): void
    {
        $brand = $this->brandBusinessFactory->createBrand();
        $this->assertInstanceOf(BrandInterface::class, $brand);
    }

    /**
     * @return void
     */
    public function testCreateReader(): void
    {
        $reader = $this->brandBusinessFactory->createBrandReader();
        $this->assertInstanceOf(BrandReaderInterface::class, $reader);
    }

    /**
     * @return void
     */
    public function testCreateBrandExpander(): void
    {
        $expander = $this->brandBusinessFactory->createBrandExpander();
        $this->assertInstanceOf(BrandExpanderInterface::class, $expander);
    }
}
