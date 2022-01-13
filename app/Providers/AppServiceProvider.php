<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
            $view->with('tagsCloud', \App\Tag::tagsCloud());
        });

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
