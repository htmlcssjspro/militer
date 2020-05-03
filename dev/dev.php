<?php

use Dev\Debug as Debug;

echo 'i am required from: ' . __FILE__ . '<br>';
echo $_SERVER['DOCUMENT_ROOT'] . '<br>';
echo __FILE__ . '<br>';
echo __DIR__ . '<br>';
echo dirname(__DIR__) . '<br>';
echo _ROOT_ . '<br>';
echo '<br>';




// Debug::pre(debug_print_backtrace());
// Debug::vd($_SESSION);
// Debug::vd($_COOKIE);
// Debug::print($_COOKIE);
// Debug::print($_ENV);
// Debug::server();
// Debug::print($_SERVER);
// Debug::vd($_GET);
// Debug::vd($_POST);
