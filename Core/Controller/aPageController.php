<?php

namespace Core\Controller;

use Militer\mvcCore\DI\Container;
use Militer\mvcCore\View\iView;

abstract class aPageController extends aController
{
    public $pageTextId;
    private $View;


    public function __construct()
    {
        parent::__construct();
        $this->View = Container::get(iView::class);
    }


    public function render()
    {
        $this->Model->getPageData($this->pageTextId);
        $this->View->render($this->Model);
    }

    abstract public function index();
}
