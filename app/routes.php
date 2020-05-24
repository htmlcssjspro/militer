<?php

use Militer\mvcCore\Router;


Router::add('^/(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?/?(?<query>[a-z_-]+)?$');

Router::add('^/api/(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?$');

Router::add(
    '^/?$',
    [
        'controller' => 'Home',
        'action' => 'index'
    ]
);
