<?php

namespace Core\View;

use Core\Http\Response\iResponse;
use Core\Model\iModel;

class View implements iView
{
    public $Response;

    public function __construct(iResponse $Response)
    {
        $this->Response = $Response;
    }

    public function render(iModel $Model)
    {
        if ($Model->code) {
            $this->Response->code = $Model->code;
        }
        if ($Model->headers) {
            $this->Response->headers = $Model->headers;
        }
        \ob_start();
        require $Model->layout;
        $this->Response->body = \ob_get_clean();
        $this->Response->send();
    }
}
