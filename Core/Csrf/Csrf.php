<?php

namespace Core\Csrf;

class Csrf implements iCsrf
{
    public function __construct()
    {
        $this->init();
    }


    private function init()
    {
        $_SESSION['csrf_secret'] = $_SESSION['user_uuid'] ?? 'guest';
        $_SESSION['csrf_token']  = \password_hash($_SESSION['csrf_secret'], PASSWORD_DEFAULT);
    }

    public function verify($csrfToken)
    {
        return \password_verify($_SESSION['csrf_secret'], $csrfToken);
    }
}
