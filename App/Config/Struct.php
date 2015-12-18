<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/2 0002
 * Time: 20:05
 */

return [
    '用户管理'=>[
        [
            // -> user.userlist
            'controller'=> 'user',              //控制器
            'mothed'    => 'userlist',          //方法
            'icon'      => 'fa-calendar',       //图标
            'menu'      => '用户管理',          //菜单项,为空则不放在菜单里面
            'title'     => '用户管理',          //详细页标题
            'subtitle'  => '对用户的增删改',    //详细页副标题
            'noticetype'=> 'info',//fa-ban info warning check            //提示信息类型
            'notice'    => '请在用户的定义之后填写相对应的权限',         //提示信息
            // path     => '路径通过计算得出', 首页>用户列表>用户管理    //面包屑
        ],
        [
            // -> user.userlist
            'controller'=> 'user',
            'mothed'    => 'userpw',
            'icon'      => 'fa-calendar',
            'menu'      => '用户权限',          //菜单项,为空则不放在菜单里面
            'title'     => '权限分配',
            'subtitle'  => '对用户的权限进行配置',
            'notice'    => '请在用户的定义之后填写相对应的权限',
            // path     => '路径通过计算得出', 首页>用户列表>用户管理
            // rule     => selfdefine
        ],
    ],
    '数据管理'=>[

    ],
    '系统管理'=>[],
];