<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use Orchestra\Testbench\TestCase;

class BuildableTest extends TestCase
{
    public function testToString()
    {
        self::assertEquals('example', new Example());
    }

    public function testBuild()
    {
        self::assertEquals('example', (new Example())->build());
    }
}

class Example extends Buildable
{
    /**
     * @inheritDoc
     */
    public function build()
    {
        return 'example';
    }
}