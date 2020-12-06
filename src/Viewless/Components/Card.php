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
 * Class Card
 *
 * @method $this header(string $value)
 * @method $this bodyStyle(array $value)
 * @method $this shadow(string $value)
 *
 * @method $this shadowAsAlways()
 * @method $this shadowAsHover()
 * @method $this shadowAsNever()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Card extends Component
{
    protected $methods = [
        'header',
        'bodyStyle',
        'shadow',
    ];

    protected $shortcutMethods = [
        'shadow',
    ];

    /**
     * Card constructor.
     * @param array|string|null $header
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($header = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        if (is_array($header)){
            $attributes = $header;
            $header = null;
        }
        parent::__construct($attributes, $content, $linebreak);
        is_null($header) or $this->set('header', $header);
    }

    /**
     * @param array|string|null $header
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return Card|static
     */
    public static function make($header = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        if ($header instanceof Closure){
            $header = call_closure($header, new static());
        }

        if ($header instanceof self){
            return $header;
        }

        return new static($header, $attributes, $content, $linebreak);
    }
}