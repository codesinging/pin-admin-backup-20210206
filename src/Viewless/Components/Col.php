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
 * Class Col
 *
 * @method $this span(int $value)
 * @method $this offset(int $value)
 * @method $this push(int $value)
 * @method $this pull(int $value)
 * @method $this xs(int|array $value)
 * @method $this sm(int|array $value)
 * @method $this md(int|array $value)
 * @method $this lg(int|array $value)
 * @method $this xl(int|array $value)
 * @method $this tag(string $value)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Col extends Component
{
    protected $methods = [
        'span',
        'offset',
        'push',
        'pull',
        'xs',
        'sm',
        'md',
        'lg',
        'xl',
        'tag'
    ];

    /**
     * Col constructor.
     * @param array|int|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($span = null, $attributes = null, $content = null, bool $linebreak = null)
    {
        if (is_array($span)) {
            $attributes = $span;
            $span = null;
        }
        if (is_string($attributes)) {
            $content = $attributes;
            $attributes = null;
        }
        parent::__construct($attributes, $content, $linebreak);
        $span and $this->set('span', $span);
    }

    /**
     * Make a Col instance.
     * @param array|int|Col|Closure|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return Col
     */
    public static function make($span = null, $attributes = null, $content = null, bool $linebreak = null)
    {
        if ($span instanceof Closure) {
            $span = call_closure($span, new static());
        }
        if ($span instanceof self) {
            return $span;
        }

        return new static($span, $attributes, $content, $linebreak);
    }
}