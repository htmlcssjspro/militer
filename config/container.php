<?php

use App\Csrf\Csrf;
use Militer\mvcCore\Interfaces\iCsrf;
use App\User\User;
use Militer\mvcCore\Interfaces\iUser;
use Militer\mvcCore\Controller;
use Militer\mvcCore\Interfaces\iController;
use Militer\mvcCore\DB;
use Militer\mvcCore\Interfaces\iDB;
use Militer\mvcCore\DI\Container;
use Militer\mvcCore\DI\Interfaces\iContainer;
use Militer\mvcCore\Http\Request\Request;
use Militer\mvcCore\Http\Request\iRequest;
use Militer\mvcCore\Http\Response\Response;
use Militer\mvcCore\Http\Response\iResponse;
use Militer\mvcCore\Router;
use Militer\mvcCore\Interfaces\iRouter;
use Militer\mvcCore\View;
use Militer\mvcCore\Interfaces\iView;

$aliases = [
    // iApi::class  => Api::class,
    iUser::class => User::class,
    iCsrf::class => Csrf::class,

    iContainer::class  => Container::class,
    iController::class => Controller::class,
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
