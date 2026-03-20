<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// For Global variable
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     View::share('siteName','My Laravel Website');
    // }

    // For Global Name of School
    public function boot(): void
    {
        View::share('schoolName','LPU');
    }
}
