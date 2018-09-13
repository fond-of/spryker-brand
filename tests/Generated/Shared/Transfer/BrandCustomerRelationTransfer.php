<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class BrandCustomerRelationTransfer extends AbstractTransfer
{
    const ID_BRAND = 'idBrand';

    const CUSTOMER_IDS = 'customerIds';

    /**
     * @var int|null
     */
    protected $idBrand;

    /**
     * @var int[]
     */
    protected $customerIds;

    /**
     * @var array
     */
    protected $transferPropertyNameMap = [
        'id_brand' => 'idBrand',
        'idBrand' => 'idBrand',
        'IdBrand' => 'idBrand',
        'customer_ids' => 'customerIds',
        'customerIds' => 'customerIds',
        'CustomerIds' => 'customerIds',
    ];

    /**
     * @var array
     */
    protected $transferMetadata = [
        self::ID_BRAND => [
            'type' => 'int',
            'name_underscore' => 'id_brand',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::CUSTOMER_IDS => [
            'type' => 'int[]',
            'name_underscore' => 'customer_ids',
            'is_collection' => false,
            'is_transfer' => false,
        ],
    ];

    /**
     * @module BrandCustomer
     *
     * @param int|null $idBrand
     *
     * @return $this
     */
    public function setIdBrand($idBrand)
    {
        $this->idBrand = $idBrand;
        $this->modifiedProperties[self::ID_BRAND] = true;

        return $this;
    }

    /**
     * @module BrandCustomer
     *
     * @return int|null
     */
    public function getIdBrand()
    {
        return $this->idBrand;
    }

    /**
     * @module BrandCustomer
     *
     * @return $this
     */
    public function requireIdBrand()
    {
        $this->assertPropertyIsSet(self::ID_BRAND);

        return $this;
    }

    /**
     * @module BrandCustomer
     *
     * @param int[]|null $customerIds
     *
     * @return $this
     */
    public function setCustomerIds(array $customerIds = null)
    {
        if ($customerIds === null) {
            $customerIds = [];
        }

        $this->customerIds = $customerIds;
        $this->modifiedProperties[self::CUSTOMER_IDS] = true;

        return $this;
    }

    /**
     * @module BrandCustomer
     *
     * @return int[]
     */
    public function getCustomerIds()
    {
        return $this->customerIds;
    }

    /**
     * @module BrandCustomer
     *
     * @param int $customerIds
     *
     * @return $this
     */
    public function addCustomerIds($customerIds)
    {
        $this->customerIds[] = $customerIds;
        $this->modifiedProperties[self::CUSTOMER_IDS] = true;

        return $this;
    }

    /**
     * @module BrandCustomer
     *
     * @return $this
     */
    public function requireCustomerIds()
    {
        $this->assertPropertyIsSet(self::CUSTOMER_IDS);

        return $this;
    }
}
