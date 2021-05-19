<?php

namespace App\Providers;

use App\Components\InvoiceComponent;
use Illuminate\Support\ServiceProvider;

class InvoiceComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('invoice', function () {
            return new InvoiceComponent();
        });
    }

    public function provides()
    {
        return [
            'invoice'
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
