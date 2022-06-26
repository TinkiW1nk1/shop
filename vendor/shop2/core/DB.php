<?php

namespace shop2;

use RedBeanPHP\R;

class DB
{
    use TSingltone;
    protected function __construct()
    {
        $db = require_once(CONF . '/configDB.php');
        class_alias('\RedBeanPHP\R','\R');
        R::setup($db['dsn'],$db['user'],$db['pass']);
        if(!R::testConnection()){
            throw new \Exception('NO conect DB', 500);
        }
        R::freeze(true);
        if(DEBUG){
            R::DEBUG(true, 1);
        }
    }
}