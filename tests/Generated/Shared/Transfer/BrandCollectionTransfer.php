<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use ArrayObject;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class BrandCollectionTransfer extends AbstractTransfer
{
    const BRANDS = 'brands';

    const FILTER = 'filter';

    const PAGINATION = 'pagination';

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[]|null
     */
    protected $brands;

    /**
     * @var \Generated\Shared\Transfer\FilterTransfer|null
     */
    protected $filter;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|null
     */
    protected $pagination;

    /**
     * @var array
     */
    protected $transferPropertyNameMap = [
        'brands' => 'brands',
        'Brands' => 'brands',
        'filter' => 'filter',
        'Filter' => 'filter',
        'pagination' => 'pagination',
        'Pagination' => 'pagination',
    ];

    /**
     * @var array
     */
    protected $transferMetadata = [
        self::BRANDS => [
            'type' => 'Generated\Shared\Transfer\BrandTransfer',
            'name_underscore' => 'brands',
            'is_collection' => true,
            'is_transfer' => true,
        ],
        self::FILTER => [
            'type' => 'Generated\Shared\Transfer\FilterTransfer',
            'name_underscore' => 'filter',
            'is_collection' => false,
            'is_transfer' => true,
        ],
        self::PAGINATION => [
            'type' => 'Generated\Shared\Transfer\PaginationTransfer',
            'name_underscore' => 'pagination',
            'is_collection' => false,
            'is_transfer' => true,
        ],
    ];

    /**
     * @module BrandCustomer|Brand
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[] $brands
     *
     * @return $this
     */
    public function setBrands(ArrayObject $brands)
    {
        $this->brands = $brands;
        $this->modifiedProperties[self::BRANDS] = true;

        return $this;
    }

    /**
     * @module BrandCustomer|Brand
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[]|null
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @module BrandCustomer|Brand
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brand
     *
     * @return $this
     */
    public function addBrand(BrandTransfer $brand)
    {
        $this->brands[] = $brand;
        $this->modifiedProperties[self::BRANDS] = true;

        return $this;
    }

    /**
     * @module BrandCustomer|Brand
     *
     * @return $this
     */
    public function requireBrands()
    {
        $this->assertCollectionPropertyIsSet(self::BRANDS);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param \Generated\Shared\Transfer\FilterTransfer|null $filter
     *
     * @return $this
     */
    public function setFilter(FilterTransfer $filter = null)
    {
        $this->filter = $filter;
        $this->modifiedProperties[self::FILTER] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return \Generated\Shared\Transfer\FilterTransfer|null
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireFilter()
    {
        $this->assertPropertyIsSet(self::FILTER);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param \Generated\Shared\Transfer\PaginationTransfer|null $pagination
     *
     * @return $this
     */
    public function setPagination(PaginationTransfer $pagination = null)
    {
        $this->pagination = $pagination;
        $this->modifiedProperties[self::PAGINATION] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return \Generated\Shared\Transfer\PaginationTransfer|null
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requirePagination()
    {
        $this->assertPropertyIsSet(self::PAGINATION);

        return $this;
    }
}
