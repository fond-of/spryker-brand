<?php

namespace FondOfSpryker\Zed\Brand\Persistence;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface BrandQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @api
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function queryBrand();

    /**
     * @api
     *
     * @param int $id
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function queryBrandById(int $id);

    /**
     * @api
     *
     * @param string $name
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function queryBrandByName(string $name);
}
