<?php

namespace Core\View;

use Core\Model\iModel;

interface iView
{
    public function render(iModel $Model);
}
