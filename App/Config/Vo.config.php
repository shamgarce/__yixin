<?php
    /*
    |--------------------------------------------------------------------------
    | 文件配置信息
    |--------------------------------------------------------------------------
    | 这部分设计为不要随便改动;部分配置改动需要配合系统级调试界面
    | 注意大小写
    | 格式:对象名首字母大写
    |
    */

return [

    /*
    |--------------------------------------------------------------------------
    | 配置信息映射
    |--------------------------------------------------------------------------
    |
    | 配置信息在文件中,访问 :
    | 格式,对象名首字母大写
    */

    'FileReflect'    => [
        'Db'        => '../App/Config/Db.php',         //Mysql配置
        'Geter'     => '../App/Config/Geter.php',      //geter配置
 //       'Struct'    => '../App/Config/Struct.php',
        'Cookies'   => '../App/Config/Cookies.php',
//        'Ap'        => '../App/Config/Ap.php',
        'Mmc'       => '../App/Config/Mmc.php',
        'SQLite'       => '../App/Config/SQLite.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | 类文件的映射
    |--------------------------------------------------------------------------
    |
    | 配置信息在文件中,访问 : Sham\Wise\Wise::getInstance()->ObjectConfig
    | 格式,对象名首字母大写
    */

    'Providers'=>[
        'Db'        => Sham\Db\Db::class,       //数据访问对象
        'Geter'     => Sham\Geter\Geter::class, //静态化数据获取
        'Req'       => Sham\Req\Req::class,     //前端数据获取
//        'Struct'    => Sham\Struct\Struct::class,   //后台结构
        'Config'    => Sham\Config\Config::class,   //获取配置信息
        'Cookies'   => Sham\Cookies\Cookies::class, //cookie操作对象
        'Ap'        => Sham\Ap\Ap::class,           //操作流对象
//        'Mmc'       => Sham\Mmc\Mmc::class,         //memcache对象
        'Wise'      => Sham\Wise\Wise::class,         //memcache对象
        'View'      => Sham\View\View::class,         //memcache对象
        'SQLite'      => Sham\SQLite\SQLite::class,         //memcache对象
        'Ground'      => Sham\Ground\Ground::class,         //系统脚手架
    ],

];

