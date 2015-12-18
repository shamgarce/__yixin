<?php

namespace Sham\Geter;

use Sham\Set\Base;

/*
 * 调试
//数据的调用
$de = sapp('geter');
$de->get('gs.demo.123');

//简单方式
sget('gs.demo.123');
//-----------------------------------------------------
//调试模式
$de->actions();       //返回出所有的方法
echo $de;
$de->demo();
$de();
//-----------------------------------------------------
 */


class Geter
{

      /*
      |--------------------------------------------------------------------------
      | $_config存储配置数据,用于反射
      |--------------------------------------------------------------------------
      | 在construct中执行$this->_config = $config;
      |
      */
      private $_config  = array();

      // *-----------------------------------------------------------------

      public function __construct($config = array()){
            $this->_config = $config;
      }

      public function getClass($m)
      {
            $classname = rtrim($this->_config['GeterNamespace'],'\\').'\\'.ucfirst($m);
            $mo = new $classname;
            return $mo;
      }

      public function get($key='')
      {
            $mc = explode('.',$key);
            $c = $mc[0]?:'';
            $c = ucfirst(strtolower($c)); //首字母大写
            $a = $mc[1]?:'index';
            $p = isset($mc[2])?$mc[2]:'';
            //===========================================================
            sapp('Ground')->geter($key);  //底层数据记录

            $class = $this->getClass($c);
            return $class->$a($p);
      }

      //=======================================

      public function demo()
      {
            /**
             *    'GeterPath'      => '../App/Geter/',
             *    'GeterNamespace' => 'App\Geter',
             */
      }

}
