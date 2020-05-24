<?php

define('MILITER_START', microtime(true));

// session_start();

require realpath(__DIR__ . '/../vendor/autoload.php');
require realpath(__DIR__ . '/../bootstrap/bootstrap.php');
require realpath(__DIR__ . '/../bootstrap/dev.php');


use Militer\mvcCore\Router\Router;
use Militer\mvcCore\App;

$container = require realpath(_ROOT_ . '/bootstrap/container.php');

require realpath(_ROOT_ . '/App/routes.php');

$router = $container->get('Router');

// $router = new Router();






// $config = require realpath(__DIR__ . '/../config/config.php');
// $container->setDependency('config', $config);





// $app = new App();



// Router::getRoutesGET(); // test
// Router::dispatch($request); // test



// if (Router::matchRoute($request)) {
//     Router::getRoute();
// } else {
//     echo '404';
// }

// // получить запрос
// $request = new Request();
// // обработать запрос

// // сформировать ответ
// $response = new Response($request);
// // отправить ответ
// $response->send();



//
require _ROOT_ . '/dev/test.php'; // Удалить в production.  // Для разработки самого фреймворка
//
echo '<br>Время выполнения скрипта: <strong>' . (microtime(true) - MILITER_START) . '</strong> секунд.';
