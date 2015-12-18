<?php

namespace Sham\Ap;

    /*
    | --------------------------------------------------------------------------
    | AP的定义 - 对中间件进行调用和定义,执行,包括输出信息
    | --------------------------------------------------------------------------
    | 这里不对middle列表进行定义和检查,交给上层Application
    |
    */

use Sham\Set\Base;

class Ap extends Base
{

      private $_config              = array();
      private $middlewarelist              = array();

      public function __construct($config = array()){
            $this->_config = $config;
      }
      /*
      |--------------------------------------------------------------------------
      | 执行中间件
      |--------------------------------------------------------------------------
      |
      */
      public function Middleware($middlewarelist)
      {

            if(is_array($middlewarelist)){
                  foreach($middlewarelist as $key => $value){
                        //这里需要进一步测试,来展示对资源的占用情况
                        sapp('ground')->middleware($key,$value);                //ground
                        if(sc('debug')){
                              //debug 模式下直接调用
                              $this->middlewarelist[$key] = new $value;
                              $this->middlewarelist[$key]->run();;         //执行中间件
                        }else{
                              //debug = false unset
                              //or 这里关系到对内存的占用情况
                              $ms = new $value;
                              $ms->run();
                              unset($ms);
                        }
                  }
            }
      }

      /*
      |--------------------------------------------------------------------------
      | 调试方法
      |--------------------------------------------------------------------------
      | sapp()->vv('SysMiddlewareBusini');
      |
      */
      public function _vv($middlewarekey = null)
      {
            if(!sc('debug')) return null;
            if($middlewarekey){
                  return $this->middlewarelist[$middlewarekey]->view();
            }else{
                  return $this->middlewarelist;
            }
      }

}


