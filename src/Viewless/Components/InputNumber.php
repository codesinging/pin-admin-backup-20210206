<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Component;

/**
 * Class InputNumber
 *
 * @method $this value(string $value)
 * @method $this min(int $value)
 * @method $this max(int $value)
 * @method $this step(int $value)
 * @method $this stepStrictly(bool $value = true)
 * @method $this precision(int $value)
 * @method $this size(string $value)
 * @method $this disabled(bool $value = true)
 * @method $this controls(bool $value = true)
 * @method $this controlsPosition(string $value)
 * @method $this name(string $value)
 * @method $this label(string $value)
 * @method $this placeholder(string $value)
 *
 * @method $this sizeAsLarge()
 * @method $this sizeAsSmall()
 * @method $this controlsPositionAsRight()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class InputNumber extends Component
{
    protected $methods = [
        'value',
        'max',
        'min',
        'step',
        'stepStrictly',
        'precision',
        'size',
        'disabled',
        'controls',
        'controlsPosition',
        'autocomplete',
        'name',
        'label',
        'placeholder',
    ];

    protected $shortcutMethods = [
        'size',
        'controlsPosition',
    ];

    protected $events = [
        'blur',
        'focus',
        'change',
    ];

    /**
     * InputNumber constructor.
     * @param array|string|null $model
     * @param array|null $attributes
     */
    public function __construct($model = null, array $attributes = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes);
        is_null($model) or $this->vModel($model);
    }

    /**
     * Make a InputNumber instance.
     * @param array|string|null $model
     * @param array|null $attributes
     * @return InputNumber|static
     */
    public static function make($model = null, array $attributes = null)
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }
        if ($model instanceof self) {
            return $model;
        }

        return new static($model, $attributes);
    }
}