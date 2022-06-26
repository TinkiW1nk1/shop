<?php

namespace app\controllers;

use app\models\Bradcrumbs;
use app\models\Product;
use RedBeanPHP\R;

class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        if(!$product){
            throw new \Exception('цигани все скупили', '404');
        }
        //breadcrumbs
            $breadcrumbs = Bradcrumbs::getBreadCrumbs($product->category_id, $product->title);
        //звьязані товари
        $related = R::getAll("SELECT * FROM related_product JOIN product ON id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);


        //запис в кукі запрошеного товара
            $p_model  = new Product();
            $p_model->setRecentlyViewed($product->id);
        //товари які вже дивилися
            $r_viewed = $p_model->getRecentlyViewed();

            $recentlyViewed = null;
            if($r_viewed){
                $recentlyViewed = R::find('product', 'ID IN (' . R::genSlots($r_viewed) . ') LIMIT 3', $r_viewed );
            }
        //Gallery
        $gallery = R::findAll('gallery', 'product_id = ?', [$product->id]);


        //модифікації товари
        $mods = R::findAll('modification', 'product_id = ?', [$product->id]);


        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->set(compact('product', 'related', 'gallery','recentlyViewed','breadcrumbs', 'mods'));
    }


}