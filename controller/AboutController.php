<?php

namespace controller;

use abp\exception\DatabaseException;
use component\controller\CommonController;
use abp\core\Request;
use component\exception\UserException;
use model\User;

class AboutController extends CommonController
{
    public function indexAction()
    {
        $this->title = 'О нас';

        $this->render([]);
    }
}