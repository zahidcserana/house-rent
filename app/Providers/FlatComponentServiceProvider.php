<?php

namespace App\Providers;

use App\Components\FlatComponent;
use Illuminate\Support\ServiceProvider;

class FlatComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('flat', function () {
            return new FlatComponent();
        });
    }

    public function provides()
    {
        return [
            'flat'
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
