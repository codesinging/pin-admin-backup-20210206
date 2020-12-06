<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Views;

use CodeSinging\PinAdmin\Viewless\Components\Button;
use CodeSinging\PinAdmin\Viewless\Components\Dialog;
use CodeSinging\PinAdmin\Viewless\Components\Form;
use CodeSinging\PinAdmin\Viewless\Components\Table;
use CodeSinging\PinAdmin\Viewless\Elements\Div;

class ModelView extends View
{
    protected $template = 'viewless.model';

    /**
     * The add button instance.
     * @var Button
     */
    public $addButton;

    /**
     * The refresh button instance.
     * @var Button
     */
    public $refreshButton;

    /**
     * @var Table
     */
    public $table;

    /**
     * @var bool
     */
    protected $pageable = false;

    /**
     * @var Dialog
     */
    public $dialog;

    /**
     * @var Form
     */
    public $form;

    /**
     * Determine if the table is pageable.
     * @param bool $pageable
     * @return $this
     */
    public function pageable(bool $pageable = true)
    {
        $this->pageable = $pageable;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function initialize(): void
    {
        parent::initialize();

        $this->addButton = Button::make('新增', 'primary')
            ->sizeAsMedium()
            ->onClick('onAddButtonClick')
            ->icon('el-icon-plus');

        $this->refreshButton = Button::make('刷新')
            ->sizeAsMedium()
            ->icon('el-icon-refresh')
            ->onClick('onRefreshButtonClick')
            ->vBind('loading', 'statuses.refresh');

        $this->table = Table::make()
            ->setBuilderId('table')
            ->setConfig('lists', ['pageable' => $this->pageable])
            ->vLoading('statuses.refresh')
            ->vBind('data', '#.lists.data')
            ->css('mt-3')
            ->linebreak()
            ->border();

        $this->dialog = Dialog::make('编辑')
            ->setBuilderId('dialog')
            ->ref()
            ->visible(false)
            ->linebreak()
            ->vBind('visible.sync', '@.visible');

        $this->form = Form::make()
            ->setBuilderId('form')
            ->ref()
            ->vBind('model', '#.data')
            ->linebreak();
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        $actionBar = Div::make()
            ->add($this->addButton, $this->refreshButton)
            ->linebreak()
            ->css('space-x-2');

        $headerBar = Div::make()
            ->add($actionBar)
            ->linebreak()
            ->css('flex items-center justify-between');

        $this->dialog
            ->add($this->form)
            ->slot('footer', function () {
                return Div::make()
                    ->add(
                        Div::make(),
                        Div::make()
                            ->css('space-x-2')
                            ->linebreak()
                            ->add(
                                Button::make('取消')
                                    ->vAssign($this->dialog->propertyKey('visible'), false),
                                Button::make('保存', 'primary')
                                    ->onClick('onFormSave')
                            )
                    )
                    ->linebreak()
                    ->css('flex items-center justify-between');
            });;

        $this->content->add(
            $headerBar,
            $this->table,
            $this->dialog
        );
    }
}