<?php

namespace App\User;

use Core\DI\Container;
use Core\User\aUser;

class User extends aUser
{
    protected $usersTable;
    protected $config;

    public string $userUuid;


    public function __construct()
    {
        parent::__construct();
        $this->config = Container::get('config');
        $dbTables = $this->config['dbTables'];
        $this->usersTable = $dbTables['users'];
        $this->init();
    }


    private function init()
    {
        $this->userUuid = $_SESSION['user_uuid'] ?? 'guest';
    }


    public function login($login, $password)
    {
        $sql = "SELECT `user_uuid`, `password` FROM `{$this->usersTable}` WHERE `email`=? LIMIT 1";
        $pdostmt = $this->PDO->prepare($sql);
        $pdostmt->execute([$login]);
        $userData = $pdostmt->fetch();
        $passwordHash = $userData['password'];
        return \password_verify($password, $passwordHash) ? $userData['user_uuid'] : false;
    }




    public function getUserData()
    {
        $sql = "UPDATE {$this->usersTable} SET `last_visit`=CURRENT_DATE() WHERE `user_uuid`='{$this->userUuid}'";
        $this->PDO->query($sql);

        $sql = "SELECT `user_uuid`, `username`, `status`, `balance` FROM {$this->usersTable} WHERE `user_uuid`='{$this->userUuid}'";
        return $this->PDO->query($sql)->fetch();
    }


}
