<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\JobApplication;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Using class-based composers...
        View::composer('*', function ($view) {
            $view->with('appliedJobs', JobApplication::where('user_id', auth()->id())->get());
        });
    }
}
