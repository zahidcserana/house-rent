<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

class MessageBagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias(
            MessageBag::class,
            \App\Models\MessageBag::class
        );
    }
}
