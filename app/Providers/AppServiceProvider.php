<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //DI for User components
        $this->app->bind(UserContract::class, User::class);
       //?? $this->app->make()
        $this->app->bind(UserServiceContract::class, UserService::class);

    }
}
