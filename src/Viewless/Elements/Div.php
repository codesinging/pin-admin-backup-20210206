<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Elements;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Element;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

class Div extends Element
{
    /**
     * The default element tag.
     * @var string
     */
    protected $baseTag = 'div';

    /**
     * Template constructor.
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $closing
     * @param bool|null $linebreak
     */
    public function __construct($attributes = null, $content = null, bool $closing = null, bool $linebreak = null)
    {
        is_string($attributes) and [$content, $attributes] = [$attributes, null];
        parent::__construct(null, $attributes, $content, $closing, $linebreak);
    }

    /**
     * Make a Template instance.
     * @param array|string|Closure|Div|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $closing
     * @param bool|null $linebreak
     * @return Template|static
     */
    public static function make($attributes = null, $content = null, bool $closing = null, bool $linebreak = null)
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }

        return $attributes instanceof self ? $attributes : new static($attributes, $content, $closing, $linebreak);
    }
}