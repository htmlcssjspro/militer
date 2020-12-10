<?php

namespace App\Controllers;

use App\Models\MainModel;
use Militer\mvcCore\Controller\aPageController;
use Militer\mvcCore\DI\Container;

class MainController extends aPageController
{
    public $Model;


    public function __construct(MainModel $model)
    {
        parent::__construct();
        $this->Model = $model;

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

        $_SESSION['town'] = $_SESSION['town'] ?? 'Самара';
    }

    public function index()
    {
        $this->Model->mainContent = \MAIN_HOME;
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->Model->getCurrencyData();
        $this->Model->getDeliveryCostData();
        $this->Model->getOrganizatorsData();
        $this->pageTextId = \MAIN_HOME_ID;
        $this->render();
    }

    public function tariffs()
    {
        $this->Model->mainContent = \MAIN_TARIFFS;
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->pageTextId = \MAIN_TARIFFS_ID;
        $this->render();
    }

    // public function info()
    // {
    //     $this->Model->mainContent = \MAIN_INFO;
    //     // $this->model->pageCSS[] = '/public/css/militerslider.css';
    //     // $this->model->pageJS[]  = '/public/js/militerslider.js';
    //     $this->pageTextId = \MAIN_INFO_ID;
    //     $this->render();
    // }

    public function user()
    {
        if ($this->Model->guest) {
            $this->Model->mainContent = \MAIN_GUEST;
        } else {
            $this->Model->mainContent = \MAIN_USER;
            if ($this->Model->organizator) {
                $this->Model->getUserOffers();
                $this->Model->getTownsList();
                $this->Model->offerDict = Container::get('offerDict');
            }
            $this->Model->getUserOrders();
        }
        //     $this->model->pageCSS[] = '/public/css/militerslider.css';
        //     $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->pageTextId = \MAIN_USER_ID;
        $this->render();
    }

    public function offers()
    {
        $this->Model->mainContent = \MAIN_OFFERS;
        //     $this->model->pageCSS[] = '/public/css/militerslider.css';
        //     $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->Model->getOffers();
        $this->pageTextId = \MAIN_OFFERS_ID;
        $this->render();
    }

    public function offer($uuid)
    {
        $this->Model->mainContent = \MAIN_OFFER;
        //     $this->model->pageCSS[] = '/public/css/militerslider.css';
        //     $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->Model->includes['ordersList'] = \INCLUDES_ORDERS_LIST;
        $this->Model->getOffer($uuid);
        $this->Model->offerDict = Container::get('offerDict');
        $this->pageTextId = \MAIN_OFFER_ID;
        $this->render();
    }

    public function vip()
    {
        $this->Model->mainContent = \MAIN_VIP_OFFERS;
        //     $this->model->pageCSS[] = '/public/css/militerslider.css';
        //     $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->Model->getVip();
        $this->pageTextId = \MAIN_VIP_OFFERS_ID;
        $this->render();
    }

    public function faq()
    {
        $this->Model->mainContent = \MAIN_FAQ;
        // $this->model->pageCSS[] = '/public/css/militerslider.css';
        // $this->model->pageJS[]  = '/public/js/militerslider.js';
        $this->pageTextId = \MAIN_FAQ_ID;
        $this->render();
    }
}
