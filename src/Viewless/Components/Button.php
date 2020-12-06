<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Component;

/**
 * Class Button
 *
 * @method $this size(string $size)
 * @method $this type(string $type)
 * @method $this plain(bool $plain = true)
 * @method $this round(bool $round = true)
 * @method $this circle(bool $circle = true)
 * @method $this loading(bool $loading = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this icon(string $icon)
 * @method $this autofocus(bool $autofocus = true)
 * @method $this nativeType(string $nativeType)
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this typeAsDefault()
 * @method $this typeAsPrimary()
 * @method $this typeAsSuccess()
 * @method $this typeAsWarning()
 * @method $this typeAsDanger()
 * @method $this typeAsInfo()
 * @method $this typeAsText()
 *
 * @method $this nativeTypeAsButton()
 * @method $this nativeTypeAsSubmit()
 * @method $this nativeTypeAsReset()
 *
 * @method $this onClick(string $handler, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Button extends Component
{
    protected $methods = [
        'size',
        'type',
        'plain',
        'round',
        'circle',
        'loading',
        'disabled',
        'icon',
        'autofocus',
        'nativeType',
    ];

    protected $shortcutMethods = [
        'size',
        'type',
        'nativeType',
    ];

    protected $events = [
        'click'
    ];

    /**
     * Button constructor.
     *
     * @param null|string|array $text
     * @param string|array|null $type
     * @param array|null $attributes
     */
    public function __construct($text = null,  $type = null, array $attributes = null)
    {
        if (is_array($text)) {
            parent::__construct($text);
        } else {
            if (is_array($type)) {
                $attributes = $type;
                $type = null;
            }
            parent::__construct($attributes);
            $text and $this->add($text);
            $type and $this->set('type', $type);
        }
    }

    /**
     * Get a Button instance.
     *
     * @param null|string|array|Button|Closure $text
     * @param string|array|null $type
     * @param array|null $attributes
     *
     * @return static
     */
    public static function make($text = null, $type = null, array $attributes = null)
    {
        if ($text instanceof Closure) {
            $text = call_closure($text, new static());
        }

        if ($text instanceof self) {
            return $text;
        }

        return new static($text, $type, $attributes);
    }
}