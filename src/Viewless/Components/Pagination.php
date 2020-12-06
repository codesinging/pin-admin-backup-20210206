<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Builders\Component;

/**
 * Class Pagination
 *
 * @method $this small(bool $value = true)
 * @method $this background(bool $value = true)
 * @method $this pageSize(int $value)
 * @method $this total(int $value)
 * @method $this pageCount(int $value)
 * @method $this pagerCount(int $value)
 * @method $this currentPage(int $value)
 * @method $this layout(string $value)
 * @method $this pageSizes(array $value)
 * @method $this popperClass(string $value)
 * @method $this prevText(string $value)
 * @method $this nextText(string $value)
 * @method $this disabled(bool $value = true)
 * @method $this hideOnSinglePage(bool $value = true)
 *
 * @method $this onSizeChange(string $handler)
 * @method $this onCurrentChange(string $handler)
 * @method $this prevClick(string $handler)
 * @method $this nextClick(string $handler)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Pagination extends Component
{
    protected $methods = [
        'small',
        'background',
        'pageSize',
        'total',
        'pageCount',
        'pagerCount',
        'currentPage',
        'layout',
        'pageSizes',
        'popperClass',
        'prevText',
        'nextText',
        'disabled',
        'hideOnSinglePage',
    ];

    protected $events = [
        'sizeChange',
        'currentChange',
        'prevClick',
        'nextClick',
    ];

    /**
     * Pagination constructor.
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        parent::__construct($attributes);
    }

    /**
     * Make a Pagination instance.
     * @param array|Closure|Pagination|null $attributes
     * @return Pagination|static
     */
    public static function make(array $attributes = null)
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }

        return $attributes instanceof self ? $attributes : new static($attributes);
    }
}