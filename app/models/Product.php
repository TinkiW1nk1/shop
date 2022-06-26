<?php

namespace app\models;

use shop2\base\Model;

class Product extends Model
{
    public function setRecentlyViewed($id)
    {
        $rViewed = $this->getAllRecentlyViewed();
        if(!$rViewed){
            setcookie('recentlyViewed', $id, time() + 3600*24, '/');
        }else{
            $rViewed = explode('.', $rViewed);
            if(!in_array($id, $rViewed)){
                $rViewed[] .= $id;
                $rViewed = implode('.', $rViewed);
                setcookie('recentlyViewed', $rViewed, time() + 3600*24, '/');
            }
        }
    }

    public function getRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])){
            $recentlyViewed = $_COOKIE['recentlyViewed'];
            $rViewed = explode('.', $recentlyViewed);
            return array_slice($rViewed, -3);

        }
        return false;
    }

    public function getAllRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])){
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }



}