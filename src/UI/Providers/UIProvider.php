<?php

namespace SPR\ServiceSDK\UI\Providers;

use Illuminate\Support\ServiceProvider;


class UIProvider extends ServiceProvider
{
    public function boot()
    {
        $path = base_path('ServiceSDK' . DIRECTORY_SEPARATOR . 'views');
        if (is_dir($path)) {
            $this->loadViewsFrom($path, 'sdk');
        }
    }
}
