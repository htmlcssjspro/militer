<?php

namespace Core\Model;

use Core\DI\Container;

abstract class aModel implements iModel
{
    protected $PDO;

    protected $sitemapTable      = \SITEMAP_TABLE;
    protected $usersTable        = \USERS_TABLE;
    protected $adminTable        = \ADMIN_TABLE;


    public function __construct(){
        $this->PDO = Container::get('pdo');
    }


}
