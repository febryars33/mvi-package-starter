<?php

namespace MVI\Starter;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use MVI\Starter\Console\PublishCommand;

class StarterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'starter');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerViews();
        $this->registerRoutes();

        // Registering package commands.
        $this->registerCommands();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/starter.php' => config_path('starter.php'),
            ], 'starter-config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/starter'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/starter'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/starter'),
            ], 'lang');*/
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/starter.php', 'starter');

        // Register the main class to use with the facade
        $this->app->singleton('starter', function () {
            return new Starter;
        });
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'starter');
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishCommand::class
            ]);
        }
    }

    private function routeConfiguration(): array
    {
        return [
            'domain' => config('starter.route.domain'),
            'namespace' => 'MVI\Starter\Http\Controllers',
            'prefix' => config('starter.route.prefix'),
            'middleware' => config('starter.route.middleware'),
        ];
    }
}
