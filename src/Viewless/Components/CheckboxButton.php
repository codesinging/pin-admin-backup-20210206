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
 * Class CheckboxButton
 *
 * @method $this label(string|int|bool $value)
 * @method $this trueLabel(string|int $value)
 * @method $this falseLabel(string|int $value)
 * @method $this disabled(bool $value = true)
 * @method $this name(string $value)
 * @method $this checked(bool $value = true)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class CheckboxButton extends Component
{
    protected $methods = [
        'label',
        'trueLabel',
        'falseLabel',
        'disabled',
        'name',
        'checked',
    ];

    /**
     * CheckboxButton constructor.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($label = null, $content = null, array $attributes = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content);
        is_null($label) and $this->vModel($label);
    }

    /**
     * Make a Checkbox instance.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return Checkbox|static
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