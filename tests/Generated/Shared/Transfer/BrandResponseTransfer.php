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
class BrandResponseTransfer extends AbstractTransfer
{
    const HAS_BRAND = 'hasBrand';

    const BRAND_TRANSFER = 'brandTransfer';

    const IS_SUCCESS = 'isSuccess';

    const ERRORS = 'errors';

    /**
     * @var bool|null
     */
    protected $hasBrand;

    /**
     * @var \Generated\Shared\Transfer\BrandTransfer|null
     */
    protected $brandTransfer;

    /**
     * @var bool|null
     */
    protected $isSuccess;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\BrandErrorTransfer[]|null
     */
    protected $errors;

    /**
     * @var array
     */
    protected $transferPropertyNameMap = [
        'has_brand' => 'hasBrand',
        'hasBrand' => 'hasBrand',
        'HasBrand' => 'hasBrand',
        'brand_transfer' => 'brandTransfer',
        'brandTransfer' => 'brandTransfer',
        'BrandTransfer' => 'brandTransfer',
        'is_success' => 'isSuccess',
        'isSuccess' => 'isSuccess',
        'IsSuccess' => 'isSuccess',
        'errors' => 'errors',
        'Errors' => 'errors',
    ];

    /**
     * @var array
     */
    protected $transferMetadata = [
        self::HAS_BRAND => [
            'type' => 'bool',
            'name_underscore' => 'has_brand',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::BRAND_TRANSFER => [
            'type' => 'Generated\Shared\Transfer\BrandTransfer',
            'name_underscore' => 'brand_transfer',
            'is_collection' => false,
            'is_transfer' => true,
        ],
        self::IS_SUCCESS => [
            'type' => 'bool',
            'name_underscore' => 'is_success',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::ERRORS => [
            'type' => 'Generated\Shared\Transfer\BrandErrorTransfer',
            'name_underscore' => 'errors',
            'is_collection' => true,
            'is_transfer' => true,
        ],
    ];

    /**
     * @module Brand
     *
     * @param bool|null $hasBrand
     *
     * @return $this
     */
    public function setHasBrand($hasBrand)
    {
        $this->hasBrand = $hasBrand;
        $this->modifiedProperties[self::HAS_BRAND] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return bool|null
     */
    public function getHasBrand()
    {
        return $this->hasBrand;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireHasBrand()
    {
        $this->assertPropertyIsSet(self::HAS_BRAND);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param \Generated\Shared\Transfer\BrandTransfer|null $brandTransfer
     *
     * @return $this
     */
    public function setBrandTransfer(BrandTransfer $brandTransfer = null)
    {
        $this->brandTransfer = $brandTransfer;
        $this->modifiedProperties[self::BRAND_TRANSFER] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function getBrandTransfer()
    {
        return $this->brandTransfer;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireBrandTransfer()
    {
        $this->assertPropertyIsSet(self::BRAND_TRANSFER);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param bool|null $isSuccess
     *
     * @return $this
     */
    public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = $isSuccess;
        $this->modifiedProperties[self::IS_SUCCESS] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return bool|null
     */
    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireIsSuccess()
    {
        $this->assertPropertyIsSet(self::IS_SUCCESS);

        return $this;
    }

    /**
     * @module Brand
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\BrandErrorTransfer[] $errors
     *
     * @return $this
     */
    public function setErrors(ArrayObject $errors)
    {
        $this->errors = $errors;
        $this->modifiedProperties[self::ERRORS] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\BrandErrorTransfer[]|null
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @module Brand
     *
     * @param \Generated\Shared\Transfer\BrandErrorTransfer $error
     *
     * @return $this
     */
    public function addError(BrandErrorTransfer $error)
    {
        $this->errors[] = $error;
        $this->modifiedProperties[self::ERRORS] = true;

        return $this;
    }

    /**
     * @module Brand
     *
     * @return $this
     */
    public function requireErrors()
    {
        $this->assertCollectionPropertyIsSet(self::ERRORS);

        return $this;
    }
}
