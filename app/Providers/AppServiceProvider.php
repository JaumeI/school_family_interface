<?php

namespace App\Providers;

use App\Models\Permission;
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
        \View::composer('layouts.app', function ($view) {
            $view->with('sidebar', auth()->user()->permissions()
                ->where('menu_entry', true)
                ->orderBy('menu_name')
                ->get()
            );
        });
    }
}
