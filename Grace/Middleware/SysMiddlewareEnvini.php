<?php
      /*
      |--------------------------------------------------------
      | 不进行数据操作 定义出接口底层数据, nc
      |--------------------------------------------------------
      | 不对sc 和bus 进行实质性操作
      |
      */

namespace Grace\Middleware;

use Grace\Set\MiddlewareBase;
use Grace\Set\MiddlewareInterface;

class SysMiddlewareEnvini extends MiddlewareBase implements MiddlewareInterface
{
      /*
      |--------------------------------------------------------
      | 执行一些前置操作
      |--------------------------------------------------------
      |
      */
      public function BeforeHandle($request, \Closure $next)
      {
            //建立sc模板
            //根据dc 得到sc unset(dc);
            sc([
                'App'         => '',
                'Env'         => '',
                'Router'      => '',
                'Get'         => '',
                'Post'        => '',
                'Usertable'        => '',
                'Page'        => '',
                'Menu'        => '',
                'Middleware'  => '',
                'Modulelist'  => '',
                'ActionExt'   => '',
                'Environment' => '',
                'Vo'          => '',
                'Lb'          => '',
            ]);
            // Perform action
            //return $next($request);
      }

      /*
      |--------------------------------------------------------
      | 定义 中间件主体
      |--------------------------------------------------------
      |
      */
      public function handle($request, \Closure $next)
      {

            sc([
                'App'         => isset(dc('Module')['App'])?array_merge(dc('App'),dc('Module')['App']):dc('App'),
                'Env'         => isset(dc('Module')['Env'])?array_merge(dc('Env'),dc('Module')['Env']):dc('Env'),
                'Router'      => '',
                'Get'         => dc('Req')['get'],
                'Post'        => dc('Req')['post'],
                'Usertable'   => dc('Usertable'),
                'Page'        => '',
                'Menu'        => '',
                'Middleware'  => isset(dc('Module')['Middleware'])?array_merge(dc('Middleware'),dc('Module')['Middleware']):dc('Middleware'),
                'Modulelist'  => dc('Modulelist'),
                'ActionExt'   => dc('ActionExt'),
                'Environment' => dc('Environment'),
                'Vo'          => dc('Vo'),
            ]);
            return $next($request);
      }

      public function terminate($request = null)
      {
            $dc = dc();
            unset($dc['debug']);
            unset($dc['error_reporting']);
            unset($dc['App']);
            unset($dc['Env']);
            unset($dc['Module']['App']);
            unset($dc['Module']['Env']);
            unset($dc['Middleware']);
            unset($dc['Module']['Middleware']);
            unset($dc['Modulelist']);
            unset($dc['ActionExt']);
            unset($dc['Req']);
            unset($dc['Vo']);
            unset($dc['Usertable']);
            unset($dc['Environment']);
            sc('Lb',$dc);

            //ok 完成了sc 的建立
            //unset(dc());
            //注销dc
            if(sc('debug')){
                  $this->res['end'] = $request; //记录结果数据
            }else{
                  \Sham\Wise\Wise::getInstance()->_configdc = array();   //值置空
            }
            //return $request;
      }
}
