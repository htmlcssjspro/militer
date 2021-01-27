<?php

use Core\App;
use Core\Exception\UserException;

define('MILITER_START', microtime(true));

session_start();

// $_SESSION['count'] = isset($_SESSION['count']) ? (++$_SESSION['count']) : 0;

require dirname(__DIR__) . '/config/bootstrap.php';

require _ROOT_ . '/vendor/autoload.php';

UserException::init();

require _ROOT_ . '/config/container.php';

App::start();
