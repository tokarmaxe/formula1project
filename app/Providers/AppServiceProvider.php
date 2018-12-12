<?php

namespace App\Providers;

use App\Components\BlackMarketPost\Models\BlackMarketPost;
use App\Components\BlackMarketPost\Models\BlackMarketPostContract;
use App\Components\BlackMarketPost\Services\BlackMarketPostServiceContract;
use App\Components\BlackMarketPost\Services\BlackMarketPostsService;
use App\Components\Category\Models\Category;
use App\Components\Category\Models\CategoryContract;
use App\Components\Category\Services\CategoryService;
use App\Components\Category\Services\CategoryServiceContract;
use App\Components\Comment\Models\Comment;
use App\Components\Comment\Models\CommentContract;
use App\Components\Comment\Services\CommentService;
use App\Components\Comment\Services\CommentServiceContract;
use App\Components\File\Services\FileService;
use App\Components\File\Services\FileServiceContract;
use App\Components\File\Services\StrategiesFactories\WriteBase64StrategiesFactory;
use App\Components\File\Services\StrategiesFactories\WriteStrategiesFactoryContract;
use App\Components\Image\Models\Image;
use App\Components\Image\Models\ImageContract;
use App\Components\Image\Services\ImageService;
use App\Components\Image\Services\ImageServiceContract;
use App\Components\User\Models\User;
use App\Components\User\Services\UserService;
use App\Components\User\Models\UserContract;
use App\Components\User\Services\UserServiceContract;
use App\Components\Post\Models\Post;
use App\Components\Post\Services\PostService;
use App\Components\Post\Models\PostContract;
use App\Components\Post\Services\PostServiceContract;
use App\Components\File\Services\StrategiesFactories\ReadStrategiesFactoryContract;
use App\Components\File\Services\StrategiesFactories\ReadBase64StrategiesFactory;
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
        $this->app->bind(FileServiceContract::class, FileService::class);
        $this->app->bind(CommentContract::class, Comment::class);
        $this->app->bind(CommentServiceContract::class, CommentService::class);
        $this->app->bind(BlackMarketPostContract::class, BlackMarketPost::class);
        $this->app->bind(BlackMarketPostServiceContract::class, BlackMarketPostsService::class);
        
        $this->app->bind(WriteStrategiesFactoryContract::class,WriteBase64StrategiesFactory::class);
        $this->app->bind(ReadStrategiesFactoryContract::class,ReadBase64StrategiesFactory::class);
    }
}
