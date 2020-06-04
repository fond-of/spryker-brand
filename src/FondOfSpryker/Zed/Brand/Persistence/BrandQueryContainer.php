<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\Brand\Persistence\BrandPersistenceFactory getFactory()
 */
class BrandQueryContainer extends AbstractQueryContainer implements BrandQueryContainerInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function queryBrand()
    {
        return $this->getFactory()->createBrandQuery();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $id
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function queryBrandById(int $id)
    {
        return $this->getFactory()->createBrandQuery()
            ->filterByIdBrand($id);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $name
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function queryBrandByName(string $name)
    {
        return $this->getFactory()->createBrandQuery()
            ->filterByName($name);
    }
}
