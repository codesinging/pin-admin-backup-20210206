<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\TableColumn;
use Orchestra\Testbench\TestCase;

class TableColumnTest extends TestCase
{
    public function testMake()
    {
        self::assertEquals('<el-table-column></el-table-column>', TableColumn::make());
    }
}
