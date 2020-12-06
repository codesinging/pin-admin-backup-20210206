<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Builders;

use CodeSinging\PinAdmin\Viewless\Builders\Element;
use Orchestra\Testbench\TestCase;

class ElementTest extends TestCase
{
    public function testBuild()
    {
        self::assertEquals('<div></div>', new Element());
    }
}
