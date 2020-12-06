<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Admin;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;

if (!function_exists('admin')) {
    /**
     * Get an instance of Admin.
     * @return Admin
     */
    function admin()
    {
        return Admin::app();
    }
}

if (!function_exists('admin_label')) {
    /**
     * Get the label of PinAdmin.
     * @param string $suffix
     * @param string $glue
     * @return string
     */
    function admin_label(string $suffix = '', string $glue = '_')
    {
        return Admin::app()->label($suffix, $glue);
    }
}

if (!function_exists('admin_config')) {
    /**
     * Get or set the specified configuration value of PinAdmin application.
     * @param string|array|null $key
     * @param mixed|null $default
     * @return Repository|mixed
     */
    function admin_config($key = null, $default = null)
    {
        return Admin::app()->config($key, $default);
    }
}

if (!function_exists('admin_route')) {
    /**
     * Generate the URL of PinAdmin to a named route.
     *
     * @param array|string $name
     * @param mixed $parameters
     * @param bool $absolute
     *
     * @return string
     */
    function admin_route($name, $parameters = [], $absolute = true)
    {
        return Admin::app()->route($name, $parameters, $absolute);
    }
}

if (!function_exists('admin_url')) {
    /**
     * Generate a url for the PinAdmin application.
     *
     * @param null|string $path
     * @param array $parameters
     * @param bool|null $secure
     *
     * @return Application|UrlGenerator|string
     */
    function admin_url(string $path = null, array $parameters = [], $secure = null)
    {
        return Admin::app()->url($path, $parameters, $secure);
    }
}

if (!function_exists('admin_link')) {
    /**
     * Get a absolute url for the PinAdmin application.
     *
     * @param string $path
     * @param array $parameters
     *
     * @return string
     */
    function admin_link(string $path = '', array $parameters = [])
    {
        return Admin::app()->link($path, $parameters);
    }
}

if (!function_exists('admin_home')) {
    /**
     * The home's link of the PinAdmin application.
     * @return string
     */
    function admin_home()
    {
        return Admin::app()->home();
    }
}

if (!function_exists('admin_asset')) {
    /**
     * Get the assets path of PinAdmin.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_asset(string $path = '')
    {
        return Admin::app()->asset($path);
    }
}

if (!function_exists('admin_mix')) {
    /**
     * Get the path to a versioned Mix file of the PinAdmin application.
     *
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     */
    function admin_mix(string $path)
    {
        return Admin::app()->mix($path);
    }
}

if (!function_exists('admin_template')) {
    /**
     * Get the PinAdmin view template.
     * @param string $path
     * @return string
     */
    function admin_template(string $path)
    {
        return Admin::app()->template($path);
    }
}

if (!function_exists('admin_view')) {
    /**
     * Get the view for PinAdmin.
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return Application|\Illuminate\Contracts\View\Factory|View
     */
    function admin_view($view, $data = [], $mergeData = [])
    {
        return Admin::app()->view($view, $data, $mergeData);
    }
}

if (!function_exists('admin_auth')) {
    /**
     * Get the available auth instance with guard `admin`.
     *
     * @return Factory|Guard|StatefulGuard
     */
    function admin_auth()
    {
        return Admin::app()->auth();
    }
}

if (!function_exists('admin_user')) {
    /**
     * Get the currently authenticated user.
     *
     * @return Authenticatable|null
     */
    function admin_user()
    {
        return Admin::app()->user();
    }
}

if (!function_exists('call_closure')) {
    /**
     * Call a user function given by the first parameter, and the second parameter serve as the user function's parameter.
     * If the closure function does not has a return or return null, then this function return the second parameter.
     *
     * @param Closure $closure
     * @param mixed $parameters
     *
     * @return mixed
     */
    function call_closure(Closure $closure, $parameters = null)
    {
        return call_user_func($closure, $parameters) ?? $parameters;
    }
}