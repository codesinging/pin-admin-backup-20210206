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
 * Class Select
 *
 * @method $this value(bool|string|int $value)
 * @method $this multiple(bool $value = true)
 * @method $this disabled(bool $value = true)
 * @method $this valueKey(string $value)
 * @method $this size(string $value)
 * @method $this clearable(bool $value = true)
 * @method $this collapseTags(bool $value = true)
 * @method $this multipleLimit(int $value)
 * @method $this name(string $value)
 * @method $this autocomplete(string $value)
 * @method $this placeholder(string $value)
 * @method $this filterable(bool $value = true)
 * @method $this allowCreate(bool $value = true)
 * @method $this filterMethod(string $value)
 * @method $this remote(bool $value = true)
 * @method $this remoteMethod(string $value)
 * @method $this loading(bool $value = true)
 * @method $this loadingText(string $value)
 * @method $this noMatchText(string $value)
 * @method $this noDataText(string $value)
 * @method $this popperClass(string $value)
 * @method $this reserveKeyword(bool $value = true)
 * @method $this defaultFirstOption(bool $value = true)
 * @method $this popperAppendToBody(bool $value = true)
 * @method $this automaticDropdown(bool $value = true)
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this autocompleteAsOn()
 * @method $this autocompleteAsOff()
 *
 * @method $this onChange()
 * @method $this onVisibleChange()
 * @method $this onRemoveTag()
 * @method $this onClear()
 * @method $this onBlur()
 * @method $this onFocus()
 *
 * @method $this slotNamedPrefix(array|string|Buildable|Closure $content, string $tag = 'template')
 * @method $this slotNamedEmpty(array|string|Buildable|Closure $content, string $tag = 'template')
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Select extends Component
{
    protected $methods = [
        'value',
        'multiple',
        'disabled',
        'valueKey',
        'size',
        'clearable',
        'collapseTags',
        'multipleLimit',
        'name',
        'autocomplete',
        'placeholder',
        'filterable',
        'allowCreate',
        'filterMethod',
        'remote',
        'remoteMethod',
        'loading',
        'loadingText',
        'noMatchText',
        'noDataText',
        'popperClass',
        'reserveKeyword',
        'defaultFirstOption',
        'popperAppendToBody',
        'automaticDropdown',
    ];

    protected $shortcutMethods = [
        'size',
        'autocomplete',
    ];

    protected $slots = [
        'prefix',
        'empty',
    ];

    /**
     * @var Option[] | OptionGroup[]
     */
    protected $options = [];

    /**
     * Select constructor.
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($model = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($model) or $this->vModel($model);
    }

    /**
     * Make a Select instance.
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return Select|static
     */
    public static function make($model = null, array $attributes = null, bool $linebreak = null)
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes, $linebreak);
    }

    /**
     * Add an Option.
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @return Option
     */
    public function option($value = null, $label = null, array $attributes = null, $content = null)
    {
        $option = Option::make($value, $label, $attributes, $content);
        $this->options[] = $option;
        return $option;
    }

    /**
     * Add an Option.
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @return $this
     */
    public function addOption($value = null, $label = null, array $attributes = null, $content = null)
    {
        $this->option($value, $label, $attributes, $content);
        return $this;
    }

    /**
     * Add an OptionGroup.
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return OptionGroup
     */
    public function optionGroup($label = null, array $attributes = null, bool $linebreak = null)
    {
        $option = OptionGroup::make($label, $attributes, $linebreak);
        $this->options[] = $option;
        return $option;
    }

    /**
     * Add an OptionGroup.
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return $this
     */
    public function addOptionGroup($label = null, array $attributes = null, bool $linebreak = null)
    {
        $this->optionGroup($label, $attributes, $linebreak);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        $this->add(...$this->options);
    }
}