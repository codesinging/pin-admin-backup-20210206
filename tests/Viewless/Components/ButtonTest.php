<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Components\Button;
use Orchestra\Testbench\TestCase;

class ButtonTest extends TestCase
{
    public function testCallMethods()
    {
        $button = new Button();
        $button->plain();
        $button->loading(false);

        self::assertEquals(
            '<el-button v-bind="' . $button->dataKey('properties') . '"></el-button>',
            $button->build()
        );
        self::assertEquals(['plain' => true, 'loading' => false], $button->properties());
    }

    public function testCallShortcutMethods()
    {
        $button = new Button();
        $button->sizeAsMini();

        self::assertEquals(
            '<el-button v-bind="' . $button->dataKey('properties') . '"></el-button>',
            $button->build()
        );
        self::assertEquals(['size' => 'mini'], $button->properties());
    }

    public function testEvents()
    {
        self::assertEquals(
            '<el-button @click="onClick"></el-button>',
            (new Button())->onClick('onClick')
        );
    }

    public function testConstructorWhenTextIsString()
    {
        self::assertEquals('<el-button>Submit</el-button>', new Button('Submit'));
    }

    public function testConstructorWhenTextIsArray()
    {
        self::assertEquals('<el-button type="primary"></el-button>', new Button(['type' => 'primary']));
    }

    public function testConstructorWhenTypeIsArray()
    {
        self::assertEquals('<el-button type="primary"></el-button>', new Button(null, ['type' => 'primary']));
    }
}
