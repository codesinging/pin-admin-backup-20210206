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
 * Class Row
 *
 * @method $this gutter(int $value)
 * @method $this type(string $value)
 * @method $this justify(string $value)
 * @method $this align(string $value)
 * @method $this tag(string $value)
 *
 * @method $this typeAsFlex()
 *
 * @method $this justifyAsStart()
 * @method $this justifyAsEnd()
 * @method $this justifyAsCenter()
 * @method $this justifyAsSpaceAround()
 * @method $this justifyAsSpaceBetween()
 *
 * @method $this alignAsTop()
 * @method $this alignAsMiddle()
 * @method $this alignAsBottom()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Row extends Component
{
    protected $methods = [
        'gutter',
        'type',
        'justify',
        'align',
        'tag',
    ];

    protected $shortcutMethods = [
        'type',
        'justify',
        'align',
    ];

    /**
     * @var Col[]
     */
    protected $cols = [];

    /**
     * Row constructor.
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct(array $attributes = null, bool $linebreak = null)
    {
        parent::__construct($attributes, null, $linebreak);
    }

    /**
     * Make a Row instance.
     * @param array|Closure|Row|null $attributes
     * @param bool|null $linebreak
     * @return Row|static
     */
    public static function make($attributes = null, bool $linebreak = null)
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }
        if ($attributes instanceof self) {
            return $attributes;
        }

        return new static($attributes, $linebreak);
    }

    /**
     * Add a Col for the Row.
     * @param array|int|Col|Closure|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return Col
     */
    public function col($span = null, $attributes = null, $content = null, bool $linebreak = null)
    {
        $col = Col::make($span, $attributes, $content, $linebreak);
        $this->cols[] = $col;
        return $col;
    }

    /**
     * Add a Col for the Row.
     * @param array|int|Col|Closure|null $span
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     * @return $this
     */
    public function addCol($span = null, $attributes = null, $content = null, bool $linebreak = null)
    {
        $this->col($span, $attributes, $content, $linebreak);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->cols);
    }
}