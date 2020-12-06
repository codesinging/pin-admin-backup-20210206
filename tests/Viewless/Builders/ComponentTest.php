<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Builders;

use CodeSinging\PinAdmin\Viewless\Builders\Component;
use Orchestra\Testbench\TestCase;

class ComponentTest extends TestCase
{
    public function testBaseTag()
    {
        self::assertEquals('<el-component></el-component>', new Component());
        self::assertEquals('<el-test-button-component></el-test-button-component>', new TestButtonComponent());
    }
}

class TestButtonComponent extends Component{

}