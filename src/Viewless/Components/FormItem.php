<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Component;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Validation\Rule;
use CodeSinging\PinAdmin\Viewless\Validation\Validate;

/**
 * Class FormItem
 *
 * @method $this prop(string $value)
 * @method $this label(string $value)
 * @method $this labelWidth(string $value)
 * @method $this required(bool $value = true)
 * @method $this rules(array $value)
 * @method $this error(string $value)
 * @method $this showMessage(bool $value = true)
 * @method $this inlineMessage(bool $value = true)
 * @method $this size(string $size)
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this slotNamedLabel()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class FormItem extends Component
{
    protected $methods = [
        'prop',
        'label',
        'labelWidth',
        'required',
        'rules',
        'error',
        'showMessage',
        'inlineMessage',
        'size',
    ];

    protected $shortcutMethods = [
        'size',
    ];

    protected $slots = [
        'label',
    ];

    /**
     * @var Validate
     */
    protected $validate;

    /**
     * The default value.
     * @var mixed
     */
    protected $default;

    /**
     * The component bound with the FormItem.
     * @var Component
     */
    public $component;

    /**
     * FormItem constructor.
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        is_array($prop) and [$attributes, $prop] = [$prop, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        parent::__construct($attributes, $content, $linebreak);
        is_null($prop) or $this->set('prop', $prop);
        is_null($label) or $this->set('label', $label);

        $this->validate = new Validate();
    }

    /**
     * Make a FormItem instance.
     * @param array|string|Closure|FormItem|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return FormItem|static
     */
    public static function make($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        if ($prop instanceof Closure) {
            $prop = call_closure($prop, new static());
        }

        return $prop instanceof self ? $prop : new static($prop, $label, $attributes, $content, $linebreak);
    }

    /**
     * Add validate rules.
     * @param array|string|Closure|Rule ...$rules
     * @return $this
     */
    public function validate(...$rules)
    {
        $this->validate->rule(...$rules);
        return $this;
    }

    /**
     * Set default value.
     * @param mixed $default
     * @return $this
     */
    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Get default value.
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Bind an Input component for the FormItem.
     * @param null|string|array|Closure|Input $model
     * @param array $attributes
     * @return $this
     */
    public function input($model = null, array $attributes = [])
    {
        $this->component = Input::make($model, $attributes);
        return $this;
    }

    /**
     * Bind a password Input component for the FormItem.
     * @param null|string|array|Closure|Input $model
     * @param array $attributes
     * @return $this
     */
    public function passwordInput($model = null, array $attributes = [])
    {
        $this->component = Input::make($model, $attributes)->showPassword();
        return $this;
    }

    /**
     * Bind a textarea Input component for the FormItem.
     * @param null|string|array|Closure|Input $model
     * @param array $attributes
     * @return $this
     */
    public function textarea($model = null, array $attributes = [])
    {
        $this->component = Textarea::make($model, $attributes);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->component && $this->add($this->component);
        $this->setConfig('default', $this->getDefault());
        if ($rules = $this->validate->data()){
            $this->set('rules', array_merge($rules, $this->get('rules', [])));
        }
    }
}