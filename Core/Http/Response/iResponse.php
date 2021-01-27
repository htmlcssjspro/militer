<?php

namespace Core\Http\Response;

interface iResponse
{
    public function notFound();
    public function sendJson($array);
    public function send();
}
