<?php

namespace Core\Controller;

use Core\Csrf\iCsrf;
use Core\DI\Container;
use Core\Http\Response\iResponse;
use Core\User\iUser;
use Core\View\iView;

abstract class aController implements iController
{
    protected $User;
    protected $Csrf;
    protected $Model;

    private $View;

    protected $config;


    public function __construct()
    {
        $this->User = Container::get(iUser::class);
        $this->Csrf = Container::get(iCsrf::class);
        $this->View = Container::get(iView::class);
        $this->config = Container::get('config');
    }


    public function render()
    {
        $this->Model->getPageData($this->pageId);
        $this->View->render($this->Model);
    }
}
