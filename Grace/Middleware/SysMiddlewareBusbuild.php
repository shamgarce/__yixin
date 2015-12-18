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

class SysMiddlewareBusbuild extends MiddlewareBase implements MiddlewareInterface
{
      /*
      |--------------------------------------------------------
      | 定义 中间件主体
      |--------------------------------------------------------
      |
      */
      public function handle($request, \Closure $next)
      {

            //初步建立bus
            bus('root',       sc('Router')['m']?rtrim(APPROOT,'/').'/Modules/'.sc('Modulelist')[sc('Router')['m']].'/':rtrim(APPROOT,'/').'/');
            $m = sc('Router')['m']?:'N';
            $c = sc('Router')['c']?:'N';
            $a = sc('Router')['a']?:'N';
            $e = sc('Router')['e']?:'N';
            $t = sc('Router')['type']?:'N';

            bus('mc', "$m.$c");
            bus('mca', "$m.$c.$a");
            bus('mcaet', "$m.$c.$a.$e.$t");

            //bus('page', sc('Router')['m']."_".sc('Router')['c']."_".sc('Router')['a']);
           // bus('pageex', sc('Router')['m']."_".sc('Router')['c']."_".sc('Router')['a']."_".sc('Router')['e']."_".sc('Router')['type']);

            bus('app',        sc('App'));
            bus('router',     sc('Router'));
            bus('env',        sc('Env'));

            bus('get',        sapp('Req')->get);
            bus('post',        sapp('Req')->post);

            bus('view',        []);

            // Perform action
            return $next($request);
      }

}
