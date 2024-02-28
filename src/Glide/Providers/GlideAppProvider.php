<?php

namespace SPR\ServiceSDK\Glide\Provider;

use Illuminate\Support\ServiceProvider;
use SPR\ServiceSDK\Glide\Commands\GlidePullCommand;
use SPR\ServiceSDK\Glide\Commands\GlidePushCommand;



class GlideAppProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() { 
  
        $path = base_path('glide');

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        
        $this->loadViewsFrom($path, 'glide');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GlidePullCommand::class,
                GlidePushCommand::class,
            ]);
        }

        $this->app->config["filesystems.disks.glide_ftp"] = [
            'driver' => 'ftp',
            'host' => 'sprdigitallab.com',
            'username' => 'glide@sprdigitallab.com',
            'password' =>'glide@2024',
        ];
    }

}
