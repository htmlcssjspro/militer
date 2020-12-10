<?php

namespace App\Models;

use Militer\mvcCore\Model;

class LayoutAdminModel extends Model
{

    public function __construct()
    {
        $this->layout = \ADMIN . '/Views/layouts/AdminLayout.php';
        $this->header = \ADMIN . '/Views/includes/header.php';
        $this->footer = \ADMIN . '/Views/includes/footer.php';
        $this->aside  = \ADMIN . '/Views/includes/aside.php';

        $this->layoutCSS = '/public/css/admin/layoutAdmin.css';
        $this->mainCSS   = '/public/css/admin/admin.css';
        $this->mainJS    = '/public/js/admin/admin.js';
    }


    public function getData()
    {
        $this->data = [];
    }
}
