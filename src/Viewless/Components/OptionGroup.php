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
 * Class OptionGroup
 *
 * @method $this label(string|int $value)
 * @method $this disabled(bool $value = true)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class OptionGroup extends Component
{
    protected $methods = [
        'label',
        'disabled',
    ];

    /**
     * @var Option[]
     */
    protected $options = [];

    /**
     * OptionGroup constructor.
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($label = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make an OptionGroup instance.
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     * @return OptionGroup|static
     */
    public static function make($label = null, array $attributes = null, bool $linebreak = null)
    {
        if ($label instanceof Closure) {
            $label = call_closure($label, new static());
        }
        if ($label instanceof self) {
            return $label;
        }

        return new static($label, $attributes, $linebreak);
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
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->options);
    }
}