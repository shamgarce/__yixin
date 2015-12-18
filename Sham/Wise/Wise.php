<?php

namespace Sham\Wise;

use Sham\Set\Set;
/**
 * Class wise
 * @package Sham\wise
 */

class Wise extends Set
{
      /**
       * @var null
       * wise单例调用
       */
      private static $_instance = null;       //单例调用
      public $_config  = array();              //C函数的存储
      public $_configdc  = array();              //文件配置file
      public $_configbus  = array();              //用户配置
      private $rootpath = '';

      /**
       * @param string $conf
       * 根据配置获取设定
       */
      private function __construct(){
            $this->rootpath = rtrim(APPROOT,'/').'/Config/';            //配置文件的根目录
            $this->_configdc = $this->load($this->rootpath."Config.php");
      }

      /**
       * @param $conf
       * @return wise|null
       * 单例调用
       */
      public static function getInstance(){
            if(!(self::$_instance instanceof self)){
                  self::$_instance = new self();
            }
            return self::$_instance;
      }

      /**
       * @param $key
       * @return null
       * 调用其中的数据
       */
      function __invoke($key = null) {
            //设置一个值
            $res['dc'] = $this->_configdc[$key];
            $res['ec'] = $this->_configec[$key];
            $res['uc'] = $this->_configuc[$key];
            $res['bus'] = $this->_configbus[$key];
            return $res;
      }

}
