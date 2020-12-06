<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Admin
{
    /**
     * The version of PinAdmin.
     */
    const VERSION = '1.0.0-beta.2';

    /**
     * The name of PinAdmin.
     */
    const NAME = 'PinAdmin';

    /**
     * The authentication guard of PinAdmin.
     */
    const GUARD = 'admin';

    /**
     * The label of PinAdmin.
     */
    const LABEL = 'admin';

    /**
     * The PinAdmin application directory relative to the Laravel app directory.
     */
    const DIRECTORY = 'PinAdmin';

    /**
     * Get an instance of Admin.
     * @return self
     */
    public static function app()
    {
        return app(self::LABEL);
    }

    /**
     * Get the version of PinAdmin.
     * @param string $prefix
     * @return string
     */
    public function version(string $prefix = '')
    {
        return $prefix . self::VERSION;
    }

    /**
     * Get the name of PinAdmin.
     * @return string
     */
    public function name()
    {
        return self::NAME;
    }

    /**
     * Get the authentication guard of PinAdmin.
     * @return string
     */
    public function guard()
    {
        return self::GUARD;
    }

    /**
     * Get the label of PinAdmin.
     * @param string $suffix
     * @param string $glue
     * @return string
     */
    public function label(string $suffix = '', string $glue = '_')
    {
        return self::LABEL . ($suffix ? $glue . $suffix : '');
    }

    /**
     * Get the application directory relative to the Laravel app directory.
     * @param string $path
     * @return string
     */
    public function directory(string $path = '')
    {
        return self::DIRECTORY . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Get the application path.
     * @param string $path
     * @return string
     */
    public function path(string $path = '')
    {
        return app_path($this->directory($path));
    }

    /**
     * Get the application namespace.
     * @param string $path
     * @return string
     */
    public function getNamespace(string $path = '')
    {
        return app()->getNamespace() . str_replace('/', '\\', $this->directory($path));
    }

    /**
     * Get the package path of PinAdmin.
     * @param string $path
     * @return string
     */
    public function packagePath(string $path = '')
    {
        return dirname(dirname(__DIR__)) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Get or set the specified configuration value of PinAdmin application.
     * @param string|array|null $key
     * @param mixed|null $default
     * @return Repository|mixed
     */
    public function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return config($this->label());
        }
        if (is_array($key)) {
            $arr = [];
            foreach ($key as $k => $v) {
                $arr[$this->label($k, '.')] = $v;
            }
            return config($arr);
        }
        return config($this->label($key, '.'), $default);
    }

    /**
     * Generate the URL of PinAdmin to a named route.
     *
     * @param array|string $name
     * @param mixed $parameters
     * @param bool $absolute
     *
     * @return string
     */
    public function route($name, $parameters = [], $absolute = true)
    {
        $name = self::LABEL . '.' . $name;
        return route($name, $parameters, $absolute);
    }

    /**
     * Generate a url for the PinAdmin application.
     *
     * @param null|string $path
     * @param array $parameters
     * @param bool|null $secure
     *
     * @return Application|UrlGenerator|string
     */
    public function url(string $path = null, array $parameters = [], $secure = null)
    {
        if (!is_null($path)) {
            $path = $this->config('route') . Str::start($path, '/');
        }
        return url($path, $parameters, $secure);
    }

    /**
     * Get a absolute url for the PinAdmin application.
     *
     * @param string $path
     * @param array $parameters
     *
     * @return string
     */
    public function link(string $path = '', array $parameters = [])
    {
        $link = '/' . $this->config('route_prefix');
        if ($path) {
            $link .= Str::start($path, '/');
        }
        if ($parameters) {
            $link .= '?' . http_build_query($parameters);
        }
        return $link;
    }

    /**
     * The home's link of the PinAdmin application.
     * @return string
     */
    public function home()
    {
        return $this->link($this->config('home'));
    }

    /**
     * Get the assets path of PinAdmin.
     *
     * @param string $path
     *
     * @return string
     */
    public function asset(string $path = '')
    {
        if (Str::startsWith($path, ['https://', 'http://', '//', '/'])) {
            return $path;
        }
        return '/static/vendor/' . Str::kebab($this->label($path, '/'));
    }

    /**
     * Get the path to a versioned Mix file of the PinAdmin application.
     *
     * @param string $path
     *
     * @return HtmlString|string
     * @throws Exception
     */
    public function mix(string $path)
    {
        return mix($path, $this->asset());
    }

    /**
     * Get the PinAdmin view template.
     * @param string $path
     * @return string
     */
    public function template(string $path)
    {
        return $this->label($path, '::');
    }

    /**
     * Get the view for PinAdmin.
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return Application|\Illuminate\Contracts\View\Factory|View
     */
    public function view($view, $data = [], $mergeData = [])
    {
        return view(admin_template($view), $data, $mergeData);
    }

    /**
     * Get the available auth instance with guard `admin`.
     *
     * @return Factory|Guard|StatefulGuard
     */
    public function auth()
    {
        return Auth::guard($this->guard());
    }

    /**
     * Get the currently authenticated user.
     *
     * @return Authenticatable|null
     */
    public function user()
    {
        return $this->auth()->user();
    }
}