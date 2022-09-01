<?php

namespace FondOfSpryker\Zed\Brand;

use Codeception\Test\Unit;

/**
 * @codeCoverageIgnore
 */
class BrandConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Brand\BrandConfig
     */
    protected $brandConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandConfig = new BrandConfig();
    }

    /**
     * @return void
     */
    public function testGetFilterFieldTypeMapping(): void
    {
        $expected = [];
        $this->assertEquals($expected, $this->brandConfig->getFilterFieldTypeMapping());
    }
}
