<?php

namespace App\Providers;

use App\Components\InvoiceItemComponent;
use Illuminate\Support\ServiceProvider;

class InvoiceItemComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('invoiceItem', function () {
            return new InvoiceItemComponent();
        });
    }

    public function provides()
    {
        return [
            'invoiceItem'
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
