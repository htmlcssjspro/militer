<?php

namespace App\Controllers;

use App\Models\AdminApiModel;
use Militer\mvcCore\Controller\aApiController;

class AdminApiController extends aApiController
{
    public $Model;


    public function __construct(AdminApiModel $Model) {
        parent::__construct();
        $this->Model = $Model;
    }


    public function index()
    {
    }

    public function login()
    {
        $this->csrfVerify(function ($adminLoginData) {
            $this->Model->login($adminLoginData) && $_SESSION['admin'] = true;
        });
    }

}
