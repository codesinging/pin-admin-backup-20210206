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
 * Class CheckboxGroup
 *
 * @method $this value(string|int|boolean $value)
 * @method $this size(string $value)
 * @method $this disabled(boolean $value = true)
 * @method $this min(int $value)
 * @method $this max(int $value)
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
class CheckboxGroup extends Component
{
    protected $methods = [
        'value',
        'size',
        'disabled',
        'min',
        'max',
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
     * @var Checkbox[] | CheckboxButton[]
     */
    protected $checkboxes = [];

    /**
     * CheckboxGroup constructor.
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
     * Make a CheckboxGroup instance.
     * @param array|string|Closure|CheckboxGroup|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return CheckboxGroup|static
     */
    public static function make($model = null, array $attributes = null, bool $linebreak = null)
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }
        if ($model instanceof self) {
            return $model;
        }

        return new static($model, $attributes, $linebreak);
    }

    /**
     * Add a Checkbox for the CheckboxGroup
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return Checkbox
     */
    public function checkbox($label = null, $content = null, array $attributes = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        $checkbox = Checkbox::make(null, $content, $attributes)->label($label);
        $this->checkboxes[] = $checkbox;
        return $checkbox;
    }

    /**
     * Add a Checkbox for the CheckboxGroup
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return $this
     */
    public function addCheckbox($label = null, $content = null, array $attributes = null)
    {
        $this->checkbox($label, $content, $attributes);
        return $this;
    }

    /**
     * Add a CheckboxButton for the CheckboxGroup
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return CheckboxButton
     */
    public function checkboxButton($label = null, $content = null, array $attributes = null)
    {
        $checkbox = CheckboxButton::make($label, $content, $attributes);
        $this->checkboxes[] = $checkbox;
        return $checkbox;
    }

    /**
     * Add a CheckboxButton for the CheckboxGroup
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     * @return $this
     */
    public function addCheckboxButton($label = null, $content = null, array $attributes = null)
    {
        $this->checkboxButton($label, $content, $attributes);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->checkboxes);
    }
}