<?php

namespace Core\Http\Response;

interface iResponse
{
    public function notFound();
    public function send();
}
