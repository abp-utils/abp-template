<?php

namespace controller;

use component\controller\CommonController;
use abp\core\Request;
use abp\exception\UserException;

class ProfileController extends CommonController
{
    public function beforeAction(): bool
    {
        if (!$this->getUser()) {
            $this->redirect('');
        }
        return parent::beforeAction(); // TODO: Change the autogenerated stub
    }

    public function indexAction()
    {
        $this->title = 'Профиль';
        $user = $this->getUser();

        try {
            if ($user->load(Request::post())) {
                if (!$user->save()) {
                    throw new UserException('Не удалось сохранить данные. Попробуйте еще раз.');
                }
                $this->addSuccess('Информация о профиле была обновлена.');
                $this->redirect('profile');
            }
        } catch (UserException $e) {
            $this->addError($e->getMessage());
        } catch (\Throwable $e) {
            $this->addError();
        }

        $this->render([
            'user' => $user,
        ]);
    }
}