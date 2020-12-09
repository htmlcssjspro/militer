<?php

use Militer\mvcCore\App;
use Militer\mvcCore\Exception\UserException;

define('MILITER_START', microtime(true));

// session_start();
// $_SESSION['count'] = isset($_SESSION['count']) ? (++$_SESSION['count']) : 0;


require dirname(__DIR__) . '/bootstrap/bootstrap.php';

require _ROOT_ . '/vendor/autoload.php';

UserException::init();

require _ROOT_ . '/config/container.php';

require _ROOT_ . '/config/routes.php';

App::start();






if (DEV) {
    require _ROOT_ . '/dev/test.php';
    echo '<br>Время выполнения скрипта: <strong>' . (microtime(true) - MILITER_START) . '</strong> секунд.';
}