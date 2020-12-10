<?php

use App\Controllers\AdminController;
use App\Controllers\ApiController;
use App\Controllers\HomeController;
use App\Controllers\SliderController;
use Militer\mvcCore\Router;

//* Site routes

Router::get('^/$',        HomeController::class);
Router::get('/about',     HomeController::class, 'about');
Router::get('/portfolio', HomeController::class, 'portfolio');

Router::get('/slider', SliderController::class);

Router::get('/page/(?<id>[\w-]+)', PageController::class, 'pageId');


//* Admin routes

Router::get('/admin', AdminController::class);

//* API routes

Router::get(API . '/user', ApiController::class, 'getUser');

Router::post(API . '/store/set', ApiController::class, 'setCurrentStore');
// Router::
