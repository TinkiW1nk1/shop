<?php

namespace app\controllers;

use app\models\Cart;
use RedBeanPHP\R;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : 1;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;
        if($id) {
            $product = R::findOne('product', 'id = ?', [$id]);
            if (!$product) {
                return false;
            }
            if ($mod_id) {
                $mod = R::findOne('modification', 'id = ? AND product_id = ?', [$mod_id, $id]);
            }
        }
        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if($this->isAjax()){
            $this->loadView('add');
        }

    }
}