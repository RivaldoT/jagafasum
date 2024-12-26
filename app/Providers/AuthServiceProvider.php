<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //category
        Gate::define(
            'create-category-permission',
            'App\Policies\CategoryPolicy@create'
        );
        Gate::define(
            'patch-category-permission',
            'App\Policies\CategoryPolicy@patch'
        );
        Gate::define(
            'delete-category-permission',
            'App\Policies\CategoryPolicy@delete'
        );

        //city
        Gate::define(
            'create-city-permission',
            'App\Policies\CityPolicy@create'
        );
        Gate::define(
            'patch-city-permission',
            'App\Policies\CityPolicy@patch'
        );
        Gate::define(
            'delete-city-permission',
            'App\Policies\CityPolicy@delete'
        );

        //fasility
        Gate::define(
            'create-fasility-permission',
            'App\Policies\FasilityPolicy@create'
        );
        Gate::define(
            'patch-fasility-permission',
            'App\Policies\FasilityPolicy@patch'
        );
        Gate::define(
            'delete-fasility-permission',
            'App\Policies\FasilityPolicy@delete'
        );

        //report
        Gate::define(
            'create-report-permission',
            'App\Policies\ReportPolicy@create'
        );
        Gate::define(
            'patch-report-permission',
            'App\Policies\ReportPolicy@patch'
        );
        Gate::define(
            'delete-report-permission',
            'App\Policies\ReportPolicy@delete'
        );
    }
}
