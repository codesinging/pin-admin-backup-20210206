<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The console commands of PinAdmin.
     * @var array
     */
    protected $commands = [
    ];

    /**
     * The middlewares of PinAdmin.
     * @var array
     */
    protected $middlewares = [
    ];

    /**
     * Register PinAdmin services.
     */
    public function register(){
        $this->registerBinding();
        $this->registerCommands();
        $this->registerMiddleware();
    }

    /**
     * Bootstrap PinAdmin services.
     */
    public function boot(){
        $this->loadRoutes();
        $this->publishResources();
        $this->configureAuthGuard();
    }

    /**
     * Register the PinAdmin's binding to the container.
     */
    protected function registerBinding(): void
    {
        $this->app->singleton(Admin::LABEL, Admin::class);
    }

    /**
     * Register PinAdmin's console commands.
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register middleware for the application routes.
     */
    protected function registerMiddleware(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];

        foreach ($this->middlewares as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
    }

    /**
     * Publish PinAdmin resources.
     */
    protected function publishResources(): void{

    }

    /**
     * Load PinAdmin application routes.
     */
    public function loadRoutes(): void
    {
        if (is_file($route = app()->basePath('routes/admin.php'))) {
            $this->loadRoutesFrom($route);
        }
    }

    /**
     * Configure the authentication guards and user providers.
     */
    protected function configureAuthGuard(): void
    {

    }
}