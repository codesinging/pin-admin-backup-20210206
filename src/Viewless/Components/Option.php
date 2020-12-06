<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Component;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

/**
 * Class Option
 *
 * @method $this value(string|int|array $value)
 * @method $this label(string|int $value)
 * @method $this disabled(bool $value = true)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Option extends Component
{
    protected $methods = [
        'value',
        'label',
        'disabled',
    ];

    /**
     * Option constructor.
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     */
    public function __construct($value = null, $label = null, array $attributes = null, $content = null)
    {
        is_array($value) and [$attributes, $value] = [$value, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        parent::__construct($attributes, $content);
        is_null($value) or $this->set('value', $value);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make an Option instance.
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @return Option|static
     */
    public static function make($value = null, $label = null, array $attributes = null, $content = null)
    {
        if ($value instanceof Closure) {
            $value = call_closure($value, new static());
        }
        if ($value instanceof self) {
            return $value;
        }

        return new static($value, $label, $attributes, $content);
    }
}