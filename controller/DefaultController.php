<?php

namespace controller;

use component\controller\CommonController;
use Abp;

class DefaultController extends CommonController
{
    public function indexAction()
    {
        Abp::redirect('about');
    }
}