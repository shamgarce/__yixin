<?php

namespace Sham\Req;

use Sham\Set\Base;

class Req extends Base
{

      /*
       * 获得重要的两个值 get post
       * $req->get
       * $req->post
      |--------------------------------------------------------------------------
      | request 获取
      |--------------------------------------------------------------------------
      | 对于get 是一个参数传递的集合 包括以下几个部分
      1 : $_GET
      2 : getpath
      3 : getpathparams
      4 : getquery
      5 : querystring
      6 : params
      |
      */
      private $_config  = array();
      // *-----------------------------------------------------------------
      public function __construct($config = array()){
            $this->_config = $config;
      }

      public function __get($key='')
      {
            switch($key){
                  case 'env':
                        return \Grace\Environment::getInstance()->all();
                        break;
                  case 'getquery':
                        return $this->getquery();
                        break;
                  case 'getpath':
                        return $this->getpath();
                        break;
                  case 'get':
                        return $this->_get();
                        break;
                  case 'post':
                        return $_POST;
                        break;
            }
      }

      /*
      |-----------------------------------------------------------------
      | 综合输出
      |-----------------------------------------------------------------
       *
       */
      public function _get()
      {
            $res = array_merge($this->getpath()['params'],$this->getpath());
            $res = array_merge($res,$this->getquery());
            unset($res['params']);
            return $res;
      }


      //根据path传递的参数
      public function getpath()
      {
            $path = \Grace\Environment::getInstance()->all()['path'];
            $path = trim($path,'/');
            $v = array();
            $v['m'] = '';           //模块
            $v['c'] = '';           //控制器
            $v['a'] = '';           //方法
            $v['e'] = '';           //扩展方法
            $v['_param'] = '';     //快捷参数

            $_path = explode('/', $path);
            foreach($_path as $k=>$value){
                  if(empty($value)) unset($_path[$k]);
            }
            reset($_path);
            if(current($_path) == 'index.php'){
                  array_shift($_path);
            }
            if(isset(dc('Modulelist')[current($_path)])){
                  $v['m'] = current($_path);
                  array_shift($_path);
            }

            $v['c'] = array_shift($_path);
            $v['a'] = array_shift($_path);

            if(in_array(current($_path),dc('ActionExt'))){
                  $v['e'] = current($_path);
                  array_shift($_path);
            }

            $_params = array();
            if(count($_path) ==1){
                  $v['_param'] =current($_path);
                  array_shift($_path);
            }else{
                  //==============================================
                  //计算params
                  //D($pq_);
                  $_params = [];
                  $count = ceil(count($_path) / 2);
                  for ($i = 0; $i < $count; $i++) {
                        $ii = $i * 2;
                        isset($_path[$ii + 1]) && $_params[$_path[$ii]] = $_path[$ii + 1] ;
                  }
                  //==============================================
            }
            $v['params'] = $_params;            //这个是path后面的参数



            return $v;
      }

      //根据query string分析传递的参数
      public function getquery()
      {
            $query = \Grace\Environment::getInstance()->all()['query'];
            $_p = array();
            $_query = explode('&', $query);
            foreach($_query as $k=>$value){
                  //存在=号
                  $p = explode('=', $value);
                  if(!empty($p[0])){
                        $_p[$p[0]] = isset($p[1])?$p[1]:'';
                  }
            }
            return $_p;       //获得通过querystring 分析出来的参数
      }

      //=======================================

      public function demo()
      {
            /**
             *    获得对get post cookie file session 的支持
             */
      }

}
