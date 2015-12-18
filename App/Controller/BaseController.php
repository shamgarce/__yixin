<?php

namespace Controller;

use Grace\ControllerAbs;

//hook
class BaseController extends ControllerAbs{

      public function __construct(){
            parent::__construct();
            sapp('ap')->Middleware([
                'Init'    => \Controller\Middleware\Init::class,         //初始化视图
            ]);
      }
      //  '*'     //所有
      //  '@'     //登陆用户
      //  'A'     //管理员
      //  'G'     //游客
      //  '?'     //查询数据库

      public function behaviors()
      {
            return [
                'access' => [
                    'only' => [],                         //行为限定
                    'rules' => [
                        [
                            'actions' => [],              //行为限定
                            'allow' => true,              //判定
                            'roles' => ['G'],
                        ],
                    ],
                ],
            ];
      }


}
