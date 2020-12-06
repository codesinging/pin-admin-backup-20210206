<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Col;
use CodeSinging\PinAdmin\Viewless\Components\Row;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{
    public function testConstructor()
    {
        self::assertEquals('<el-row></el-row>', new Row());
    }

    public function testMake()
    {
        self::assertEquals('<el-row class="p"></el-row>', Row::make(function (Row $row) {
            $row->css('p');
        }));
    }

    public function testColReturn()
    {
        self::assertInstanceOf(Col::class, Row::make()->col());
    }

    public function testCol()
    {
        $row = Row::make();
        $row->col()->css('p');
        $row->col();

        self::assertEquals('<el-row><el-col class="p"></el-col><el-col></el-col></el-row>', $row);
    }

    public function testAddColReturn()
    {
        self::assertInstanceOf(Row::class, Row::make()->addCol());
    }

    public function testAddCol()
    {
        self::assertEquals('<el-row><el-col></el-col><el-col></el-col></el-row>', Row::make()->addCol()->addCol());
    }
}