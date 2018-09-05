<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use FondOfSpryker\Zed\Brand\Persistence\Mapper\BrandMapper;
use FondOfSpryker\Zed\Brand\Persistence\Mapper\BrandMapperInterface;
use Orm\Zed\Brand\Persistence\FosBrandQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use FondOfSpryker\Zed\Brand\BrandDependencyProvider;

/**
 * @method \FondOfSpryker\Zed\Brand\BrandConfig getConfig()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface getQueryContainer()
 */
class BrandPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function createBrandQuery()
    {
        return FosBrandQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Persistence\Mapper\BrandMapperInterface
     */
    public function createBrandMapper(): BrandMapperInterface
    {
        return new BrandMapper();
    }
}
