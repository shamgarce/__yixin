<?php

namespace Sham\Vo;

use Sham\Set\Set;
/**
 * Class wise
 * @package Sham\Vo
 *
 * Vo 的对象示例
 * 配置文件直接读取print_r(Sham\Vo\Vo::getInstance()->ObjectConfig['Db']);
 * var_dump(Sham\Vo\Vo::getInstance()->make('db'));          //单例访问 [实例化]
 * var_dump(Sham\Vo\Vo::getInstance()->instances); //建立的对象 初始为空
 * Sham\Vo\Vo::getInstance()->make('db')->test();
 * //var_dump($vo);
 */


class Vo extends Set
{
      /**
       * @var null
       * wise单例调用
       */
      private static $_instance = null;       //单例调用

      //服务对象存储
      public $Providers       = array();             //服务对象存储 映射
      //服务对象配置信息存储
      public $ObjectConfig    = array();          //服务对象配置信息存储

      //对象映射
      public $FileReflect     = array();           //服务对象存储 映射
      //对象实例
      public $instances       = array();             //服务对象存储 实例

      public $routerMiddleware = array();             //路由中间件 实例
      public $Middleware      = array();             //中间件 实例

      private $rootpath       = '';     //配置文件的根目录

      /**
       * @param string $conf
       * 根据配置获取设定
       */
      private function __construct(){
            $this->rootpath = rtrim(APPROOT,'/').'/Config/';
            $voconfig = $this->load($this->rootpath."Vo.config.php");
            $this->FileReflect      = $voconfig['FileReflect'];         //配置文件映射
            $this->Providers        = $voconfig['Providers'];           //对象映射

            if(is_array($this->FileReflect)){
                  foreach($this->FileReflect as $key=>$file){
                        $this->ObjectConfig[ucfirst($key)] =  $this->load($file);
                  }
            }
           // print_r($this->ObjectConfig);       //获得配置 $this->ObjectConfig
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

      /*
      |------------------------------------------------------------
      | 路由中间件
      |------------------------------------------------------------
      |
      */

      public function make($abstract,$parameters=[])
      {
            $abstract = ucfirst($abstract);
            // If an instance of the type is currently being managed as a singleton we'll
            // just return an existing instance instead of instantiating new instances
            // so the developer can keep using the same objects instance every time.
            if (isset($this->instances[$abstract])) {
                  return $this->instances[$abstract];
            }
            //未定义的服务类 返回空值;
            if (!isset($this->Providers[$abstract])) {
                  return null;
            }
            // echo $abstract;

            $parameters = $parameters?:isset($this->ObjectConfig[$abstract])?$this->ObjectConfig[$abstract]:[];

            $this->instances[$abstract] = $this->build($abstract,$parameters);
            return $this->instances[$abstract];
      }

      public function build($abstract, array $parameters = [])
      {
            $obj_ = $this->Providers[$abstract];
            $obj = new $obj_($parameters);
            return $obj;
      }



}
