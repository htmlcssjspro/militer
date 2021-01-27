<?php

namespace Core;

use Core\DI\Container;
use Core\Router\iRouter;

class App
{
    public static function start()
    {
        $Router = Container::get(iRouter::class);
    }
}
