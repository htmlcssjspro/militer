<?php

Militer\devCore\Debug::whoAmI(__FILE__); // Удалить в production.  // Для разработки самого фреймворка

define('DEV', true); // Установить в false на production
DEV ? error_reporting(E_ALL) : error_reporting(0);

set_error_handler(['Militer\mvcCore\Exception\UserException', 'errorHandler'], E_ALL);
set_exception_handler(['Militer\mvcCore\Exception\UserException', 'exceptionHandler']);

define('_ROOT_', dirname(__DIR__));
define('CONTROLLERS', realpath(_ROOT_ . '/App/Controllers'));
define('MODELS', realpath(_ROOT_ . '/App/Models'));
define('VIEWS', realpath(_ROOT_ . '/App/Views'));
define('ERROR_LOG_FILE', realpath(_ROOT_ . '/log/errors.log'));
