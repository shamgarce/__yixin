<?php

namespace Controller;

use Grace\ControllerAbs;

//hook
class BaseController extends ControllerAbs{

    public function __construct()
    {
        parent::__construct();
        sapp('ap')->Middleware([
            'Init'    => \Controller\Middleware\Init::class,         //初始化视图
        ]);
        header('Content-Type: text/html; charset=utf-8'); //网页编码

    }



} 
