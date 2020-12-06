<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Form;
use CodeSinging\PinAdmin\Viewless\Components\FormItem;
use CodeSinging\PinAdmin\Viewless\Components\Input;
use Orchestra\Testbench\TestCase;

class FormTest extends TestCase
{
    public function testConstructorAndMake()
    {
        self::assertEquals('<el-form></el-form>', new Form());
        self::assertEquals('<el-form></el-form>', Form::make());
    }

    public function testFormItem()
    {
        $form = Form::make();
        $form->item()->input('name');
        self::assertEquals('<el-form><el-form-item><el-input v-model="name"></el-input></el-form-item></el-form>', $form);
    }

    public function testAddFormItem()
    {
        self::assertEquals('<el-form><el-form-item></el-form-item></el-form>', Form::make()->addItem());
    }

    public function testDefault()
    {
        $form = Form::make();
        $form->item('name')->default('Admin');
        $form->item('age')->default(20);
        $form->build();

        self::assertEquals(['name' => 'Admin', 'age' => 20], $form->getConfig('default'));
    }

    public function testBindModelForFormItemComponent()
    {
        $form = Form::make('data');
        $nameInput = Input::make('name');
        $passwordInput = Input::make();

        $form->item('name')->input($nameInput);
        $form->item('password')->input($passwordInput);
        $form->build();

        self::assertEquals('name', $nameInput->getAttr('v-model'));
        self::assertEquals($form->configKey('data.password'), $passwordInput->getAttr('v-model'));
    }
}
