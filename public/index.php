<?php

session_start();

require realpath(__DIR__ . '/../vendor/autoload.php');
require realpath(__DIR__ . '/../config/config.php');

$app = new App\App();
