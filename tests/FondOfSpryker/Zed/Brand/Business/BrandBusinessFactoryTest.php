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
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER],
                [BrandDependencyProvider::PLUGINS_BRAND_PRE_CREATE],
                [BrandDependencyProvider::PLUGINS_BRAND_POST_DELETE],
                [BrandDependencyProvider::PLUGINS_BRAND_POST_SAVE],
                [BrandDependencyProvider::PLUGINS_BRAND_DELETE_PRE_CHECK]
            )->willReturnOnConsecutiveCalls(true, true, true, true, true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER],
                [BrandDependencyProvider::PLUGINS_BRAND_PRE_CREATE],
                [BrandDependencyProvider::PLUGINS_BRAND_POST_DELETE],
                [BrandDependencyProvider::PLUGINS_BRAND_POST_SAVE],
                [BrandDependencyProvider::PLUGINS_BRAND_DELETE_PRE_CHECK]
            )->willReturnOnConsecutiveCalls([], [], [], [], []);

        $brand = $this->brandBusinessFactory->createBrand();
        $this->assertInstanceOf(BrandInterface::class, $brand);
    }

    /**
     * @return void
     */
    public function testCreateReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER],
                [BrandDependencyProvider::PLUGINS_SEARCH_BRAND_QUERY_EXPANDER]
            )->willReturnOnConsecutiveCalls(true, true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER],
                [BrandDependencyProvider::PLUGINS_SEARCH_BRAND_QUERY_EXPANDER]
            )->willReturnOnConsecutiveCalls([], []);

        $reader = $this->brandBusinessFactory->createBrandReader();
        $this->assertInstanceOf(BrandReaderInterface::class, $reader);
    }

    /**
     * @return void
     */
    public function testCreateBrandExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER]
            )->willReturnOnConsecutiveCalls(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BrandDependencyProvider::PLUGINS_BRAND_TRANSFER_EXPANDER]
            )->willReturnOnConsecutiveCalls([]);


        $expander = $this->brandBusinessFactory->createBrandExpander();
        $this->assertInstanceOf(BrandExpanderInterface::class, $expander);
    }
}
