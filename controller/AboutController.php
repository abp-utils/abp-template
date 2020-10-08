<?php

namespace controller;

use component\controller\CommonController;

class AboutController extends CommonController
{
    public function indexAction()
    {
        $this->title = 'О нас';

        $this->render([]);
    }
}