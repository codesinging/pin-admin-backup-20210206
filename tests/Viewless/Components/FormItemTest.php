<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\FormItem;
use Orchestra\Testbench\TestCase;

class FormItemTest extends TestCase
{
    public function testConstructor()
    {
        self::assertEquals('<el-form-item></el-form-item>', new FormItem());
    }

    public function testMake()
    {
        self::assertEquals('<el-form-item></el-form-item>', FormItem::make());
    }

    public function testProperties()
    {
        $item = FormItem::make()->prop('name')->label('Name');
        self::assertEquals('<el-form-item v-bind="' . $item->dataKey('properties') . '"></el-form-item>', $item);
        self::assertEquals(['prop' => 'name', 'label' => 'Name'], $item->properties());
    }

    public function testValidate()
    {
        $item = FormItem::make()->validate(['required' => true]);
        self::assertEquals('<el-form-item v-bind="' . $item->dataKey('properties') . '"></el-form-item>', $item);
        self::assertEquals(['rules' => [['required' => true]]], $item->properties());
    }

    public function testDefault()
    {
        $item = FormItem::make()->default('Admin');
        self::assertEquals('<el-form-item></el-form-item>', $item);
        self::assertEquals(['default' => 'Admin'], $item->configs());
    }

    public function testInput()
    {
        self::assertEquals('<el-form-item><el-input></el-input></el-form-item>', FormItem::make()->input());
        self::assertEquals('<el-form-item><el-input v-model="name"></el-input></el-form-item>', FormItem::make()->input('name'));
    }
}
