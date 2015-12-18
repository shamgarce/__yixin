<?php

namespace Sham\Set;

/**
 * Class wise
 * @package Sham\wise
 */

class Base extends Set
{
      /*
       |--------------------------------------------------------------------------
       | $_config存储配置数据,用于反射
       |--------------------------------------------------------------------------
       | 在construct中执行$this->_config = $config;
       |
       */
      private $_config  = array();

      public function __construct($config = array()){
            $this->_config = $config;
      }


      /*
      |--------------------------------------------------------------------------
      | 通用 : 返回所有的方法
      |--------------------------------------------------------------------------
      |
      */
      public function actions(){
            return [
                'classname' => get_class($this),
                'methods'   => array_diff(get_class_methods($this),[
                    'actions',
                    '__construct',
                    '__toString',
                    '__invoke'
                ]),
                '_config'   => $class_vars = get_class_vars(get_class($this)),
            ];
      }

      /*
      |--------------------------------------------------------------------------
      | 通用 : 返回简单的名称和说明
      |--------------------------------------------------------------------------
      |
      */
      function __toString()
      {
            return '数据操作对象 Db :对数据库的增删改';
      }

      /*
      |--------------------------------------------------------------------------
      | 通用 : 返回配置信息
      |--------------------------------------------------------------------------
      | 返回所有值,或者返回某一个值
      |
      */
      function __invoke($key = []) {
            if(is_string($key)){
                  return $this->_config[$key];
            }else{
                  return $this->_config;
            }
      }
}
