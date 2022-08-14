<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TagsPostSynchronizer;

class TagsSynchronizerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TagsPostSynchronizer::class, function () {
            return new TagsPostSynchronizer;
        });
    }

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
