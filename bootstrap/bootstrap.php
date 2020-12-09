<?php

define('_ROOT_', dirname(__DIR__));
define('CONTROLLERS',    _ROOT_ . '/App/Controllers');
define('MODELS',         _ROOT_ . '/App/Models');
define('VIEWS',          _ROOT_ . '/App/Views');
define('ADMIN',          _ROOT_ . '/Admin');
define('ERROR_LOG_FILE', _ROOT_ . '/log/errors.log');

define('_PUBLIC_',       _ROOT_ . '/public');
define('PAGE_404',       _PUBLIC_ . '/404.php');

define('API', '/api/v1');

define('DEV', true); // Установить в false на production
// DEV ? error_reporting(E_ALL) : error_reporting(0);

if (DEV) {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    ini_set('error_reporting', -1);
    error_reporting(E_ALL);
    require _ROOT_ . '/dev/devHelper.php';
} else {
    error_reporting(0);
}
