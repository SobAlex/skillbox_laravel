<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('includes.aside', function ($view) {
            $view->with('tagsPostsCloud', \App\Models\Tag::tagsPostsCloud());
            $view->with('tagsNewsCloud', \App\Models\Tag::tagsNewsCloud());
        });

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
