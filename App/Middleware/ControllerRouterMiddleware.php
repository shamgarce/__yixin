<?php
/*
|--------------------------------------------------------
| 执行初始化操作
|--------------------------------------------------------
| 所有工作任务都可以规划到这个流程当中去,如果不够再重新规划,不破坏现有结构
| 调用方法为 App\Application::run();
|
|
SysMiddlewareEnvini                 => 必要的环境初始化和设置
sc() -> SysMiddlewareConfigini      => 配置文件的初始化和设置
sc() -> SysMiddlewareBusini         => 获得前端信息流模板       -> 获得 bus()
->获得完善完整的sc 和bus 信息模板
//ok 规划完成,交给控制器去执行
|
|
$list = [
      SysMiddlewareEnvini     => '',
      SysMiddlewareConfigini  => '',
      SysMiddlewareBusini     => '',
]
|
|
*/

namespace App\Middleware;

use Grace\Set\MiddlewareBase;
use Grace\Set\MiddlewareInterface;




class ControllerRouterMiddleware extends MiddlewareBase implements MiddlewareInterface
{
      /*
      |--------------------------------------------------------
      | 定义 中间件主体
      |--------------------------------------------------------
      |
      */
      public function handle($request, \Closure $next)
      {
            //建立中间件 & 行为

            //根据路由执行系列操作
            $basepath =       sc('Router')['m']?rtrim(APPROOT,'/').'/Modules/'.sc('Modulelist')[sc('Router')['m']].'/':rtrim(APPROOT,'/').'/';

            //|-----------------------------------------------
            $controller = '\Controller\\'.sc('Router')['c'];
            $action = sc('Router')['action'];
            $params = sc('Router')['param'];

            if(sc('Router')['m']){
                  $basepath = rtrim(APPROOT,'/').'/Modules/'.sc('Modulelist')[sc('Router')['m']].'/Controller/';
            }else{
                  $basepath = rtrim(APPROOT,'/').'/'.'Controller/';
            }
            $basecontrollerpath     = $basepath.'BaseController.php';
            $controllerextpath      = $basepath.(sc('Router')['c']).'.'.(sc('Router')['a']).'.php';
            $controllerpath         = $basepath.(sc('Router')['c']).'.php';

            //加载基类 - 如果基类存在,则加载
            includeIfExist($basecontrollerpath);

            //尝试扩展控制器 - 尝试控制器
            includeIfExist($controllerextpath);
            if(!class_exists($controller)){
                  includeIfExist($controllerpath);
            }
            //--------------------------------------------------------

            if(!class_exists($controller)){     //控制器还没有找到,则报错
                  //404
                  bus('e' ,[
                          'msg'=>'404 controller miss'
                      ]
                  );
                  geter('e.e404');
//                  echo $controller.'404 controller miss';
            }

            //实例化
            bus('controller', new $controller());                 //这里已经正常了

            //寻找扩展方法
            if(!method_exists(bus('controller'), $action)){
                  bus('e' ,[
                          'msg'=>'404 method miss'
                      ]
                  );
                  geter('e.e404');
//                  echo $action.'404 method miss';
            }


            // Perform action
            return $next($request);
      }

}
