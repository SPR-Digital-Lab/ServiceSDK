<?php

namespace SPR\ServiceSDK\UI\Menu;
use Illuminate\Support\Str;

class MenuSystem
{

    /**
     * @var MenuItem[] $menu;
     */
    protected $menu;

    public function __construct(){
        $this->menu = [];
    }

    public function menu(string $menu){
        if(!isset($this->menu[$menu]))
        $this->menu[$menu] = (new MenuItem($menu))->setName(Str::title($menu));
        return $this->menu[$menu];
    }
}
