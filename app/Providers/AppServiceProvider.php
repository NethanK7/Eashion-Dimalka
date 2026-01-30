<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                $view->with('cartCount', $cartCount);
            } else {
                $view->with('cartCount', 0);
            }
        });
    }
}
