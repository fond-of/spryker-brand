<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use FondOfSpryker\Zed\Brand\Persistence\Propel\Mapper\BrandMapper;
use FondOfSpryker\Zed\Brand\Persistence\Propel\Mapper\BrandMapperInterface;
use FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder\BrandQueryJoinQueryBuilder;
use FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder\BrandQueryJoinQueryBuilderInterface;
use FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder\BrandSearchFilterFieldQueryBuilder;
use FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder\BrandSearchFilterFieldQueryBuilderInterface;
use Orm\Zed\Brand\Persistence\FosBrandQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\Brand\BrandConfig getConfig()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandRepositoryInterface getRepository()
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
     * @return \FondOfSpryker\Zed\Brand\Persistence\Propel\Mapper\BrandMapperInterface
     */
    public function createBrandMapper(): BrandMapperInterface
    {
        return new BrandMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder\BrandQueryJoinQueryBuilderInterface
     */
    public function createBrandQueryJoinQueryBuilder(): BrandQueryJoinQueryBuilderInterface
    {
        return new BrandQueryJoinQueryBuilder();
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder\BrandSearchFilterFieldQueryBuilderInterface
     */
    public function createBrandSearchFilterFieldQueryBuilder(): BrandSearchFilterFieldQueryBuilderInterface
    {
        return new BrandSearchFilterFieldQueryBuilder(
            $this->getConfig()
        );
    }
}
