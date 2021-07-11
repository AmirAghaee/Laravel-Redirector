<?php

namespace AmirAghaee\Redirector;


use AmirAghaee\Redirector\Command\RefreshDatabase;
use AmirAghaee\Redirector\Middleware\CheckRouteNeedRedirector;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class RedirectorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(CheckRouteNeedRedirector::class);

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();

            $this->commands([
                RefreshDatabase::class,
            ]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/redirector.php', 'redirector');

        // Register the service the package provides.
        $this->app->singleton('redirector', function ($app) {
            return new Redirector;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['redirector'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/redirector.php' => config_path('redirector.php'),
        ], 'redirector.config');
    }
}
