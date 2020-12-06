<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Col;
use Orchestra\Testbench\TestCase;

class ColTest extends TestCase
{
    public function testConstructor()
    {
        self::assertEquals('<el-col></el-col>', new Col());

        $col = new Col(3);
        self::assertEquals('<el-col v-bind="' . $col->dataKey('properties') . '"></el-col>', $col);
        self::assertEquals(3, $col->get('span'));
    }

    public function testMake()
    {
        self::assertEquals('<el-col class="p"></el-col>', Col::make(function (Col $col) {
            return $col->css('p');
        }));
    }
}
