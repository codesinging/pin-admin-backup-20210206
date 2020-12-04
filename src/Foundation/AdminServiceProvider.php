<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\AdminCommand;
use CodeSinging\PinAdmin\Console\InstallCommand;
use CodeSinging\PinAdmin\Console\ListCommand;
use CodeSinging\PinAdmin\Http\Middleware\AdminAuthenticate;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The console commands of PinAdmin.
     * @var array
     */
    protected $commands = [
        AdminCommand::class,
        InstallCommand::class,
        ListCommand::class,
    ];

    /**
     * The middlewares of PinAdmin.
     * @var array
     */
    protected $middlewares = [
        'admin.auth' => AdminAuthenticate::class,
    ];

    /**
     * Register PinAdmin services.
     */
    public function register()
    {
        $this->registerBinding();
        $this->registerCommands();
        $this->registerMiddleware();
    }

    /**
     * Bootstrap PinAdmin services.
     */
    public function boot()
    {
        $this->loadRoutes();
        $this->loadViews();
        $this->loadMigrations();
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
    protected function publishResources(): void
    {
        $this->publishes([
            admin()->packagePath('publish/config') => config_path(),
            admin()->packagePath('publish/routes') => base_path('routes'),
            admin()->packagePath('publish/assets') => public_path('static/vendor/'.admin_label())
        ], admin_label());
    }

    /**
     * Load PinAdmin application routes.
     */
    protected function loadRoutes(): void
    {
        $this->loadRoutesFrom(admin()->packagePath('routes/admin.php'));

        if (is_file($route = app()->basePath('routes/admin.php'))) {
            $this->loadRoutesFrom($route);
        }
    }

    /**
     * Load views of PinAdmin.
     */
    protected function loadViews(): void
    {
        $this->loadViewsFrom(admin()->packagePath('resources/views'), admin_label());
    }

    /**
     * Load database migrations.
     */
    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(admin()->packagePath('database/migrations'));
    }

    /**
     * Configure the authentication guards and user providers.
     */
    protected function configureAuthGuard(): void
    {
        config([
            'auth.guards' => array_merge(config('auth.guards'), admin()->config('guards', [])),
            'auth.providers' => array_merge(config('auth.providers'), admin()->config('providers', []))
        ]);
    }
}