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
 * Class RadioGroup
 *
 * @method $this value(string|int|boolean $value)
 * @method $this size(string $value)
 * @method $this disabled(boolean $value = true)
 * @method $this textColor(string $value)
 * @method $this fill(string $value)
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
class RadioGroup extends Component
{
    protected $methods = [
        'value',
        'size',
        'disabled',
        'textColor',
        'fill',
    ];

    protected $shortcutMethods = [
        'size',
    ];

    protected $events = [
        'change',
    ];

    /**
     * @var Radio[]|RadioButton[]
     */
    protected $radios = [];

    /**
     * RadioGroup constructor.
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($model = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($model) and $this->vModel($model);
    }

    /**
     * Make a RadioGroup instance.
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return RadioGroup|static
     */
    public static function make($model = null, array $attributes = null, bool $linebreak = null)
    {
        if ($model instanceof \Closure) {
            $model = call_closure($model, new static());
        }
        if ($model instanceof self) {
            return $model;
        }
        return new static($model, $attributes, $linebreak);
    }

    /**
     * Add a Radio.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return Radio
     */
    public function radio($label = null, $content = null, array $attributes = null)
    {
        $radio = Radio::make(null, $label, $content, $attributes);
        $this->radios[] = $radio;
        return $radio;
    }

    /**
     * Add a Radio.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return $this
     */
    public function addRadio($label = null, $content = null, array $attributes = null)
    {
        $this->radio($label, $content, $attributes);
        return $this;
    }

    /**
     * Add a RadioButton.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return RadioButton
     */
    public function radioButton($label = null, $content = null, array $attributes = null)
    {
        $radio = RadioButton::make($label, $content, $attributes);
        $this->radios[] = $radio;
        return $radio;
    }

    /**
     * Add a RadioButton.
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return $this
     */
    public function addRadioButton($label = null, $content = null, array $attributes = null)
    {
        $this->radioButton($label, $content, $attributes);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->radios);
    }
}