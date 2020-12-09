<?php

return [
    'driver'      => 'mysql',
    'host'        => 'localhost',
    'port'        => '',
    'name'        => 'militer',
    'username'    => 'root',
    'password'    => '',
    'pdo_options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ],
];