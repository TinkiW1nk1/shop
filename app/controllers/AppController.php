<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\currency\Currency;
use RedBeanPHP\R;
use shop2\App;
use shop2\base\Controller;
use shop2\Cashe;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        //запис валюи в реестр
        App::$app->setProperty('currencies', Currency::getCurrencies());
        Currency::getCurrency(App::$app->getProperty('currencies'));
        App::$app->setProperty('currency',Currency::getCurrency(App::$app->getProperty('currencies')));
        App::$app->setProperty('cats', self::casheCategory());

    }
    public static function casheCategory()
    {
        $cashe = Cashe::instance();
        $cats = $cashe->get('cats');
        if(!$cats){
            $cats = R::getAssoc("SELECT * FROM category");
            $cashe->set('cars', $cats);
        }
        return $cats;

    }

}