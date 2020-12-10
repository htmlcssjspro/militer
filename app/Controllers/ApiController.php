<?php

namespace App\Controllers;

use Militer\mvcCore\Controller;
use Militer\mvcCore\Http\Request\Request;
use Militer\mvcCore\Http\Response\Response;

class ApiController extends Controller
{
    private $request;
    private $response;


    public function __construct(
        Request $request,
        Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
    }


    public function index()
    {
    }
}
