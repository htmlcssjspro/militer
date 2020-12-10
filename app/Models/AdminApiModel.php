<?php

namespace App\Models;

use Militer\mvcCore\Model\aApiModel;

class AdminApiModel extends aApiModel
{
    public function __construct()
    {
        parent::__construct();
    }


    public function login($loginData)
    {
        $sql = "SELECT `password` FROM {$this->adminTable} WHERE `login`=?";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute([$loginData['login']]);
        $data = $pdostmt->fetch();
        $hash = $data['password'];
        return \password_verify($loginData['password'], $hash);
    }

    public function updateAdminData($adminData)
    {
        $sql = "UPDATE {$this->sitemapTable} SET `page_url`=?, WHERE `text_id`='admin_login'";
        $pdostmt = $this->pdo->prepare($sql);
        $result = $pdostmt->execute([$adminData['loginUrl']]);
        if(!$result) {
            throw new \Exception("Ошибка обновления страницы ввода пароля");
        }

        $sql = "UPDATE {$this->adminTable} SET `login`=?, `password`=? WHERE `id`=1";
        $pdostmt = $this->pdo->prepare($sql);
        $result = $pdostmt->execute([$adminData['login'], $adminData['passwordHash']]);
        if(!$result) {
            throw new \Exception("Ошибка обновления данных администратора");
        }
        return true;
    }


}
