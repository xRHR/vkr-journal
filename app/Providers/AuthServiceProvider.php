<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Plan;
use App\Models\User;
use App\Policies\PlanPolicy;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => ProfilePolicy::class,
        Plan::class => PlanPolicy::class
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
