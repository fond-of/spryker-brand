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
class BrandTransfer extends AbstractTransfer
{
    const BRAND_CUSTOMER_RELATION = 'brandCustomerRelation';

    const ID_BRAND = 'idBrand';

    const IS_ACTIVE = 'isActive';

    const NAME = 'name';

    const LOGO_URL_SMALL = 'logoUrlSmall';

    const LOGO_URL_LARGE = 'logoUrlLarge';

    const B2C_URL_SHOP = 'b2cUrlShop';

    /**
     * @var \Generated\Shared\Transfer\BrandCustomerRelationTransfer|null
     */
    protected $brandCustomerRelation;

    /**
     * @var int|null
     */
    protected $idBrand;

    /**
     * @var bool|null
     */
    protected $isActive;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $logoUrlSmall;

    /**
     * @var string|null
     */
    protected $logoUrlLarge;

    /**
     * @var string|null
     */
    protected $b2cUrlShop;

    /**
     * @var array
     */
    protected $transferPropertyNameMap = [
        'brand_customer_relation' => 'brandCustomerRelation',
        'brandCustomerRelation' => 'brandCustomerRelation',
        'BrandCustomerRelation' => 'brandCustomerRelation',
        'id_brand' => 'idBrand',
        'idBrand' => 'idBrand',
        'IdBrand' => 'idBrand',
        'is_active' => 'isActive',
        'isActive' => 'isActive',
        'IsActive' => 'isActive',
        'name' => 'name',
        'Name' => 'name',
        'logo_url_small' => 'logoUrlSmall',
        'logoUrlSmall' => 'logoUrlSmall',
        'LogoUrlSmall' => 'logoUrlSmall',
        'logo_url_large' => 'logoUrlLarge',
        'logoUrlLarge' => 'logoUrlLarge',
        'LogoUrlLarge' => 'logoUrlLarge',
        'b2c_url_shop' => 'b2cUrlShop',
        'b2cUrlShop' => 'b2cUrlShop',
        'B2cUrlShop' => 'b2cUrlShop',
    ];

    /**
     * @var array
     */
    protected $transferMetadata = [
        self::BRAND_CUSTOMER_RELATION => [
            'type' => 'Generated\Shared\Transfer\BrandCustomerRelationTransfer',
            'name_underscore' => 'brand_customer_relation',
            'is_collection' => false,
            'is_transfer' => true,
        ],
        self::ID_BRAND => [
            'type' => 'int',
            'name_underscore' => 'id_brand',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::IS_ACTIVE => [
            'type' => 'bool',
            'name_underscore' => 'is_active',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::NAME => [
            'type' => 'string',
            'name_underscore' => 'name',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::LOGO_URL_SMALL => [
            'type' => 'string',
            'name_underscore' => 'logo_url_small',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::LOGO_URL_LARGE => [
            'type' => 'string',
            'name_underscore' => 'logo_url_large',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::B2C_URL_SHOP => [
            'type' => 'string',
            'name_underscore' => 'b2c_url_shop',
            'is_collection' => false,
            'is_transfer' => false,
        ],
    ];

    /**
     * @module BrandCustomer
     *
     * @param \Generated\Shared\Transfer\BrandCustomerRelationTransfer|null $brandCustomerRelation
     *
     * @return $this
     */
    public function setBrandCustomerRelation(BrandCustomerRelationTransfer $brandCustomerRelation = null)
    {
        $this->brandCustomerRelation = $brandCustomerRelation;
        $this->modifiedProperties[self::BRAND_CUSTOMER_RELATION] = true;

        return $this;
    }

    /**
     * @module BrandCustomer
     *
     * @return \Generated\Shared\Transfer\BrandCustomerRelationTransfer|null
     */
    public function getBrandCustomerRelation()
    {
        return $this->brandCustomerRelation;
    }

    /**
     * @module BrandCustomer
     *
     * @return $this
     */
    public function requireBrandCustomerRelation()
    {
        $this->assertPropertyIsSet(self::BRAND_CUSTOMER_RELATION);

        return $this;
    }

    /**
     * @module Brand
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
     * @module Brand
     *
     * @return int|null
     */
    public function getIdBrand()
    {
        return $this->idBrand;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireIdBrand()
    {
        $this->assertPropertyIsSet(self::ID_BRAND);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param bool|null $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        $this->modifiedProperties[self::IS_ACTIVE] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireIsActive()
    {
        $this->assertPropertyIsSet(self::IS_ACTIVE);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param string|null $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->modifiedProperties[self::NAME] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireName()
    {
        $this->assertPropertyIsSet(self::NAME);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param string|null $logoUrlSmall
     *
     * @return $this
     */
    public function setLogoUrlSmall($logoUrlSmall)
    {
        $this->logoUrlSmall = $logoUrlSmall;
        $this->modifiedProperties[self::LOGO_URL_SMALL] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return string|null
     */
    public function getLogoUrlSmall()
    {
        return $this->logoUrlSmall;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireLogoUrlSmall()
    {
        $this->assertPropertyIsSet(self::LOGO_URL_SMALL);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param string|null $logoUrlLarge
     *
     * @return $this
     */
    public function setLogoUrlLarge($logoUrlLarge)
    {
        $this->logoUrlLarge = $logoUrlLarge;
        $this->modifiedProperties[self::LOGO_URL_LARGE] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return string|null
     */
    public function getLogoUrlLarge()
    {
        return $this->logoUrlLarge;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireLogoUrlLarge()
    {
        $this->assertPropertyIsSet(self::LOGO_URL_LARGE);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param string|null $b2cUrlShop
     *
     * @return $this
     */
    public function setB2cUrlShop($b2cUrlShop)
    {
        $this->b2cUrlShop = $b2cUrlShop;
        $this->modifiedProperties[self::B2C_URL_SHOP] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return string|null
     */
    public function getB2cUrlShop()
    {
        return $this->b2cUrlShop;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireB2cUrlShop()
    {
        $this->assertPropertyIsSet(self::B2C_URL_SHOP);

        return $this;
    }
}
