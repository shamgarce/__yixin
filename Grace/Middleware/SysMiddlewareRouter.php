<?php
      /*
      |--------------------------------------------------------
      | 执行初始化操作
      |--------------------------------------------------------
      |
      |
      */

namespace Grace\Middleware;

use Grace\Set\MiddlewareBase;
use Grace\Set\MiddlewareInterface;

class SysMiddlewareRouter extends MiddlewareBase implements MiddlewareInterface
{
      /*
      |--------------------------------------------------------
      | 定义 中间件主体
      |--------------------------------------------------------
      |
      */
      public function handle($request, \Closure $next)
      {
            $action   = 'do'.ucfirst(sc('Get')['a']?:sc('App')['default_controller_method']);
            if(sc('Get')['e']) $action .= '_'.ucfirst(sc('Get')['e']);
            if(sc('Environment')['REQUEST_METHOD'] != 'GET') $action .= ucfirst(strtolower(sc('Environment')['REQUEST_METHOD']));

            $tpl   = sc('Get')['a']?:sc('App')['default_controller_method'];
            if(sc('Get')['e']) $tpl .= '_'.sc('Get')['e'];
            if(sc('Environment')['REQUEST_METHOD'] != 'GET') $tpl .= strtolower(sc('Environment')['REQUEST_METHOD']);


            //echo $action;

            sc('Router',[
                  'type'      => sc('Environment')['REQUEST_METHOD'],
                  'm'         => sc('Get')['m'],
                  'c'         => sc('Get')['c']?:sc('App')['default_controller'],
                  'a'         => sc('Get')['a']?:sc('App')['default_controller_method'],
                  'e'         => sc('Get')['e'],
                  'Prefix'    => sc('App')['default_controller_method_prefix'],
                  'param'     => sc('Get')['_param'],
                  'params'    => sc('Get'),
                'action'      => $action,                   //方法引导
                'tpl'         => $tpl,                   //方法引导

                  //|--------------------------------------------------------
                  //文件 controller.action.php
                  //或者 controller.php
                  //|--------------------------------------------------------
                  //'actionFile'=> ucfirst(sc('Get')['a']),   //文件引导      //同A
                  //'tpl'       => sc('Get')['a'].'.htm',                     //a.htm
                  //'Appbase'   => '../App/basdfasdf/asdf/asdf',
                  //'cname'   => asdfasdfsf::Lclass,            //控制器调用地址
            ]);
            // Perform action
            //建立router信息
            return $next($request);
      }

}
