<?php
    // 1-режим розроботки 0- продакшн
    define("DEBUG", 1);
    define("ROOT", dirname(__DIR__));
    define("WWW", ROOT . '/public');
    define("APP", ROOT . '/app');
    define("CONF", ROOT . '/config');
    define("CORE", ROOT . '/vendor/shop2/core');
    define("LIBS", CORE . '/libs');
    define("CASHE", ROOT . '/tmp/cashe');
    define("VENDOR", ROOT . '/vendor');
    define("TMP", ROOT . '/tmp');
    define("VIEWS", APP . '/views');
    define("WIDGETS", APP . '/widgets');
    //дефолтний шаблон
    define("LAYOUT", 'watches');
    //контсанта на url головнох сторінки
    $app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
    $app_path = preg_replace("#[^/]+$#", '', $app_path);
    $app_path = str_replace('/public/', '', $app_path);
    define("PATH", $app_path);
    define("ADMIN", PATH . 'admin');
    require_once VENDOR . '/autoload.php';