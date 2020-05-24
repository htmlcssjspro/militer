<?php

// Удалить в production.  // Для разработки самого фреймворка

use Militer\devCore\Debug;

echo '<br>' . str_repeat("=", 80) . '<br>';
echo '=== Начало тестового вывода<br>';
Debug::whoAmI(__FILE__);

// Debug::server();
// print_r($_GLOBALS);
// Debug::print($_SERVER);
// Debug::print($_GET);
// Debug::print($_POST);
// Debug::print($_FILE);
// Debug::print($_REQUEST);
// Debug::print($_SESSION);
// Debug::print($_COOKIE);
// Debug::print($_ENV);
// Debug::print(getenv());
// Debug::print(get_defined_constants(true));

// Debug::print();
// Debug::vd();
// Debug::print($container->get('dbConfig'));
// Debug::print($container->get('Router'));
// Debug::print($container->show());
// Debug::vd($container->get('pdo'));

// $home = new App\Controllers\HomeController;
// Debug::vd(($home instanceof Militer\mvcCore\Interfaces\ControllerInterface));;

echo '<br>=== Конец тестового вывода<br>';
echo str_repeat("=", 80) . '<br>';
