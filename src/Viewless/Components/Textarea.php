<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Component;

/**
 * Class Textarea
 *
 * @method $this type(string $value)
 * @method $this value(string $value)
 * @method $this maxlength(int $value)
 * @method $this minlength(int $value)
 * @method $this showWordLimit(bool $value = true)
 * @method $this placeholder(string $value)
 * @method $this clearable(bool $value = true)
 * @method $this showPassword(bool $value = true)
 * @method $this disabled(bool $value = true)
 * @method $this prefixIcon(string $value)
 * @method $this suffixIcon(string $value)
 * @method $this rows(int $value)
 * @method $this autosize(bool|array $value = true)
 * @method $this autocomplete(string $value = 'on')
 * @method $this name(string $value)
 * @method $this readonly(bool $value = true)
 * @method $this max(mixed $value)
 * @method $this min(mixed $value)
 * @method $this step(mixed $value)
 * @method $this resize(string $value)
 * @method $this autofocus(bool $value = true)
 * @method $this form(string $value)
 * @method $this label(string $value)
 * @method $this tabindex(string $value)
 * @method $this validateEvent(bool $value = true)
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this resizeAsNone()
 * @method $this resizeAsBoth()
 * @method $this resizeAsHorizontal()
 * @method $this resizeAsVertical()
 *
 * @method $this onBlur()
 * @method $this onFocus()
 * @method $this onChange()
 * @method $this onInput()
 * @method $this onClear()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Textarea extends Component
{
    protected $baseTag = 'input';

    protected $methods = [
        'type',
        'value',
        'maxlength',
        'minlength',
        'showWordLimit',
        'placeholder',
        'clearable',
        'showPassword',
        'disabled',
        'prefixIcon',
        'suffixIcon',
        'rows',
        'autosize',
        'autocomplete',
        'name',
        'readonly',
        'max',
        'min',
        'step',
        'resize',
        'autofocus',
        'form',
        'label',
        'tabindex',
        'validateEvent',
    ];

    protected $shortcutMethods = [
        'size',
        'autocomplete',
        'resize',
    ];

    protected $events = [
        'blur',
        'focus',
        'change',
        'input',
        'clear',
    ];

    protected $properties = [
        'type' => 'textarea'
    ];

    /**
     * Input constructor.
     *
     * @param null|string|array $model
     * @param array $attributes
     */
    public function __construct($model = null, array $attributes = [])
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes);
        is_null($model) and $this->vModel($model);
    }

    /**
     * Make a Textarea instance.
     *
     * @param null|string|array|Closure|Input $model
     * @param array $attributes
     *
     * @return static
     */
    public static function make($model = null, array $attributes = [])
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        if ($model instanceof static) {
            return $model;
        }

        return new static($model, $attributes);
    }
}