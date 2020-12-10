<?php

namespace App\Models;

use Militer\mvcCore\Model\aPageModel;

class AdminModel extends aPageModel
{
    public array $pagesData = [];
    public $currency;
    public $offers;
    public $loginUrl;


    public function __construct()
    {
        parent::__construct();
    }


    public function getAdminAsideData()
    {
        $sql = "SELECT `label`, `page_url` FROM {$this->sitemapTable} WHERE `admin_aside`=1";
        $this->adminAsideData = $this->pdo->query($sql)->fetchAll();
    }

    public function getPagesData()
    {
        $sql = "SELECT `label`, `page_url`, `title`, `description` FROM {$this->sitemapTable} WHERE `admin`=1";
        $this->pagesData = $this->pdo->query($sql)->fetchAll();
    }

    public function getUsersList()
    {
        $sql = "SELECT `user_uuid`, `username`, `name`, `email`, `status`, `phone`, `last_visit`, `register_date` FROM {$this->usersTable}";
        $this->usersList = $this->pdo->query($sql)->fetchAll();
    }

    public function getLoginUrl()
    {
        $sql = "SELECT `page_url` FROM {$this->sitemapTable} WHERE `text_id`='admin_login' LIMIT 1";
        $this->loginUrl = $this->pdo->query($sql)->fetch(\PDO::FETCH_COLUMN);
    }


}
