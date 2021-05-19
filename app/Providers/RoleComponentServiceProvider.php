<?php

namespace App\Providers;

use App\Components\RoleComponent;
use Illuminate\Support\ServiceProvider;

class RoleComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('role', function () {
            return new RoleComponent();
        });
    }

    public function provides()
    {
        return [
            'role'
        ];
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
