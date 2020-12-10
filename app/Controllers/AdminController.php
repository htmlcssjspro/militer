<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Militer\mvcCore\Controller;

class AdminController extends Controller
{
    public function __construct(AdminModel $model)
    {
        parent::__construct($model);
    }
}
