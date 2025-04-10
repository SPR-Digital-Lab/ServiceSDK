<?php

namespace SPR\ServiceSDK\UI\Pages;
use SPR\ServiceSDK\UI\Pages\BasePage;

abstract class DashPage extends BasePage
{
    public $layout = 'glide.layouts.dash';

    public function getMenu()
    {
        return mainmenu();
    }
}
