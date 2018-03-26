<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Activity' => 'App\Policies\ActivityPolicy',
        'App\Application' => 'App\Policies\ApplicationPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
        'App\CommunityDay' => 'App\Policies\CommunityDayPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->registerPolicies();


    }
}
