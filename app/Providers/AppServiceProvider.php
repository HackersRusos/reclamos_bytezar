<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            // Forzar HTTPS si detecta que Render lo envió como cabecera
        if (request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
    
        // Laravel 12 confía en proxies automáticamente, pero por las dudas:
        Request::setTrustedProxies(
            [request()->getClientIp()],
            Request::HEADER_X_FORWARDED_ALL
        );
    }
}
