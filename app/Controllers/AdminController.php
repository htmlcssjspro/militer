<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Militer\mvcCore\Controller\aPageController;
use Militer\mvcCore\DI\Container;
use Militer\mvcCore\Http\Response\iResponse;

class AdminController extends aPageController
{
    public $Model;

    public function __construct(AdminModel $Model)
    {
        parent::__construct();
        $this->Model = $Model;

        $this->Model->layout = \ADMIN_LAYOUT;
        $this->Model->header = \ADMIN_HEADER;
        $this->Model->footer = \ADMIN_FOOTER;
        $this->Model->aside  = \ADMIN_ASIDE;

        $this->Model->mainCSS = \ADMIN_CSS;
        $this->Model->mainJS  = \ADMIN_JS;

        $this->Model->headers[] = '';

        $this->Model->getAdminAsideData();
    }


    public function login()
    {
        $this->Model->layout = \ADMIN_LOGIN;
        $this->pageTextId = \ADMIN_LOGIN_ID;
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->render();
    }

    public function index()
    {
        $this->adminCheck();
        $this->Model->mainContent = \ADMIN_HOME;
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->pageTextId = \ADMIN_HOME_ID;
        $this->render();
    }

    public function pages()
    {
        $this->adminCheck();
        $this->Model->mainContent = \ADMIN_PAGES;
        $this->pageTextId = \ADMIN_PAGES_ID;
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
        $this->Model->mainContent = \ADMIN_PREFERENCES;
        $this->pageTextId = \ADMIN_PREFERENCES_ID;
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
