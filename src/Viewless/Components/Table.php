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
 * Class Table
 *
 * @method $this data(array $data)
 * @method $this height(string|int $height)
 * @method $this maxHeight(string|int $maxHeight)
 * @method $this stripe(bool $stripe = true)
 * @method $this border(bool $border = true)
 * @method $this size(string $size)
 * @method $this fit(bool $fit = true)
 * @method $this showHeader(bool $showHeader = true)
 * @method $this highlightCurrentRow(bool $highlightCurrentRow = true)
 * @method $this currentRowKey(string|int $currentRowKey)
 * @method $this rowClassName(string $rowClassName)
 * @method $this rowStyle(array $rowStyle)
 * @method $this cellClassName(string $cellClassName)
 * @method $this cellStyle(array $cellStyle)
 * @method $this headerRowClassName(string $headerRowClassName)
 * @method $this headerRowStyle(array $headerRowStyle)
 * @method $this headerCellClassName(string $headerCellClassName)
 * @method $this headerCellStyle(array $headerCellStyle)
 * @method $this rowKey(string $rowKey)
 * @method $this emptyText(string $emptyText)
 * @method $this defaultExpandAll(bool $defaultExpandAll = true)
 * @method $this expandRowKeys(array $expandRowKeys)
 * @method $this defaultSort(array $defaultSort)
 * @method $this tooltipEffect(string $tooltipEffect)
 * @method $this showSummary(bool $showSummary = true)
 * @method $this sumText(string $sumText)
 * @method $this summaryMethod(string $summaryMethod)
 * @method $this spanMethod(string $spanMethod)
 * @method $this selectOnIndeterminate(bool $selectOnIndeterminate = true)
 * @method $this indent(int $indent, int $data = null)
 * @method $this lazy(bool $lazy = true)
 * @method $this load(string $load)
 * @method $this treeProps(array $treeProps)
 *
 * @method $this sizeAsDefault()
 * @method $this sizeAsMedium()
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @method $this onSelect()
 * @method $this onSelectAll()
 * @method $this onSelectionChange()
 * @method $this onCellMouseEnter()
 * @method $this onCellMouseLeave()
 * @method $this onCellClick()
 * @method $this onCellDblclick()
 * @method $this onRowClick()
 * @method $this onRowContextmenu()
 * @method $this onRowDblclick()
 * @method $this onHeaderClick()
 * @method $this onHeaderContextmenu()
 * @method $this onSortChange()
 * @method $this onFilterChange()
 * @method $this onCurrentChange()
 * @method $this onHeaderDragend()
 * @method $this onExpandChange()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Table extends Component
{
    protected $methods = [
        'data',
        'height',
        'maxHeight',
        'stripe',
        'border',
        'size',
        'fit',
        'showHeader',
        'highlightCurrentRow',
        'currentRowKey',
        'rowClassName',
        'rowStyle',
        'cellClassName',
        'cellStyle',
        'headerRowClassName',
        'headerRowStyle',
        'headerCellClassName',
        'headerCellStyle',
        'rowKey',
        'emptyText',
        'defaultExpandAll',
        'expandRowKeys',
        'defaultSort',
        'tooltipEffect',
        'showSummary',
        'sumText',
        'summaryMethod',
        'spanMethod',
        'selectOnIndeterminate',
        'indent',
        'lazy',
        'load',
        'treeProps',
    ];

    protected $shortcutMethods = [
        'size',
        'tooltipEffect'
    ];

    protected $events = [
        'select',
        'selectAll',
        'selectionChange',
        'cellMouseEnter',
        'cellMouseLeave',
        'cellClick',
        'cellDblclick',
        'rowClick',
        'rowContextmenu',
        'rowDblclick',
        'headerClick',
        'headerContextmenu',
        'sortChange',
        'filterChange',
        'currentChange',
        'headerDragend',
        'expandChange',
    ];

    /**
     * @var TableColumn[]
     */
    protected $columns = [];

    /**
     * Table constructor.
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        parent::__construct($attributes);
    }

    /**
     * @param array|Closure|Table|null $attributes
     * @return Table|static
     */
    public static function make(array $attributes = null)
    {
        if ($attributes instanceof Closure) {
            $attributes = call_closure($attributes, new static());
        }
        return $attributes instanceof self ? $attributes : new static($attributes);
    }

    /**
     * Return all TableColumns.
     * @return TableColumn[]
     */
    public function columns()
    {
        return $this->columns;
    }

    /**
     * Add a TableColumn.
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @return TableColumn
     */
    public function column($prop = null, $label = null, array $attributes = null, $content = null)
    {
        $column = TableColumn::make($prop, $label, $attributes, $content);
        $this->columns[] = $column;
        return $column;
    }

    /**
     * Add a TableColumn.
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @return $this
     */
    public function addColumn($prop = null, $label = null, array $attributes = null, $content = null)
    {
        $this->column($prop, $label, $attributes, $content);
        return $this;
    }

    /**
     * Add an id column.
     * @param array $attributes
     * @return TableColumn
     */
    public function idColumn(array $attributes = [])
    {
        return $this->column('id', 'ID', $attributes)->width('80')->alignAsCenter();
    }

    /**
     * Add a created_at column.
     * @param array|string|null $label
     * @param array $attributes
     * @return TableColumn
     */
    public function createdAtColumn($label = null, array $attributes = [])
    {
        is_array($label) and [$attributes, $label] = [$label, '创建时间'];
        return $this->column('created_at', $label, $attributes)->alignAsCenter();
    }

    /**
     * Add a updated_at column.
     * @param array|string|null $label
     * @param array $attributes
     * @return TableColumn
     */
    public function updatedAtColumn($label = null, array $attributes = [])
    {
        is_array($label) and [$attributes, $label] = [$label, '更新时间'];
        return $this->column('updated_at', $label, $attributes)->alignAsCenter();
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        $this->add(...$this->columns);
    }
}