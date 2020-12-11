<?php

namespace Core\Controller;

use Core\Csrf\iCsrf;
use Core\DI\Container;
use Core\User\iUser;
use Core\View\iView;

abstract class aController implements iController
{
    public $User;
    public $Csrf;
    public $Model;

    private $View;


    public function __construct()
    {
        $this->User = Container::get(iUser::class);
        $this->Csrf = Container::get(iCsrf::class);
        $this->View = Container::get(iView::class);
    }


    public function render()
    {
        $this->Model->getPageData($this->pageTextId);
        $this->View->render($this->Model);
    }

    abstract public function index();
}
