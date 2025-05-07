<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('is_admin', \App\Http\Middleware\IsAdmin::class);
        $this->app['router']->aliasMiddleware('is_employer', \App\Http\Middleware\IsEmployer::class);
        $this->app['router']->aliasMiddleware('is_jobseeker', \App\Http\Middleware\IsJobSeeker::class);
    }
}
