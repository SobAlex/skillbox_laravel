<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\PostPolicy;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-admin-part', function (User $user) {
            if ($user->role_id == 1) {
                return true;
            }
        });

        Gate::define('edit-post', function (User $user, Post $post) {
            if ($user->role_id == 1 || $post->owner_id == $user->id) {
                return true;
            }
        });
    }
}
