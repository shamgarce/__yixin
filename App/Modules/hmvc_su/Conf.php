<?php
/**
 * modules 可以在这里设置，并且覆盖前面的设置
 */

return [
    /*
    |--------------------------------------------------------------------------
    | 要覆盖总体配置
    |--------------------------------------------------------------------------
    */
    'Env' => [
        'WDS'               => DIRECTORY_SEPARATOR,

        /*
        |--------------------------------------------------------------------------
        | 时区
        |--------------------------------------------------------------------------
        | Asia/Shanghai – 上海
        | Asia/Chongqing – 重庆
        | Asia/Urumqi – 乌鲁木齐
        | Asia/Hong_Kong – 香港
        | Asia/Macao – 澳门
        | Asia/Taipei – 台北
        | Asia/Singapore – 新加坡
        | RPC - 中国
        |
        */
        'default_timezone'  => 'PRC',
        'charset'           => 'utf-2228',         //编码说明
    ],

    /*
    |--------------------------------------------------------------------------
    | App相关定义
    |--------------------------------------------------------------------------
    |
    | 配置信息,访问 : Sham\Wise\Wise::getInstance()->_config
    |
    */
    'App' => [
        'default_controllerer'                => 'home',
        'default_controller'                => 'home',
        'default_controller_method'         => 'index',
        'default_controller_method_prefix'  => 'do',

        'error_page_404'    => 'error/error_404.php',
        'error_page_500'    => 'error/error_500.php',
        'error_page_msg'    => 'error/error_msg.php',
        'message_page_view' => 'error/error_view.php',
    ],


    //注册中间件
    'Middleware' => [
        'authUser123' => App\Middleware\User::class,
    ],


];
