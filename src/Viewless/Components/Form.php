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
 * Class Form
 *
 * @method $this model(array $value)
 * @method $this rules(array $value)
 * @method $this inline(bool $value = true)
 * @method $this labelPosition(string $value)
 * @method $this labelWidth(string $value)
 * @method $this labelSuffix(string $value)
 * @method $this hideRequiredAsterisk(bool $value = true)
 * @method $this showMessage(bool $value = true)
 * @method $this inlineMessage(bool $value = true)
 * @method $this statusIcon(bool $value = true)
 * @method $this validateOnRuleChange(bool $value = true)
 * @method $this size(string $value)
 * @method $this disabled(bool $value = true)
 *
 * @method $this labelPositionAsTop()
 * @method $this labelPositionAsRight()
 * @method $this labelPositionAsLeft()
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this onValidate()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Form extends Component
{
    protected $methods = [
        'model',
        'rules',
        'inline',
        'labelPosition',
        'labelWidth',
        'labelSuffix',
        'hideRequiredAsterisk',
        'showMessage',
        'inlineMessage',
        'statusIcon',
        'validateOnRuleChange',
        'size',
        'disabled',
    ];

    protected $shortcutMethods = [
        'labelPosition',
        'size',
    ];

    protected $events = [
        'validate',
    ];

    /**
     * @var FormItem[]
     */
    protected $items = [];

    /**
     * Form constructor.
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($model = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($model) or $this->set('model', $model);
    }

    /**
     * Make a Form instance.
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return Form|static
     */
    public static function make($model = null, array $attributes = null, bool $linebreak = null)
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes, $linebreak);
    }

    /**
     * Add a FormItem.
     * @param array|string|Closure|FormItem|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return FormItem
     */
    public function item($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        $formItem = FormItem::make($prop, $label, $attributes, $content, $linebreak);
        $this->items[] = $formItem;
        return $formItem;
    }

    /**
     * Add a FormItem.
     * @param array|string|Closure|FormItem|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return $this
     */
    public function addItem($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        $this->item($prop, $label, $attributes, $content, $linebreak);
        return $this;
    }

    /**
     * Get the form's default data.
     * @return array
     */
    protected function getDefault()
    {
        $default = [];
        foreach ($this->items as $formItem) {
            if ($prop = $formItem->get('prop')) {
                $default[$prop] = $formItem->getDefault();
            }
        }
        return $default;
    }

    /**
     * Bind `v-model` attribute for the FormItem's component.
     */
    protected function bindModelForFormItemComponents(): void
    {
        foreach ($this->items as $formItem) {
            if ($formItem->component instanceof Component && !$formItem->component->getAttr('v-model')) {
                $formItem->component->vModel($this->configKey($this->get('model', 'data') . '.' . $formItem->get('prop')));
            }
        }
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $defaults = $this->getDefault();
        $this->bindModelForFormItemComponents();
        $this->setConfig('default', $defaults);
        $this->setConfig('data', $defaults);
        $this->add(...$this->items);
    }
}