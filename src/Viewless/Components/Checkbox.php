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
 * Class Checkbox
 *
 * @method $this value(string|int|bool $value)
 * @method $this label(string|int|bool $value)
 * @method $this trueLabel(string|int $value)
 * @method $this falseLabel(string|int $value)
 * @method $this disabled(bool $value = true)
 * @method $this border(bool $value = true)
 * @method $this size(string $value)
 * @method $this name(string $value)
 * @method $this checked(bool $value = true)
 * @method $this indeterminate(bool $value = true)
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this onChange(string $handler)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Checkbox extends Component
{
    protected $methods = [
        'value',
        'label',
        'trueLabel',
        'falseLabel',
        'disabled',
        'border',
        'size',
        'name',
        'checked',
        'indeterminate',
    ];

    protected $shortcutMethods = [
        'size',
    ];

    protected $events = [
        'change',
    ];

    /**
     * Checkbox constructor.
     * @param array|string|null $model
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($model = null, $content = null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content);
        is_null($model) and $this->vModel($model);
    }

    /**
     * Make a Checkbox instance.
     * @param array|string|null $model
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return Checkbox|static
     */
    public static function make($model = null, $content = null, array $attributes = null)
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        if ($model instanceof self) {
            return $model;
        }

        return new static($model, $content, $attributes);
    }
}