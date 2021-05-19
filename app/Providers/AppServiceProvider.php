<?php

namespace App\Providers;

use App\Models\House;
use App\Observers\HouseObserver;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        House::observe(HouseObserver::class);

        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
            ];
        });

        Inertia::share('isAdmin', function () {
            return Auth::user()->role->name == 'Admin' ? true : false;
        });

        Inertia::share('route', function () {
            return [
                'prefix' => current(explode('.', Route::currentRouteName())),
                'name' => Route::currentRouteName(),
            ];
        });

        Inertia::share([
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'role' => Auth::user()->role->name,
                        // 'menu_access' => \config('settings.menu_access')[Auth::user()->role->name],
                    ] : null,
                ];
            },
        ]);
    }
}
