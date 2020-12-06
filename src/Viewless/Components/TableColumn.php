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
 * Class TableColumn
 *
 * @method $this type(string $type)
 * @method $this buildIndex(int $index)
 * @method $this columnKey(string $columnKey)
 * @method $this label(string $label)
 * @method $this prop(string $prop)
 * @method $this width(string $width)
 * @method $this minWidth(string $minWidth)
 * @method $this fixed(bool|string $fixed = true)
 * @method $this renderHeader(string $renderHeader)
 * @method $this sortable(bool|string $sortable = true)
 * @method $this sortMethod(string $sortMethod)
 * @method $this sortBy(string|array $sortBy)
 * @method $this sortOrders(array $sortOrders)
 * @method $this resizable(bool $resizable = true)
 * @method $this formatter(string $formatter)
 * @method $this showOverflowTooltip(bool $showOverflowTooltip = true)
 * @method $this align(string $align)
 * @method $this headerAlign(string $headerAlign)
 * @method $this className(string $className)
 * @method $this labelClassName(string $labelClassName)
 * @method $this selectable(string $selectable)
 * @method $this reserveSelection(bool $reserveSelection = true)
 * @method $this filters(array $filters)
 * @method $this filterPlacement(string $filterPlacement)
 * @method $this filterMultiple(bool $filterMultiple = true)
 * @method $this filterMethod(string $filterMethod)
 * @method $this filteredValue(array $filteredValue)
 *
 * @method $this typeAsSelection()
 * @method $this typeAsIndex()
 * @method $this typeAsExpand()
 *
 * @method $this fixedAsTrue()
 * @method $this fixedAsLeft()
 * @method $this fixedAsRight()
 *
 * @method $this sortableAsTrue()
 * @method $this sortableAsFalse()
 * @method $this sortableAsCustom()
 *
 * @method $this alignAsLeft()
 * @method $this alignAsCenter()
 * @method $this alignAsRight()
 *
 * @method $this headerAlignAsLeft()
 * @method $this headerAlignAsCenter()
 * @method $this headerAlignAsRight()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class TableColumn extends Component
{
    protected $methods = [
        'type',
        'index',
        'columnKey',
        'label',
        'prop',
        'width',
        'minWidth',
        'fixed',
        'renderHeader',
        'sortable',
        'sortMethod',
        'sortBy',
        'sortOrders',
        'resizable',
        'formatter',
        'showOverflowTooltip',
        'align',
        'headerAlign',
        'className',
        'labelClassName',
        'selectable',
        'reserveSelection',
        'filters',
        'filterPlacement',
        'filterMultiple',
        'filterMethod',
        'filteredValue'
    ];

    protected $shortcutMethods = [
        'type',
        'fixed',
        'sortable',
        'align',
        'headerAlign'
    ];

    /**
     * TableColumn constructor.
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     */
    public function __construct($prop = null, $label = null, array $attributes = null, $content = null)
    {
        is_array($prop) and [$attributes, $prop] = [$prop, null];
        is_array($label) and [$attributes, $label] = [$label, null];
        parent::__construct($attributes, $content);
        is_null($prop) or $this->set('prop', $prop);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make a TableColumn instance.
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @return TableColumn|static
     */
    public static function make($prop = null, $label = null, array $attributes = null, $content = null)
    {
        if ($prop instanceof Closure) {
            $prop = call_closure($prop, new static());
        }

        return $prop instanceof self ? $prop : new static($prop, $label, $attributes, $content);
    }
}