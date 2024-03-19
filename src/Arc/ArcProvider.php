<?php

namespace SPR\ServiceSDK\Arc;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArcProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = @$this->app->config['arc'] ?? [];
        $service = @$config['service'];
        if ($service) {
            $url = @$config['url'] ?? 'service';
            $name = @$config['name'] ?? $service;
            $description = @$config['url'] ?? null;
            $mods = @$config['mods'] ?? [];
            $router = $this->app['router'];

            $reflect = [
                "service" => $service,
                "name" => $name,
                "description" => $description,
                "mods" => [],
            ];

            foreach ($mods as $mod) {
                $mod = app($mod);
                $reflect['mods'][] = [
                    'mod' => $mod->mod(),
                    'name' => $mod->name(),
                    'version' => $mod->version(),
                    "description" => $mod->description()
                ];
            }

            $router->middleware(['api'])->prefix($url)->group(function($router) use ($reflect,$url,$mods){
                $router->get('/',function () use ($reflect) {
                    return $reflect;
                });
                foreach($mods as $mod){
                    $mod = app($mod);
                    $router->get($mod->mod(),function () use ($mod) {
                        return $mod->reflect();
                    });
                    foreach($mod->readables() as $r){
                        $ra = app($r);
                        $router->get($mod->mod().'/'.$ra->signature(),$r);
                    }
                    foreach($mod->writables() as $w){
                        $wa = app($w);
                        $router->post($mod->mod().'/'.$wa->signature(),$w);
                    }
                }
            });


        }
    }
}
