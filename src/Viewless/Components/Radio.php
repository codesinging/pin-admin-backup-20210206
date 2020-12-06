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
 * Class Radio
 *
 * @method $this value(string|int|boolean $value)
 * @method $this label(string|int|boolean $value)
 * @method $this disabled(boolean $value = true)
 * @method $this border(boolean $value = true)
 * @method $this size(string $value)
 * @method $this name(string $value)
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
class Radio extends Component
{
    protected $methods = [
        'value',
        'label',
        'disabled',
        'border',
        'size',
        'name',
    ];

    protected $shortcutMethods = [
        'size',
    ];

    protected $events = [
        'change',
    ];

    /**
     * Radio constructor.
     * @param array|string|null $model
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($model = null, $label = null, $content = null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];

        parent::__construct($attributes, $content);

        is_null($model) or $this->vModel($model);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make a Radio instance.
     * @param array|string|null $model
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return Radio|static
     */
    public static function make($model = null, $label = null, $content = null, array $attributes = null)
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }
        if ($model instanceof self) {
            return $model;
        }
        return new static($model, $label, $content, $attributes);
    }
}