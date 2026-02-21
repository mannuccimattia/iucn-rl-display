<?php

namespace App\Providers;

use App\Services\IucnService;
use Illuminate\Support\Facades\View;
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
    public function boot(IucnService $service): void
    {
        View::composer('layouts.footer', function ($view) use ($service) {
            $view->with('footerData', $service->getFooterData());
        });
    }
}
