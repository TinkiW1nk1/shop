<?php

namespace app\controllers;

use app\models\Bradcrumbs;
use app\models\Category;
use RedBeanPHP\R;
use shop2\base\Controller;

class CategoryController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $category = R::findOne('category', 'alias = ?', [$alias]);
        if(!$category){
            throw new \Exception('Connect Error', 404);
        }
        //breadcrums
        $breadcrumbs = Bradcrumbs::getBreadCrumbs($category->id);

        $car_model = new Category();
        $ids = $car_model->getAds($category->id);
        $ids = !$ids ? $ids = $category->id : $ids . $category->id;
        $products = R::find('product', "category_id IN ($ids)");

        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact('category', 'products', 'breadcrumbs'));
    }

}