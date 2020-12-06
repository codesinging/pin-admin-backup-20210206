<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Illuminate\Support\Arr;

/**
 * Class Color
 *
 * @method string black()
 * @method string white()
 *
 * @method string primary()
 * @method string success()
 * @method string warning()
 * @method string danger()
 * @method string info()
 *
 * @method string gray100()
 * @method string gray200()
 * @method string gray300()
 * @method string gray400()
 * @method string gray500()
 * @method string gray600()
 * @method string gray700()
 * @method string gray800()
 * @method string gray900()
 *
 * @method string red100()
 * @method string red200()
 * @method string red300()
 * @method string red400()
 * @method string red500()
 * @method string red600()
 * @method string red700()
 * @method string red800()
 * @method string red900()
 *
 * @method string orange100()
 * @method string orange200()
 * @method string orange300()
 * @method string orange400()
 * @method string orange500()
 * @method string orange600()
 * @method string orange700()
 * @method string orange800()
 * @method string orange900()
 *
 * @method string yellow100()
 * @method string yellow200()
 * @method string yellow300()
 * @method string yellow400()
 * @method string yellow500()
 * @method string yellow600()
 * @method string yellow700()
 * @method string yellow800()
 * @method string yellow900()
 *
 * @method string green100()
 * @method string green200()
 * @method string green300()
 * @method string green400()
 * @method string green500()
 * @method string green600()
 * @method string green700()
 * @method string green800()
 * @method string green900()
 *
 * @method string teal100()
 * @method string teal200()
 * @method string teal300()
 * @method string teal400()
 * @method string teal500()
 * @method string teal600()
 * @method string teal700()
 * @method string teal800()
 * @method string teal900()
 *
 * @method string indigo100()
 * @method string indigo200()
 * @method string indigo300()
 * @method string indigo400()
 * @method string indigo500()
 * @method string indigo600()
 * @method string indigo700()
 * @method string indigo800()
 * @method string indigo900()
 *
 * @method string purple100()
 * @method string purple200()
 * @method string purple300()
 * @method string purple400()
 * @method string purple500()
 * @method string purple600()
 * @method string purple700()
 * @method string purple800()
 * @method string purple900()
 *
 * @method string pink100()
 * @method string pink200()
 * @method string pink300()
 * @method string pink400()
 * @method string pink500()
 * @method string pink600()
 * @method string pink700()
 * @method string pink800()
 * @method string pink900()
 *
 * @package CodeSinging\AdminView\Foundation
 */
