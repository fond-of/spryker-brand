<?php

namespace FondOfSpryker\Zed\Brand\Business\Brand;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\BrandConfig;
use FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface;
use FondOfSpryker\Zed\Brand\Business\Exception\BrandNotFoundException;
use FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface;
use FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainer;
use Generated\Shared\Transfer\BrandTransfer;
use ReflectionMethod;

class BrandTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Brand\Business\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \FondOfSpryker\Zed\Brand\BrandConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandConfig;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandExpander\BrandExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandExpanderMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandEntityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\BrandTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandTransferMock;

    /**
     * @var \Orm\Zed\Brand\Persistence\FosBrand|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandConfig = $this->getMockBuilder(BrandConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandExpanderMock = $this->getMockForAbstractClass(BrandExpanderInterface::class);

        $this->queryContainerMock = $this->getMockBuilder(BrandQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandEntityManagerMock = $this->getMockBuilder(BrandEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityMock = $this->getMockBuilder('\Orm\Zed\Brand\Persistence\FosBrand')
            ->setMethods(['delete', 'save', 'requireName', 'toArray', 'fromArray'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->brand = new Brand(
            $this->queryContainerMock,
            $this->brandEntityManagerMock,
            $this->brandConfig,
            $this->brandExpanderMock
        );
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrandQuery|null $entity
     *
     * @return void
     */
    protected function prepareGetBrandMethod($entity = null): void
    {
        $entityQuery = $this->getMockBuilder('\Orm\Zed\Brand\Persistence\FosBrandQuery')
            ->setMethods(['findOne'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock
            ->expects($this->atLeastOnce())
            ->method('getIdBrand')
            ->willReturn(1);

        $entityQuery
            ->expects($this->once())
            ->method('findOne')
            ->willReturn($entity);

        $this->queryContainerMock
            ->expects($this->once())
            ->method('queryBrandById')
            ->willReturn($entityQuery);
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrandQuery|null $entity
     *
     * @return void
     */
    protected function prepareGetBrandMethodName($entity = null): void
    {
        $entityQuery = $this->getMockBuilder('\Orm\Zed\Brand\Persistence\FosBrandQuery')
            ->setMethods(['findOne'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock
            ->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn('test');

        $entityQuery
            ->expects($this->once())
            ->method('findOne')
            ->willReturn($entity);

        $this->queryContainerMock
            ->expects($this->once())
            ->method('queryBrandByName')
            ->willReturn($entityQuery);
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->entityMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $this->prepareGetBrandMethod($this->entityMock);

        $this->brandExpanderMock
            ->expects($this->once())
            ->method('expand')
            ->willReturn($this->brandTransferMock);

        $this->brand->get($this->brandTransferMock);
    }

    /**
     * @return void
     */
    public function testFindById(): void
    {
        $this->brandTransferMock
            ->expects($this->once())
            ->method('requireIdBrand');

        $this->entityMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $this->prepareGetBrandMethod($this->entityMock);

        $response = $this->brand->findById($this->brandTransferMock);
        $this->assertInstanceOf(BrandTransfer::class, $response);
    }

    /**
     * @return void
     */
    public function testFindByIdNull(): void
    {
        $this->prepareGetBrandMethod(null);

        $response = $this->brand->findById($this->brandTransferMock);
        $this->assertNull($response);
    }

    /**
     * @return void
     */
    public function testFindByName(): void
    {
        $this->brandTransferMock
            ->expects($this->once())
            ->method('requireName');

        $this->entityMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $this->prepareGetBrandMethodName($this->entityMock);

        $response = $this->brand->findByName($this->brandTransferMock);
        $this->assertInstanceOf(BrandTransfer::class, $response);
    }

    /**
     * @return void
     */
    public function testFindByNameNull(): void
    {
        $this->prepareGetBrandMethodName(null);

        $response = $this->brand->findByName($this->brandTransferMock);
        $this->assertNull($response);
    }

    /**
     * @return void
     */
    public function testHasBrandTrue(): void
    {
        $this->prepareGetBrandMethod($this->entityMock);

        $response = $this->brand->hasBrand($this->brandTransferMock);
        $this->assertTrue($response);
    }

    /**
     * @return void
     */
    public function testHasBrandFalse(): void
    {
        $this->prepareGetBrandMethod(null);

        $response = $this->brand->hasBrand($this->brandTransferMock);
        $this->assertFalse($response);
    }

    /**
     * @return void
     */
    public function testGetBrandNotFoundException(): void
    {
        $this->brandTransferMock
            ->expects($this->atLeastOnce())
            ->method('getIdBrand')
            ->willReturn(null);

        $this->brandTransferMock
            ->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn(null);

        $method = new ReflectionMethod(Brand::class, 'getBrand');
        $method->setAccessible(true);

        $this->expectException(BrandNotFoundException::class);
        $this->expectExceptionMessage('Brand not found by either ID');

        $method->invoke($this->brand, $this->brandTransferMock);
    }

    /**
     * @return void
     */
    public function testGetBrandNotFoundExceptionById(): void
    {
        $this->prepareGetBrandMethod(null);

        $method = new ReflectionMethod(Brand::class, 'getBrand');
        $method->setAccessible(true);

        $this->expectException(BrandNotFoundException::class);
        $this->expectExceptionMessage('Brand not found by either ID');

        $method->invoke($this->brand, $this->brandTransferMock);
    }

    /**
     * @return void
     */
    public function testGetBrandNotFoundExceptionByName(): void
    {
        $this->prepareGetBrandMethodName(null);

        $method = new ReflectionMethod(Brand::class, 'getBrand');
        $method->setAccessible(true);

        $this->expectException(BrandNotFoundException::class);
        $this->expectExceptionMessage('Brand not found by either ID');

        $method->invoke($this->brand, $this->brandTransferMock);
    }
}
