<?php

namespace FondOfSpryker\Zed\Brand;

use FondOfSpryker\Shared\Brand\BrandConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class BrandConfig extends AbstractBundleConfig
{
    /**
     * @return array<string, string>
     */
    public function getFilterFieldTypeMapping(): array
    {
        return $this->get(
            BrandConstants::FILTER_FIELD_TYPE_MAPPING,
            BrandConstants::FILTER_FIELD_TYPE_MAPPING_DEFAULT,
        );
    }
}
