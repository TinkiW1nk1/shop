<?php

namespace app\widgets\meny;

use RedBeanPHP\R;
use shop2\App;
use shop2\Cashe;

class Meny
{
    protected $data;
    protected $tree;
    protected $menyHtml;
    protected $tpl;
    protected $container = 'ul';
    protected $class = 'menu';
    protected $table = 'categoty';
    protected $cashe = 3600;
    protected $casheKey = 'ShopMenu';
    protected $attrs = [];
    protected $prepand = '';

    public function __construct($options=[])
    {
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }
    protected function getOptions($options)
    {
        foreach ($options as $k => $v){
            if(property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }
    protected function run()
    {
        $cashe = Cashe::instance();
        $this->menyHtml = $cashe->get($this->casheKey);
        if(!$this->menyHtml){
            $this->data = App::$app->getProperty('cats');
            if(!$this->data){
                $this->data = $cats = R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTrea();
            $this->menyHtml = $this->getMenuHTML($this->tree);
            if($this->cashe){
                $cashe->set($this->casheKey, $this->menyHtml, $this->cashe);
            }
        }
        $this->output();

    }

    protected function getTrea()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node){
            if(!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHTML($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category){
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab , $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

    protected function output()
    {
        $attrs = '';
        if(!empty($this->attrs)){
            foreach ($this->attrs as $k => $v){
                $attrs .= " $k='$v'";
            }
        }
        echo "<{$this->container} class='{$this->class}' $attrs> ";
        echo $this->prepand;
        echo $this->menyHtml;
        echo "</{$this->container}>";
    }



}