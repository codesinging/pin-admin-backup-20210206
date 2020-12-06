<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Views;

use CodeSinging\PinAdmin\Http\Support\PageTitle;
use CodeSinging\PinAdmin\Http\Support\ControllerName;
use CodeSinging\PinAdmin\Viewless\Builders\Builder;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;

abstract class View
{
    use PageTitle;
    use ControllerName;

    /**
     * The view template.
     *
     * @var string
     */
    protected $template = '';

    /**
     * The view Content instance.
     *
     * @var Content
     */
    protected $content;

    /**
     * BaseView constructor.
     */
    public function __construct()
    {
        $this->content = Content::make()->linebreak();
        $this->initialize();
    }

    /**
     * Initialize view.
     */
    protected function initialize(): void
    {
    }

    /**
     * Ready to build view.
     */
    protected function ready(): void
    {
    }

    /**
     * @return array
     */
    protected function parseBuilders()
    {
        $builders = [];
        foreach (Builder::builders() as $builder) {
            $builders[$builder->builderId()] = [
                'index' => $builder->builderIndex(),
                'id' => $builder->builderId(),
                'ref' => $builder->getAttr('ref'),
                'tag' => $builder->getFullTag(),
                'properties' => $builder->properties(),
                'configs' => $builder->configs(),
            ];
        }
        return $builders;
    }

    public function render(array $data = [])
    {
        $this->ready();

        $contents = $this->content->build();

        $this->content->prepend(PHP_EOL, '<!-- viewless start !-->');
        $this->content->add('<!-- viewless end -->', PHP_EOL);

        return admin_view($this->template, [
            'builders' => $this->parseBuilders(),
            'data' => $data,
            'baseUrl' => admin_link(),
            'controllerName' => $this->controllerName(),
            'pageTitle' => $this->pageTitle(),
            'contents' => $contents,
        ]);
    }
}