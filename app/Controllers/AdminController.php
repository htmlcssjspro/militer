<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Core\Controller\aPageController;
use Core\DI\Container;
use Core\Http\Response\iResponse;

class AdminController extends aPageController
{
    public $Model;

    public function __construct(AdminModel $Model)
    {
        parent::__construct();
        $this->Model = $Model;

        $adminConfig = $this->config['admin'];

        $this->Model->layout = $adminConfig['layout'];
        $this->Model->header = $adminConfig['header'];
        $this->Model->footer = $adminConfig['footer'];
        $this->Model->aside  = $adminConfig['aside'];

        $this->Model->mainCSS = $adminConfig['css'];
        $this->Model->mainJS  = $adminConfig['js'];

        $this->Model->headers[] = '';

        $this->Model->getAdminAsideData();
    }


    public function loginPage()
    {
        $this->pageId = 'admin_login_page';
        $this->Model->layout = $this->config['admin']['login'];
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->render();
    }

    public function index()
    {
        $this->adminCheck();
        $this->pageId = 'admin_home_page';
        $this->Model->mainContent = $this->config['admin']['pages']['home'];
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->render();
    }

    public function pages()
    {
        $this->adminCheck();
        $this->Model->mainContent = $this->config['admin']['pages']['pages'];
        $this->pageId = 'admin_pages';
        $this->Model->getPagesData();
        $this->render();
    }

    public function usersList()
    {
        $this->adminCheck();
        $this->Model->mainContent = \ADMIN_USERS_LIST;
        $this->pageTextId = \ADMIN_USERS_LIST_ID;
        $this->Model->getUsersList();
        $this->Model->userDict = Container::get('userDict');
        $this->render();
    }

    public function preferences()
    {
        $this->adminCheck();
        $this->pageId = 'admin_preferences';
        $this->Model->mainContent = $this->config['admin']['pages']['preferences'];
        $this->Model->getLoginUrl();
        $this->render();
    }


    private function adminCheck()
    {
        if (!isset($_SESSION['admin'])) {
            $Response = Container::get(iResponse::class);
            $Response->notFound();
        }
    }



}
