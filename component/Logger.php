<?php

namespace component;

use abp\component\ErrorHandler;

class Logger extends ErrorHandler
{
    public static function exception_handler($exception)
    {
        //write log file
        parent::exception_handler($exception);
    }

    /**
     * @param string $message
     * @param string $level
     * @param mixed $data
     */
    public static function writeLog($message, $level, $data)
    {
        //write log file
    }
}