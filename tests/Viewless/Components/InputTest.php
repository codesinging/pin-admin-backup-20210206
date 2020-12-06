<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Input;
use Orchestra\Testbench\TestCase;

class InputTest extends TestCase
{
    public function testConstructor()
    {
        self::assertEquals('<el-input></el-input>', new Input());
    }

    public function testMake()
    {
        self::assertEquals('<el-input></el-input>', Input::make());
    }

    public function testVModel()
    {
        self::assertEquals('<el-input v-model="name"></el-input>', Input::make('name'));
        self::assertEquals('<el-input v-model="user.name"></el-input>', Input::make()->vModel('user.name'));
    }
}
