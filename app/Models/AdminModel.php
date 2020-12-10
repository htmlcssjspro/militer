<?php

namespace App\Models;

class AdminModel extends LayoutAdminModel
{
    public function __construct()
    {
        parent::__construct();
        $this->title       = 'militer/admin';
        $this->description = 'militer/admin';
        $this->mainContent = \ADMIN . '/Views/pages/AdminHomePage.php';
        // $this->pageCSS     = ['/public/css/militerslider.css'];
        // $this->pageJS      = ['/public/js/militerslider.js'];

        $this->headers = [];
    }

    public function getData()
    {
        $this->data = [];
    }
}
