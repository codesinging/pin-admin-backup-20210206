<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Validation;

use CodeSinging\PinAdmin\Viewless\Validation\Rule;
use CodeSinging\PinAdmin\Viewless\Validation\Validate;
use Orchestra\Testbench\TestCase;

class ValidateTest extends TestCase
{
    public function testRule()
    {
        self::assertEquals(
            [['required' => true], ['type' => 'number']],
            (new Validate())->rule(['required' => true], ['type' => 'number'])->data()
        );
        self::assertEquals(
            [['required' => true], ['type' => 'number']],
            (new Validate())->rule(Rule::make()->required(), Rule::make(['type' => 'number']))->data()
        );
    }

    public function testMake()
    {
        self::assertEquals(
            [['required' => true], ['type' => 'number']],
            Validate::make(['required' => true], ['type' => 'number'])->data()
        );
    }
}
