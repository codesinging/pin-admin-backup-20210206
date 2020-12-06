<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Closure;
use Illuminate\Support\Arr;

class Content extends Buildable
{
    /**
     * @var array All of the content items.
     */
    protected $items = [];

    /**
     * @var string The glue to implode the content items.
     */
    protected $glue = '';

    /**
     * Content constructor.
     *
     * @param string|array|Buildable|Closure ...$contents
     */
    public function __construct(...$contents)
    {
        $this->add(...$contents);
    }

    /**
     * Make a Content instance.
     * @param string|array|Buildable|Closure ...$contents
     * @return static
     */
    public static function make(...$contents)
    {
        return new static(...$contents);
    }

    /**
     * Parse the content to a string.
     *
     * @param string|Buildable|Closure $content
     *
     * @return string
     */
    protected function parse($content)
    {
        if (is_null($content)) {
            return null;
        }

        if (empty($content)) {
            return '';
        }

        if ($content instanceof Closure) {
            $content = call_closure($content, new self());
        }

        return (string)$content;
    }

    /**
     * Remove all content items which is null.
     *
     * @param array $contents
     *
     * @return array
     */
    protected function filter(array $contents)
    {
        return array_filter($contents, function ($content) {
            return !is_null($content);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Add contents to the content flow.
     *
     * @param string|array|Buildable|Closure ...$contents
     *
     * @return $this
     */
    public function add(...$contents)
    {
        $contents = Arr::flatten($contents);
        $contents = $this->filter($contents);
        $this->items = array_merge($this->items, $contents);
        return $this;
    }

    /**
     * Prepend contents to the beginning of the content flow.
     *
     * @param string|array|Buildable|Closure ...$contents
     *
     * @return $this
     */
    public function prepend(...$contents)
    {
        $contents = Arr::flatten($contents);
        $contents = $this->filter($contents);
        $this->items = array_merge($contents, $this->items);
        return $this;
    }

    /**
     * Add a content item which is a text interpolation.
     *
     * @param string $content
     *
     * @return $this
     */
    public function interpolation(string $content)
    {
        $this->add(sprintf('{{ %s }}', $content));
        return $this;
    }

    /**
     * Add a blank content item.
     *
     * @return $this
     */
    public function addBlank()
    {
        $this->add('');
        return $this;
    }

    /**
     * Remove all content items.
     *
     * @return $this
     */
    public function clear()
    {
        $this->items = [];
        return $this;
    }

    /**
     * Determine if the content is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * Set glue of the content items.
     *
     * @param string|int $glue
     *
     * @return $this
     */
    public function glue($glue = PHP_EOL)
    {
        if (is_int($glue)) {
            $glue = str_repeat(PHP_EOL, $glue);
        }
        $this->glue = $glue;
        return $this;
    }

    /**
     * Set glue as PHP_EOL.
     *
     * @return $this
     */
    public function linebreak()
    {
        $this->glue();
        return $this;
    }

    /**
     * Get all the content items.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function build()
    {
        $array = [];
        foreach ($this->items as $item) {
            $item = $this->parse($item);
            is_null($item) or $array[] = $item;
        }
        return implode($this->glue, $array);
    }
}