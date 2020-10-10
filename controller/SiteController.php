<?php

namespace controller;

use component\controller\CommonController;
use abp\exception\UserException;
use component\form\Login;
use component\form\Reg;
use Abp;

class SiteController extends CommonController
{
    /**
     * @return bool
     */
    public function beforeAction(): bool
    {
        if ($this->action == 'logout') {
            return parent::beforeAction(); // TODO: Change the autogenerated stub
        }
        if ($this->_getUser()) {
            $this->redirect('profile');
        }
        return parent::beforeAction(); // TODO: Change the autogenerated stub
    }

    public function loginAction()
    {
        $this->title = 'Авторизация';
        $form = new Login();

        try {
            if ($form->load(Abp::post())) {
                if ($form->login()) {
                    $this->redirect('');
                }
                throw new UserException('Неверный логин или пароль');
            }
        } catch (UserException $e) {
            $this->addError($e->getMessage());
        } catch (\Throwable $t) {
            $this->addError();
        }

        $this->render(['form' => $form]);
    }

    /**
     * @param array $param
     * @throws \abp\exception\NotFoundException
     */
    public function regAction(array $param = [])
    {
        $this->title = 'Регистрация';
        $form = new Reg();

        try {
            if ($form->load(Abp::post())) {
                if ($form->reg()) {
                    $this->redirect('');
                }
            }
        } catch (UserException $e) {
            $this->addError($e->getMessage());
        } catch (\Throwable $t) {
            $this->addError('Неизвестная ошибка.');
        }

        $this->render(['form' => $form]);
    }

    /**
     * @inheritDoc
     */
    public function logoutAction()
    {
        Abp::dropCookie('username');
        Abp::dropCookie('hash');
        $this->redirect('');
    }
}