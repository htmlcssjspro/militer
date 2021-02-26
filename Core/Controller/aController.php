<?php

namespace Core\Controller;

use Core\Csrf\iCsrf;
use Core\DI\Container;
use Core\Http\Response\iResponse;
use Core\User\iUser;
use Core\View\iView;

abstract class aController implements iController
{
    public $Model;

    protected $User;
    protected $Csrf;
    protected $config;


    public function __construct()
    {
        $this->User = Container::get(iUser::class);
        $this->Csrf = Container::get(iCsrf::class);
        $this->config = Container::get('config');
    }


}
