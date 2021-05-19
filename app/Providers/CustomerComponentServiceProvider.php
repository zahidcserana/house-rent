<?php

namespace App\Providers;

use App\Components\CustomerComponent;
use Illuminate\Support\ServiceProvider;

class CustomerComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('customer', function () {
            return new CustomerComponent();
        });
    }

    public function provides()
    {
        return [
            'customer'
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
