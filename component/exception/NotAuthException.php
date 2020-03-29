<?php

namespace component\exception;

use Throwable;

class NotAuthException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Вы не авторизованы.';
        parent::__construct($message, $code, $previous);
    }
}