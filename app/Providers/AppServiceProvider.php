<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

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
        /* Forzar HTTPS si Render envía la cabecera correspondiente
         if (request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }*/

    
        // Usamos 63 = HEADER_X_FORWARDED_ALL
       SymfonyRequest::setTrustedProxies(
            [request()->getClientIp()],
            63 // HEADER_X_FORWARDED_ALL
        );
    }

}
