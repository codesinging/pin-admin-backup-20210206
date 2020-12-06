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
 * Class RadioButton
 *
 * @method $this label(string|int $value)
 * @method $this disabled(bool $value = true)
 * @method $this name(string $value)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class RadioButton extends Component
{
    /**
     * RadioButton constructor.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($label = null, $content = null, array $attributes = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];

        parent::__construct($attributes, $content);

        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make a RadioButton instance.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return RadioButton|static
     */
    public static function make($label = null, $content = null, array $attributes = null)
    {
        if ($label instanceof Closure) {
            $label = call_closure($label, new static());
        }

        if ($label instanceof self) {
            return $label;
        }

        return new static($label, $content, $attributes);
    }
}