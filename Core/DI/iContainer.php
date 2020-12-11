<?php

namespace Core\DI;

interface iContainer
{
    public static function get(string $name);
}
