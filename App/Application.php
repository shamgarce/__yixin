<?php

namespace App;

use Grace\Set\Set;

    /*
    |------------------------------------------------
    | 总控类
    |------------------------------------------------
    */

class Application extends Set
{
      /*
      |------------------------------------------------
      | 信息流入口
      |------------------------------------------------
      | 对信息流底层进行各种中间件操作,执行最后结果交给控制器
      |------------------------------------------------
      |
      */

      public static function DoController()
      {
            /*
            |------------------------------------------------
            | 入口数据 sc
            | 出口数据 bus
            |------------------------------------------------
            */

            //D(sc());

            //psr-0     //自动加载middleware
            spl_autoload_register(array('App\Application', 'autoload_middleware'));


            //建立视图bus
            sapp('ap')->Middleware([
                'ControllerViewMiddleware' => \App\Middleware\ControllerViewMiddleware::class,         //初始化视图
                'ControllerRouterMiddleware' => \App\Middleware\ControllerRouterMiddleware::class,     //建立控制器
                'ControllerRBACMiddleware' => \App\Middleware\ControllerRBACMiddleware::class,         //建立md beharivers 并且执行RBAC
                'ControllerBeforeMiddleware' => \App\Middleware\ControllerBeforeMiddleware::class,     //
                'ControllerRunMiddleware' => \App\Middleware\ControllerRunMiddleware::class,           //执行
                'ControllerAfterMiddleware'   => \App\Middleware\ControllerAfterMiddleware::class,        //后置操作
            ]);
            exit;
      }

      public static function run()
      {
            !defined('APPROOT') && define('APPROOT', '../App/');;

            sc([
                'debug' => dc('debug'),
                'error_reporting' => dc('error_reporting'),
            ]);

            // 应用到类

//            set_error_handler(array('App\Application', 'my_error_handler'));
//            示例的做法

            /*
            |------------------------------------------------
            | 错误抑制
            |------------------------------------------------
            */

            if (sc('debug')) {
                  //错误报告
                  ini_set('error_reporting', sc('error_reporting'));
            } else {
                  //不报告任何错误
                  error_reporting(0);
            }


            /*
            |------------------------------------------------
            | 初始化 App/Config/Config.php
            |------------------------------------------------
            */
            sapp('ap')->Middleware([
                  //初始化的信息流处理
                'SysMiddlewareConfigini' => \Grace\Middleware\SysMiddlewareConfigini::class,         //建立dc
                'SysMiddlewareEnvini' => \Grace\Middleware\SysMiddlewareEnvini::class,            //建立sc() unset dc
                'SysMiddlewareRouter' => \Grace\Middleware\SysMiddlewareRouter::class,
                'SysMiddlewareBusbuild' => \Grace\Middleware\SysMiddlewareBusbuild::class,
            ]);
            //D(sc());
            //D(dc());          //debug = false 的时候置空


            /* -> 获得底层数据sc
            |------------------------------------------------
            | 初始化 App/Config/Config.php
            |------------------------------------------------
            |            开始释放控制权
            */
            self::DoController();

      }

      /**
       * 自动加载函数
       *
       * @param string $class 类名
       *                      加载 Controller/middleware
       */
      public static function autoload_middleware($class)
      {
            $classpath = bus('root') . 'Controller/Middleware/';
            $class = str_replace('Controller\Middleware\\', '', $class);
            $classfile = $classpath . $class . '.php';
            //首先检查在应用目录中是否存在该类，存在加载，不存在，则到根下寻找
            includeIfExist($classfile);
      }

//      public static function my_error_handler($errno, $errstr, $errfile, $errline)
//      {
//            echo 123;
//      }


}









