<?php

use Militer\mvcCore\Interfaces\iContainer;

return [
    'config'    => function (iContainer $container) {
        return require _ROOT_ . '/config/config.php';
    },
    'db'        => function (iContainer $container) {
        return require _ROOT_ . '/config/database.php';
    },
    'pdo'       => function (iContainer $container) {
        return new Militer\mvcCore\DB($container->get('db'));
    },
    'Router'    => function (iContainer $container) {
        return new \Militer\mvcCore\Router();
    },
];
