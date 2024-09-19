<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Remove or comment out the call to registerPolicies() from here
        // $this->registerPolicies();  // This line should be removed

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
