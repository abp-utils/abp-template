<?php

namespace component\controller;

use component\controller\CommonController;
use Abp;
/**
 * Class ConsoleController
 * @package component
 */
class ConsoleController extends CommonController
{
    const NO_INTERACTION = '--no-interaction';

    protected $isInteraction = true;

    protected $params;

    /**
     * @return bool
     */
    public function beforeAction(): bool
    {
        if (php_sapi_name() !== 'cli') {
            Abp::debug('This script can only be run from the console');
            exit();
        }

        $params = Abp::argv();
        $paramsSort = [];
        unset($params[0]);
        foreach ($params as $param) {
            $paramsSort[] = $param;
        }
        $this->params = $paramsSort;

        if (isset($this->params[0]) && $this->params[0] == self::NO_INTERACTION) {
            $this->isInteraction = false;
        }

        return parent::beforeAction(); // TODO: Change the autogenerated stub
    }

    /**
     * @param mixed $object
     */
    public function _print($object)
    {
        if ($this->isInteraction) {
            print_r($object); echo PHP_EOL;
        }
    }
}