<?php
//базовий клас контроллер
namespace shop2\base;

use shop2\App;

abstract class Controller
{
    public $route;
    public $controller;
    public $layout;
    public $view;
    public $model;
    public $prefix;
    // для всіх данних які треба передати у вьюшку
    public $data = [];
    // для title, desc, keywords
    public $meta = ['title' => '', 'description' => '', 'keywords' => ''];


    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }
    //в масив ДАТА помістити данні
    public function set($data)
    {
        $this->data = $data;
    }
    public function getView()
    {
        $viewObject = new View($this->route, $this->meta, $this->layout, $this->view);
        $viewObject->render($this->data);
    }

    public function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $desc;
        $this->meta['kaywords'] = $keywords;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
    //повертае вьюху на Ajax-запит
    public function loadView($view, $vars = [])
    {
        extract($vars);
        require VIEWS . "/{$this->prefix}{$this->controller}/{$view}.php";
        die;
    }
}