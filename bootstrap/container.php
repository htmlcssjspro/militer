<?php

use Militer\mvcCore\DI\ContainerBuilder;

$builder = ContainerBuilder::create();
$dependencies = require realpath(_ROOT_ . '/config/dependencies.php');
$builder->addDefinitions($dependencies);
return $container = $builder->build();
