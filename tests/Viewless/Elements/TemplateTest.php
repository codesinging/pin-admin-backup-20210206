<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Elements;

use CodeSinging\PinAdmin\Viewless\Elements\Template;
use Orchestra\Testbench\TestCase;

class TemplateTest extends TestCase
{
    public function testConstructor()
    {
        self::assertEquals('<template></template>', new Template());
    }
}
