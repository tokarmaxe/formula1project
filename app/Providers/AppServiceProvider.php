<?php

namespace App\Providers;

use App\Components\Category\Models\Category;
use App\Components\Category\Models\CategoryContract;
use App\Components\Category\Services\CategoryService;
use App\Components\Category\Services\CategoryServiceContract;
use App\Components\User\Models\User;
use App\Components\User\Services\UserService;
use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use App\Components\Post\Models\Post;
use App\Components\Post\Services\PostService;
use App\Components\Post\Models\PostContract;
use App\Components\Post\Services\PostServiceContract;
use App\Components\Image\Models\Image;
use App\Components\Image\Models\ImageContract;
use App\Components\Image\Services\ImageServiceContract;
use App\Components\Image\Services\ImageService;
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
        $this->app->bind(PostContract::class, Post::class);
        $this->app->bind(PostServiceContract::class, PostService::class);
        $this->app->bind(CategoryContract::class, Category::class);
        $this->app->bind(CategoryServiceContract::class, CategoryService::class);
        $this->app->bind(ImageContract::class, Image::class);
        $this->app->bind(ImageServiceContract::class, ImageService::class);
    }
}
