<?php

namespace App\Providers;

use App\Components\HouseComponent;
use Illuminate\Support\ServiceProvider;

class HouseComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('house', function () {
            return new HouseComponent();
        });
    }

    public function provides()
    {
        return [
            'house'
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
