<?php

namespace Core\Router;

use Core\DI\Container;
use Core\Http\Request\iRequest;
use Core\Http\Response\iResponse;

class Router implements iRouter
{
    private $Request;
    private $Response;
    private $PDO;


    public function __construct(iRequest $request, iResponse $response)
    {
        $this->Request  = $request;
        $this->Response = $response;
        $this->PDO = Container::get('pdo');

        $this->dispatch();
    }


    private function dispatch()
    {
        $method     = $this->Request->getMethod();
        $requestUri = $this->Request->getRequestUri();
        $sitemap_table = \SITEMAP_TABLE;
        $sql = "SELECT `controller`, `action` FROM $sitemap_table WHERE `method`=:method AND `page_url`=:page_url LIMIT 1";
        $pdostmt = $this->PDO->prepare($sql);
        $pdostmt->execute([':method' => $method, ':page_url' => $requestUri]);
        $page = $pdostmt->fetch();

        if (!$page) {
            $this->Response->notFound();
        }

        $controller = $page['controller'];
        $action     = $page['action'] ?? 'index';

        $controller = Container::get("App\Controllers\\$controller");
        $controller->$action();
    }

}
