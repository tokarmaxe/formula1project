<?php

namespace App\Providers;

use App\Components\User\Models\User;
use App\Components\User\Models\UserService;
use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
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
        $this->app->bind(UserContract::class, User::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
    }
}
