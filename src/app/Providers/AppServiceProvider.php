<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton(
            GameEventServiceProvider::class,
            function (\Illuminate\Contracts\Foundation\Application $app) {
                return new GameEventServiceProvider($app);
            }
        );

        $this->app->singleton(
            MessagingServiceProvider::class,
            function (\Illuminate\Contracts\Foundation\Application $app) {
                return new MessagingServiceProvider($app);
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
