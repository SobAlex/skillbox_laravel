<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PushAllServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton(\App\Services\Pushall::class, function () {
            return new \App\Services\Pushall(config('skillbox.pushall.api.key'), config('skillbox.pushall.api.id'));
        });
    }
}
