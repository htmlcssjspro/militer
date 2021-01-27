<?php

namespace Core\Controller;

abstract class aPageController extends aController
{
    public $pageId;


    public function __construct()
    {
        parent::__construct();
    }


    abstract public function index();
}
