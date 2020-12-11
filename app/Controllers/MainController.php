<?php

namespace App\Controllers;

use App\Models\MainModel;
use Militer\mvcCore\Controller\aPageController;
use Militer\mvcCore\DI\Container;

class MainController extends aPageController
{
    public $Model;


    public function __construct(MainModel $Model)
    {
        parent::__construct();
        $this->Model = $Model;

        if ($this->User->userUuid === \STATUS_GUEST) {
            $this->Model->userData['status'] = \STATUS_GUEST;
            $this->Model->guest = true;
        } else {
            $userData = $this->Model->userData = $this->User->getUserData();
            if ($userData['status'] === \STATUS_USER) {
                $this->Model->user = true;
            } elseif ($userData['status'] === \STATUS_ORGANIZATOR) {
                $this->Model->user = true;
                $this->Model->organizator = true;
            }
        }

        $this->Model->layout = \MAIN_LAYOUT;
        $this->Model->header = \MAIN_HEADER;
        $this->Model->footer = \MAIN_FOOTER;
        $this->Model->aside  = \MAIN_ASIDE;

        $this->Model->mainCSS = \MAIN_CSS;
        $this->Model->mainJS  = \MAIN_JS;

        $this->Model->headers[] = '';
    }


    public function index()
    {
        $this->Model->mainContent = \MAIN_HOME;
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->pageTextId = \MAIN_HOME_ID;
        $this->render();
    }

    public function user()
    {
        if ($this->Model->guest) {
            $this->Model->mainContent = \MAIN_GUEST;
        } else {
            $this->Model->mainContent = \MAIN_USER;
        }
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->pageTextId = \MAIN_USER_ID;
        $this->render();
    }

}
