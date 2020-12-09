<?php

namespace App\Models;

use Militer\mvcCore\Model;

class HomeModel extends LayoutDefaultModel
{
    public function __construct()
    {
        parent::__construct();
        $this->title       = 'slider Title';
        $this->description = 'slider Description';
        $this->mainContent = \VIEWS . '/pages/sliderPage.php';
        // $this->pageCSS     = ['/public/css/militerslider.css'];
        // $this->pageJS      = ['/public/js/militerslider.js'];

        $this->headers = [];
    }

    public function getData()
    {
        $this->data = [];
    }
}
