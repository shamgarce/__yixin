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

namespace Grace\Middleware;

use Grace\Set\MiddlewareBase;
use Grace\Set\MiddlewareInterface;

      /*
       * 跟环境和用户无关 主要是固定不变的配置文件信息
      |--------------------------------------------------------
      | 定义 最后的动作 获得底层数据 dc();
      |--------------------------------------------------------
      | 跟用户无关,配置文件的信息
      |
      */
class SysMiddlewareConfigini extends MiddlewareBase implements MiddlewareInterface
{

      /*
      |--------------------------------------------------------
      | 定义 中间件主体
      |--------------------------------------------------------
      |
      */
      public function handle($request, \Closure $next)
      {
            // Perform action

            /*
            |------------------------------------------------
            | 载入系统初始化信息 Vo.config.php初始化 App/Config/Config.php
            |------------------------------------------------
            */
            //载入模块配置信息
            dc('Vo',config('Vo.config'));                  //vc() 获取

            //环境信息
            dc('Environment',\Grace\Environment::getInstance()->all());

            //get / post 信息
            $res['get']       = sapp('req')->get;
            $res['post']       = sapp('req')->post;
            dc('Req',$res);

            /*
            |--------------------------------------------------------
            | 模块信息 / 根据根据get post 获取
            |--------------------------------------------------------
            */
            //
            if(dc('Req')['get']['m']){
                  //修改fc 记录用户config
                  $file = rtrim(APPROOT,'/').'/Modules/'.dc('Modulelist')[dc('Req')['get']['m']].'/Conf.php';
                  $config = $this->load($file);
                  dc('Module',$config);
            }
            return $next($request);
      }

}
