<?php

namespace SPR\ServiceSDK\Cipher\Providers;

use SPR\ServiceSDK\Cipher\CipherService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CipherAppProvider extends ServiceProvider
{
    /**
     * Register the custom guard.
     *
     * @return void
     */
    
    protected function register()
    {
        CipherService::RegisterHandler();
        Config::set('auth.guards.cipher', [
            'driver' => 'cipher',
        ]);
    }

}