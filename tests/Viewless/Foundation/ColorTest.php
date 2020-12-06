<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Color;
use Orchestra\Testbench\TestCase;

class ColorTest extends TestCase
{
    /**
     * @var Color
     */
    protected $color;

    protected function setUp(): void
    {
        parent::setUp();
        $this->color = new Color();
    }

    public function testPalette()
    {
        self::assertIsArray($this->color->palette());
    }

    public function testGet()
    {
        self::assertEquals('#000000', $this->color->get('black'));
        self::assertEquals('#A0AEC0', $this->color->get('gray.500'));

        self::assertNull($this->color->get('none'));
    }

    public function testCall()
    {
        self::assertEquals('#000000', $this->color->black());
        self::assertEquals('#FFFFFF', $this->color->white());
        self::assertEquals($this->color->palette()['gray']['300'], $this->color->gray300());
    }

    public function testToRgb()
    {
        self::assertEquals([170, 221, 255], $this->color->toRgb('#adf'));
        self::assertEquals([170, 221, 255], $this->color->toRgb('adf'));
        self::assertEquals([170, 221, 255], $this->color->toRgb('#aaddff'));
        self::assertEquals([170, 221, 255], $this->color->toRgb('aaddff'));
    }

    public function testHex2rgbWithRgbStringIsTrue()
    {
        self::assertEquals('rgb(170,221,255)', $this->color->toRgb('adf', true));
    }

    public function testToRgba()
    {
        self::assertEquals('rgba(170,221,255,1)', $this->color->toRgba('adf', 1));
    }

    public function testToHex()
    {
        self::assertEquals('#aaddff', $this->color->toHex([170, 221, 255]));
        self::assertEquals('#aaddff', $this->color->toHex('rgb(170,221,255)'));
    }
}
