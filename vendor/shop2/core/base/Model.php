<?php

namespace shop2\base;

use shop2\DB;

abstract class Model
{
    //властивості моделі(ідентичний полям в БД)
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        DB::instance();
    }
}