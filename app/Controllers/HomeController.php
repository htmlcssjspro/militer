<?php

namespace App\Controllers;

use App\Models\HomeModel;
use Militer\mvcCore\Controller;

class HomeController extends Controller
{
    public function __construct(HomeModel $model)
    {
        parent::__construct($model);
    }
}
