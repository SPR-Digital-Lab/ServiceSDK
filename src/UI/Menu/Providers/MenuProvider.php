<?php

namespace SPR\ServiceSDK\UI\Menu\Providers;

use Illuminate\Support\ServiceProvider;
use SPR\ServiceSDK\UI\Menu\MenuItem;
use SPR\ServiceSDK\UI\Menu\MenuSystem;

class MenuProvider extends ServiceProvider
{


    public function register()
    {
        $this->app->singleton(MenuSystem::class, function ($app) {
            $system = new MenuSystem();
            (function (MenuItem $menu) {
                $menuFile = base_path("menu.php");
                if (file_exists($menuFile)) {
                    include $menuFile;
                }
            })($system->menu("main-menu"));
            return $system;
        });
    }
}
