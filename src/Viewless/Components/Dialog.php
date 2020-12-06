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
 * Class Dialog
 *
 * @method $this visible(boolean $value = true)
 * @method $this title(string $title)
 * @method $this width(string $width)
 * @method $this fullscreen(boolean $value = true)
 * @method $this top(string $value)
 * @method $this modal(boolean $value = true)
 * @method $this modalAppendToBody(boolean $value = true)
 * @method $this appendToBody(boolean $value = true)
 * @method $this lockScroll(boolean $value = true)
 * @method $this customClass(string $value)
 * @method $this closeOnClickModal(boolean $value = true)
 * @method $this closeOnPressEscape(boolean $value = true)
 * @method $this showClose(boolean $value = true)
 * @method $this beforeClose(string $value)
 * @method $this center(boolean $value = true)
 * @method $this destroyOnClose(boolean $value = true)
 *
 * @method $this onOpen(string $value)
 * @method $this onOpened(string $value)
 * @method $this onClose(string $value)
 * @method $this onClosed(string $value)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Dialog extends Component
{
    protected $methods = [
        'visible',
        'title',
        'width',
        'fullscreen',
        'top',
        'modal',
        'modalAppendToBody',
        'appendToBody',
        'lockScroll',
        'customClass',
        'closeOnClickModal',
        'closeOnPressEscape',
        'showClose',
        'beforeClose',
        'center',
        'destroyOnClose',
    ];

    protected $events = [
        'open',
        'opened',
        'close',
        'closed',
    ];

    /**
     * Dialog constructor.
     * @param array|string|null $title
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($title = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        if (is_array($title)) {
            $attributes = $title;
            $title = null;
        }
        parent::__construct($attributes, $content, $linebreak);
        is_null($title) or $this->set('title', $title);
    }

    /**
     * @param array|string|Closure|Dialog|null $title
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return Dialog|static
     */
    public static function make($title = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        if ($title instanceof Closure) {
            $title = call_closure($title, new static());
        }

        if ($title instanceof self) {
            return $title;
        }

        return new static($title, $attributes, $content, $linebreak);
    }
}