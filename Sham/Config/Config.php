<?php

namespace Sham\Config;

use Sham\Set\Base;

class Config
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

      public function get($file = '')
      {
            if(empty($file)) return array();
            $file = ucfirst($file);
            $file = rtrim(APPROOT,'/').'/Config/'.$file.'.php';
            //echo $file;
            if(file_exists($file)){
                  return include $file;
            }
            return array();
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
