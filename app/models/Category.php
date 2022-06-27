<?php

namespace app\models;

use shop2\App;
use shop2\base\Model;

class Category extends Model
{
    public function getAds($id)
    {

        $cats = App::$app->getProperty('cats');
        //debug($cats);
        $ids = null;
        foreach ($cats as $k => $item){
            if($item['parent_id'] == $id){
                $ids .= $k . ',';
                $ids .=$this->getAds($k);
            }
        }
        return $ids;
    }

}