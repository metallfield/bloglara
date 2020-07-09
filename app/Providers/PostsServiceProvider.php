<?php

namespace App\Providers;

use App\Repositories\PostsRepository;
use App\services\postService;
use Illuminate\Support\ServiceProvider;

class PostsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
  /*  public function register()
    {
        $this->app->bind(postService::class, function ($app) {
            return new postService(PostsRepository::class);
        });
    }
  */

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
