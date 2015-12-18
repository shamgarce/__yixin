<?php

namespace Sham\Struct;

use Sham\Set\Base;

class Struct extends Base
{

      /*
      |--------------------------------------------------------------------------
      | request 获取
      |--------------------------------------------------------------------------
      |
      |
      */
      private $_config  = array();
      // *-----------------------------------------------------------------
      public function __construct($config = array()){
            $this->_config = $config;
      }

      //完整的菜单
      public function menu()
      {
      }

      //某一个页面的信息
      public function pageinfo($controller,$mothed='index')
      {
      }

      public function all()
      {
            return $this->_config;
      }

      //=======================================
      public function demo()
      {
//          print_r(sc('Router'));
            /**
             *    获得对get post cookie file session 的支持
             */
      }

}
