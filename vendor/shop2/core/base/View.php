<?php
//базовий клас вьюшки
namespace shop2\base;

use mysql_xdevapi\Exception;

class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $layout;
    // для всіх данних які треба передати у вьюшку
    public $data = [];
    // для title, desc, keywords
    public $meta = [];


    public function __construct($route,$meta, $layout = '', $view = '')
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
    }
    //рендерить сторінку для користувача
    public function render($data)
    {
        if(is_array($data)) extract($data);
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        if(is_file($viewFile)){
            ob_start();
            require_once($viewFile);
            $content = ob_get_clean();
        }else{
            throw new \Exception("Не знайден вид - $viewFile", 500);
        }
        if(false !== $this->layout){
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($layoutFile)){
                require_once($layoutFile);
            }else{
                throw new \Exception("Не знайден шаблон - $this->layout", 500);
            }
        }
    }
    public function getMeta()
    {
        $output = '<title>'. $this->meta['title'].'</title>' . PHP_EOL;
        $output .= '<meta name="description" content ="'. $this->meta['description'] . '">' . PHP_EOL;
        $output .= '<meta name="kaywords" content ="'. $this->meta['keywords'] . '">' . PHP_EOL;
        return $output;
    }
}