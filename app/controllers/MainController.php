<?php

namespace app\controllers;

use RedBeanPHP\R;
use shop2\App;
use shop2\base\Controller;
use shop2\Cashe;

class MainController extends AppController
{

    public function indexAction()
    {
        //вешает сайт
    // $this->setMeta(App::$app->getProperty('shop_name'), 'desc', 'keywords');
        $brands = R::find('brand', 'LIMIT 3');

        $hits = R::find('product', "hit = '1' AND status = '1' LIMIT 8");
        $this->set(compact('brands', 'hits'));
        $this->setMeta('Shop', 'desc', 'keywords');
    }

}