class Color
{
    /**
     * @var array
     */
    protected $palette = [
        'black' => '#000000',
        'white' => '#FFFFFF',

        'primary' => '#409EFF',
        'success' => '#67C23A',
        'warning' => '#E6A23C',
        'danger' => '#F56C6C',
        'info' => '#909399',

        'gray' => [
            '100' => '#F7FAFC',
            '200' => '#EDF2F7',
            '300' => '#E2E8F0',
            '400' => '#CBD5E0',
            '500' => '#A0AEC0',
            '600' => '#718096',
            '700' => '#4A5568',
            '800' => '#2D3748',
            '900' => '#1A202C',
        ],

        'red' => [
            '100' => '#FFF5F5',
            '200' => '#FED7D7',
            '300' => '#FEB2B2',
            '400' => '#FC8181',
            '500' => '#F56565',
            '600' => '#E53E3E',
            '700' => '#C53030',
            '800' => '#9B2C2C',
            '900' => '#742A2A',
        ],

        'orange' => [
            '100' => '#FFFAF0',
            '200' => '#FEEBC8',
            '300' => '#FBD38D',
            '400' => '#F6AD55',
            '500' => '#ED8936',
            '600' => '#DD6B20',
            '700' => '#C05621',
            '800' => '#9C4221',
            '900' => '#7B341E',
        ],

        'yellow' => [
            '100' => '#FFFFF0',
            '200' => '#FEFCBF',
            '300' => '#FAF089',
            '400' => '#F6E05E',
            '500' => '#ECC94B',
            '600' => '#D69E2E',
            '700' => '#B7791F',
            '800' => '#975A16',
            '900' => '#744210',
        ],

        'green' => [
            '100' => '#F0FFF4',
            '200' => '#C6F6D5',
            '300' => '#9AE6B4',
            '400' => '#68D391',
            '500' => '#48BB78',
            '600' => '#38A169',
            '700' => '#2F855A',
            '800' => '#276749',
            '900' => '#22543D',
        ],

        'teal' => [
            '100' => '#E6FFFA',
            '200' => '#B2F5EA',
            '300' => '#81E6D9',
            '400' => '#4FD1C5',
            '500' => '#38B2AC',
            '600' => '#319795',
            '700' => '#2C7A7B',
            '800' => '#285E61',
            '900' => '#234E52',
        ],

        'blue' => [
            '100' => '#EBF8FF',
            '200' => '#BEE3F8',
            '300' => '#90CDF4',
            '400' => '#63B3ED',
            '500' => '#4299E1',
            '600' => '#3182CE',
            '700' => '#2B6CB0',
            '800' => '#2C5282',
            '900' => '#2A4365',
        ],

        'indigo' => [
            '100' => '#EBF4FF',
            '200' => '#C3DAFE',
            '300' => '#A3BFFA',
            '400' => '#7F9CF5',
            '500' => '#667EEA',
            '600' => '#5A67D8',
            '700' => '#4C51BF',
            '800' => '#434190',
            '900' => '#3C366B',
        ],

        'purple' => [
            '100' => '#FAF5FF',
            '200' => '#E9D8FD',
            '300' => '#D6BCFA',
            '400' => '#B794F4',
            '500' => '#9F7AEA',
            '600' => '#805AD5',
            '700' => '#6B46C1',
            '800' => '#553C9A',
            '900' => '#44337A',
        ],

        'pink' => [
            '100' => '#FFF5F7',
            '200' => '#FED7E2',
            '300' => '#FBB6CE',
            '400' => '#F687B3',
            '500' => '#ED64A6',
            '600' => '#D53F8C',
            '700' => '#B83280',
            '800' => '#97266D',
            '900' => '#702459',
        ],
    ];

    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * @return array
     */
    public function palette()
    {
        return $this->palette;
    }

    /**
     * @param string $color
     *
     * @return array|string
     */
    public function get(string $color)
    {
        return Arr::get($this->palette, $color);
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        if (in_array($name, ['black', 'white', 'primary', 'success', 'warning', 'danger', 'info'])) {
            return $this->palette[$name];
        }

        $color = substr($name, 0, -3);
        if (in_array($color, ['gray', 'red', 'orange', 'yellow', 'green', 'teal', 'blue', 'indigo', 'purple', 'pink'])) {
            return $this->palette[$color][substr($name, strlen($color))];
        }
    }

    /**
     * @param string $hex
     *
     * @param bool $rgbString
     *
     * @return array|string
     */
    public function toRgb(string $hex, bool $rgbString = false)
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) === 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        } else {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        }

        return $rgbString ? sprintf('rgb(%s,%s,%s)', $r, $g, $b) : [$r, $g, $b];
    }

    /**
     * @param string $hex
     * @param float $alpha
     *
     * @return string
     */
    public function toRgba(string $hex, float $alpha)
    {
        if ($alpha > 1) {
            $alpha = 1;
        }
        if ($alpha < 0) {
            $alpha = 0;
        }

        [$r, $g, $b] = $this->toRgb($hex);

        return sprintf('rgba(%s,%s,%s,%s)', $r, $g, $b, $alpha);
    }

    /**
     * @param string|array $rgb
     *
     * @return string
     */
    public function toHex($rgb)
    {
        if (is_string($rgb) && preg_match('/([0-9]+),([0-9]+),([0-9]+)/', $rgb, $matches)) {
            $rgb = [$matches[1], $matches[2], $matches[3]];
        }
        if (is_array($rgb)) {
            $r = str_pad(dechex($rgb[0]), 2, '0', STR_PAD_LEFT);
            $g = str_pad(dechex($rgb[1]), 2, '0', STR_PAD_LEFT);
            $b = str_pad(dechex($rgb[2]), 2, '0', STR_PAD_LEFT);
            return '#' . $r . $g . $b;
        }

        return $rgb;
    }
}