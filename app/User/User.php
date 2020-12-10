<?php

namespace App\User;

use Militer\mvcCore\User\aUser;

class User extends aUser
{
    protected $usersTable = \USERS_TABLE;
    protected $organizatorsTable = \ORGANIZATORS_TABLE;

    public string $userUuid;


    public function __construct()
    {
        parent::__construct();
        $this->init();
    }


    private function init()
    {
        $this->userUuid = $_SESSION['user_uuid'] ?? \STATUS_GUEST;
    }


    public function login($login, $password)
    {
        $sql = "SELECT `user_uuid`, `password` FROM {$this->usersTable} WHERE `email`=? LIMIT 1";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute([$login]);
        $userData = $pdostmt->fetch();
        $passwordHash = $userData['password'];
        return \password_verify($password, $passwordHash) ? $userData['user_uuid'] : false;
    }


    public function getUserData()
    {
        $sql = "UPDATE {$this->usersTable} SET `last_visit`=CURRENT_DATE() WHERE `user_uuid`='{$this->userUuid}'";
        $this->pdo->query($sql);

        $sql = "SELECT `user_uuid`, `username`, `status`, `balance` FROM {$this->usersTable} WHERE `user_uuid`='{$this->userUuid}'";
        return $this->pdo->query($sql)->fetch();
    }


}
