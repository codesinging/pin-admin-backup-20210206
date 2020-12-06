<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Validation;

use CodeSinging\PinAdmin\Viewless\Validation\Rule;
use Orchestra\Testbench\TestCase;

class RuleTest extends TestCase
{
    public function testConstructor()
    {
        $rule = ['required' => true];
        self::assertEquals($rule, (new Rule($rule))->data());
    }

    public function testMakeReturn()
    {
        self::assertInstanceOf(Rule::class, Rule::make());
    }

    public function testMakeWhenParamIsArray()
    {
        self::assertEquals(['type' => 'number'], Rule::make(['type' => 'number'])->data());
    }

    public function testMakeWhenParamIsString()
    {
        self::assertEquals(
            ['required' => true, 'message' => '不能为空', 'trigger' => 'change'],
            Rule::make('required')->data()
        );
    }

    public function testMakeWhenParamIsClosure()
    {
        self::assertEquals(['type' => 'number'], Rule::make(function () {
            return ['type' => 'number'];
        })->data());
        self::assertEquals(['type' => 'number'], Rule::make(function (Rule $rule) {
            return $rule->isNumber();
        })->data());
        self::assertEquals(['type' => 'number'], Rule::make(function (Rule $rule) {
            $rule->isNumber();
        })->data());
    }

    public function testMakeWhenParamIsRuleInstance()
    {
        self::assertEquals(['type' => 'number'], Rule::make(Rule::make(['type' => 'number']))->data());
    }

    public function testMakeWhenParamIsNull()
    {
        self::assertEquals([], Rule::make()->data());
    }

    public function testType()
    {
        self::assertEquals(['type' => 'number'], Rule::make()->type('number')->data());
    }

    public function testCalls()
    {
        self::assertEquals(['type' => 'number'], Rule::make()->isNumber()->data());
    }
}
