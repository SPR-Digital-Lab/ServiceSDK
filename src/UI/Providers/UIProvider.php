<?php
namespace SPR\ServiceSDK\UI\Providers;
use Illuminate\Support\ServiceProvider;


class UIProvider extends ServiceProvider
{
    public function register()
    {
       $this->loadViewsFrom('views', 'ui');
    }
}