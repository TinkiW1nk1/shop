<?php
//Класс Додатку
namespace shop2;

class App
{
    //контейнер для додатку
    public static $app;

    public function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        //обьект класу реестра
        self::$app = Regestry::instance();
        $this->getParams();
        new ErrorHandler();
        Router::dispatch($query);
    }
    //отримуемо параметри
    protected function getParams()
    {
        $params = require_once(CONF . '/params.php');
        if(!empty($params)){
            foreach ($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }

}