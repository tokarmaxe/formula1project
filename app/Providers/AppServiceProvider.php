<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\User\Models\UserMok;
use App\Components\User\Services\UserContract;
use App\Components\User\Models\UserService;
use App\Components\User\Services\UserServiceContract;

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
        $this->app->bind(UserContract::class, UserMok::class);
       //?? $this->app->make()
        $this->app->bind(UserServiceContract::class, UserService::class);

    }
}
