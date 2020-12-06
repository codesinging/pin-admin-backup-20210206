<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Support;

use Illuminate\Support\Str;

trait ControllerName
{
    /**
     * Get controller name.
     * @param bool $snake
     * @return string
     */
    protected function controllerName(bool $snake = true)
    {
        $controller = Str::before(class_basename(request()->route()->getActionName()), 'Controller@');
        return $snake ? Str::snake($controller) : $controller;
    }
}