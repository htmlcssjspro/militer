<?php

namespace App\Models;

use Militer\mvcCore\Model;

class LayoutDefaultModel extends Model
{

    public function __construct()
    {
        $this->layout = \VIEWS . '/layouts/layoutDefault.php';
        $this->header = \VIEWS . '/includes/header.php';
        $this->footer = \VIEWS . '/includes/footer.php';
        $this->aside  = \VIEWS . '/includes/aside.php';

        $this->layoutCSS = '/public/css/layout.css';
        $this->mainCSS   = '/public/css/main.css';
        $this->mainJS    = '/public/js/main.js';
    }


    public function getData()
    {
        $this->data = [];
    }
}
