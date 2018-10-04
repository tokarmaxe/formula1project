<?php

namespace App\Providers;

use App\Components\Category\Models\Category;
use App\Components\Category\Models\CategoryContract;
use App\Components\Category\Services\CategoryService;
use App\Components\Category\Services\CategoryServiceContract;
use App\Components\Comment\Models\Comment;
use App\Components\Comment\Models\CommentContract;
use App\Components\Comment\Services\CommentService;
use App\Components\Comment\Services\CommentServiceContract;
use App\Components\User\Models\User;
use App\Components\User\Services\UserService;
use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use App\Components\Post\Models\Post;
use App\Components\Post\Services\PostService;
use App\Components\Post\Models\PostContract;
use App\Components\Post\Services\PostServiceContract;
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
        $this->app->bind(CommentContract::class, Comment::class);
        $this->app->bind(CommentServiceContract::class, CommentService::class);
    }
}
