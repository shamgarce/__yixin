<?php

namespace Grace\Set;

/**
 * Class wise
 * @package Sham\wise
 */

class MiddlewareBase extends Set
{
      public $res = [];

      public function __construct(){
            //记录入口数据
             if(sc('debug')) $this->res['begin'] = $this->request();
      }

      /*
      |--------------------------------------------------------
      | 中间件封装执行
      |--------------------------------------------------------
      | 调用 (new $Middle)->run();
      |
      */
      public function run()
      {
            $next    = $this->next();
            $this->terminate(
                $this->AfterHandle(
                    $this->Handle(
                        $this->BeforeHandle(
                            $this->request(),$next
                        ),$next
                    ),$next
                )
            );
      }

      /*
      |--------------------------------------------------------
      | 定义callback
      |--------------------------------------------------------
      |
      */
      public function next()
      {
            return function($request){return $request;};
      }

      /*
      |--------------------------------------------------------
      | 定义 入口数据
      |--------------------------------------------------------
      |
      */
      public function request()
      {
            //return sc();
            return null;
      }

      /*
      |--------------------------------------------------------
      | 定义 中间件主体
      |--------------------------------------------------------
      |
      */
      public function handle($request, \Closure $next)
      {
            // Perform action
            return $next($request);
      }

      /*
      |--------------------------------------------------------
      | 执行一些前置操作
      |--------------------------------------------------------
      |
      */
      public function BeforeHandle($request, \Closure $next)
      {
            // Perform action
            return $next($request);
      }

      /*
      |--------------------------------------------------------
      | 执行一些后置操作
      |--------------------------------------------------------
      |
      */
      public function AfterHandle($request, \Closure $next)
      {
            $response = $next($request);
            // Perform action
            return $response;
      }


      /*
      |--------------------------------------------------------
      | 定义 最后的动作
      |--------------------------------------------------------
      | 不返回数据,中断执行或者写入数据等
      |
      */
      public function terminate($request = null)
      {
            //处理结束后做一些操作
            // Store the session data...
            if(sc('debug')) $this->res['end'] = $request; //记录结果数据
            //return $request;
      }

      public function view()
      {
           return $this->res;
            //调试模式,输出系列数据进行调试
      }


}
