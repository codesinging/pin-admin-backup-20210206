<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Select;
use Orchestra\Testbench\TestCase;

class SelectTest extends TestCase
{
    public function testConstructor()
    {
        self::assertEquals('<el-select></el-select>', Select::make());
        self::assertEquals('<el-select v-model="city"></el-select>', Select::make('city'));
    }

    public function testOption()
    {
        self::assertEquals('<el-select><el-option></el-option></el-select>', Select::make()->addOption());
    }

    public function testOptionGroup()
    {
        self::assertEquals('<el-select><el-option-group></el-option-group></el-select>', Select::make()->addOptionGroup());
    }

    public function testOptionGroupAndOption()
    {
        $select = Select::make();
        $select->optionGroup()->option();
        self::assertEquals('<el-select><el-option-group><el-option></el-option></el-option-group></el-select>', $select);
    }
}
