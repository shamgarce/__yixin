<?php

namespace Grace\Set;

/**
 * Class wise
 * @package Sham\wise
 */

interface MiddlewareInterface {
      function __construct();                               //创建方法
      function run();                                       //执行
      function next();                                      //回调
      function request();                                   //入口参数
      function handle($request, \Closure $next);            //中间件执行
      function BeforeHandle($request, \Closure $next);      //前置执行
      function AfterHandle($request, \Closure $next);       //后置执行
      function terminate($request);                         //最后操作
      function view();                                      //debug下的调试
}

