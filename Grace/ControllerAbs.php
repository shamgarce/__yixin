<?php


namespace Grace;

/**
* 控制器类
*/
class ControllerAbs //extends ControllerInterface
{

    public function __construct(){
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

    public function middleware(){
        return [
            // \Controller\TestMiddleware:class,
        ];
    }



}

