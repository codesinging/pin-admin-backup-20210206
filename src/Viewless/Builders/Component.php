<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Builders;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

class Component extends Builder
{
    /**
     * @var string
     */
    protected $tagPrefix = 'el-';

    /**
     * Component constructor.
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct(array $attributes = null, $content = null, bool $linebreak = null)
    {
        parent::__construct(null, $attributes, $content, true, $linebreak);
    }
}