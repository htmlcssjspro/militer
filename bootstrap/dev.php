<?php

use Militer\devCore\Debug;

Debug::whoAmI(__FILE__);

function whoAmI($file)
{
    Debug::whoAmI($file);
}

function newClassInstance($class)
{
    Debug::newClassInstance($class);
}

function showRelPath($file)
{
    Debug::showRelPath($file);
}

function vd($obj)
{
    Debug::vd($obj);
}

function vdd($obj)
{
    vd($obj);
    exit;
}

function pr($obj)
{
    Debug::print($obj);
}

function server()
{
    Debug::server();
}
