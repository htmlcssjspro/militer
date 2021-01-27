<?php

use App\User\User;
use Core\Csrf\Csrf;
use Core\Csrf\iCsrf;
use Core\DB\DB;
use Core\DB\iDB;
use Core\DI\Container;
use Core\DI\iContainer;
use Core\Http\Request\iRequest;
use Core\Http\Request\Request;
use Core\Http\Response\iResponse;
use Core\Http\Response\Response;
use Core\Router\iRouter;
use Core\Router\Router;
use Core\User\iUser;
use Core\View\iView;
use Core\View\View;


$aliases = [
    iUser::class => User::class,
    iCsrf::class => Csrf::class,

    iContainer::class  => Container::class,
    iDB::class         => DB::class,
    iRouter::class     => Router::class,
    iRequest::class    => Request::class,
    iResponse::class   => Response::class,
    iView::class       => View::class,
];


$definitions = [

    'config' => function () {
        return require _ROOT_ . '/config/config.php';
    },

    'dbConfig' => function () {
        return require _ROOT_ . '/config/database.php';
    },

    'pdo' => function (Container $container) {
        $db = $container::get(iDB::class);
        return $db::connect();
    },

    'messages' => function () {
        return require _ROOT_ . '/config/messages.php';
    },

    'dictionary' => function () {
        return require _ROOT_ . '/config/dictionary.php';
    },


];

$sets = array_merge($aliases, $definitions);
Container::sets($sets);
