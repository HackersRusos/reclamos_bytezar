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
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Forzar HTTPS si Render envía la cabecera correspondiente
        URL::forceScheme('https');

    
        // Confiar en el proxy de Railway
        SymfonyRequest::setTrustedProxies(
            ['*'],
            255
        );
    }

}
