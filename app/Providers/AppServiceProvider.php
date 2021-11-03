<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PostCommentDepth;
use App\Observers\PostCommentObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PostCommentDepth::observe(PostCommentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
