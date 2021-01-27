<?php

namespace Core\View;

use Core\Http\Request\iRequest;
use Core\Http\Response\iResponse;
use Core\Model\iModel;

class View implements iView
{
    public $Request;
    public $Response;

    public function __construct(iRequest $Request, iResponse $Response)
    {
        $this->Request  = $Request;
        $this->Response = $Response;
    }

    public function render(iModel $Model)
    {
        if (!empty($Model->code)) {
            $this->Response->code = $Model->code;
        }
        if (!empty($Model->headers)) {
            $this->Response->headers = $Model->headers;
        }
        $method = $this->Request->getMethod();
        \ob_start();
        if($method === 'get'){
            require $Model->layout;
            $this->Response->body = \ob_get_clean();
            $this->Response->send();
        } else {
            require $Model->mainContent;
            $response['content'] = \ob_get_clean();
            $response['title'] = $Model->title;
            $response['description'] = $Model->description;
            $this->Response->sendJson($response);
        }
    }

}
