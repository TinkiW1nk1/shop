<?php

namespace shop2;

class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Виключення', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode() );
    }
    //логвання помилки
    public function logErrors($massage = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст помилки: {$massage} | Файл: {$file} | Строка: {$line}\n==========================\n", 3,
            TMP . '/errors.log');
    }
    //віобрадення помилки....
    public function displayError($errno, $errstr, $errfile, $errline, $responce = 404)
    {
        http_response_code($responce);
        if($responce == 404 && !DEBUG){
            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG){
            require WWW . '/errors/dev.php';
        }else{
            require WWW . '/errors/prod.php';
            die;
        }
    }
}