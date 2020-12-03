<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin;

class Admin
{
    /**
     * The version of PinAdmin.
     */
    const VERSION = '0.0.1';

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
}