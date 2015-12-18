<?php

namespace Sham\Ground;

use Sham\Set\Base;

class Ground
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
      public function middleware($key,$v)
      {
            $mcae = sapp('SQLite')->getall('select * from middleware');
            $ms = array();
            foreach($mcae as $value){
                  $ms[$value['key']][$value['value']] = 1;
            }
            if(!$ms[$key][$v]){
                  sapp('SQLite')->insert('middleware',[
                      'key'         => $key,
                      'value'       => $v,
                  ]);
            }
      }

      public function widget($name)
      {

            $widget = sapp('SQLite')->getall('select * from widget');
            $ms = array();
            foreach($widget as $value){
                  $ms[$value['name']] = 1;
            }

            if(!$ms[$name]){
                  sapp('SQLite')->insert('widget',[
                      'name'  => $name
                  ]);
            }
      }

      public function geter($key)
      {
            $mc = explode('.',$key);
            $controller = ucfirst(strtolower($mc[0]?:'N')); //首字母大写
            $action     = $mc[1]?:'index';
            $params     = isset($mc[2])?$mc[2]:'N';

            $geter = sapp('SQLite')->getall('select * from geter');
            $ms = array();
            foreach($geter as $value){
                  $ms[$value['controller']][$value['action']][$value['params']] = 1;
            }

            if(!$ms[$controller][$action][$params]){
                  sapp('SQLite')->insert('geter',[
                      'controller'  => $controller,
                      'action'      => $action,
                      'params'      => $params
                  ]);
            }

      }

      public function page()
      {
            $page       = bus('page');
            $pageex     = bus('pageex');
            $res = sapp('SQLite')->getall('select * from page');
            $ms = array();
            foreach($res as $value){
                  $ms[$value['page']][$value['pageex']] = 1;
            }

            if(!$ms[$page][$pageex]){
                  sapp('SQLite')->insert('page',[
                      'page'      => $page,
                      'pageex'  => $pageex,
                  ]);
            }
      }

      public function mcae(){
            //添加数据进入mcae数据库
            /*
             * moudle
             * controller
             * action
             * actionext
             * mothed
             */
            $moudle     = bus('router')['m']?:'N';
            $controller = bus('router')['c']?:'N';
            $action     = bus('router')['a']?:'N';
            $actionext  = bus('router')['e']?:'N';
            $mothed     = bus('router')['type']?:'N';

            $mcae = sapp('SQLite')->getall('select * from mcae');
            $ms = array();
            foreach($mcae as $value){
                  $ms[$value['module']][$value['controller']][$value['action']][$value['actionext']][$value['mothed']] = 1;
            }
            if(!$ms[$moudle][$controller][$action][$actionext][$mothed]){
                  sapp('SQLite')->insert('mcae',[
                      'module'      => $moudle,
                      'controller'  => $controller,
                      'action'      => $action,
                      'actionext'   => $actionext,
                      'mothed'      => $mothed,
                  ]);
            }

            //|--------------------------------------------------------
            //提炼出 page_menu
            $mc         = "{$moudle}.{$controller}";
            $mca        = "{$moudle}.{$controller}.{$action}";

            $mcaemenu = sapp('SQLite')->getall('select * from menu');
            $ms = array();
            foreach($mcaemenu as $value){
                  $ms[$value['mc']][$value['mca']] = 1;
            }
            if(!$ms[$mc][$mca]){
                  sapp('SQLite')->insert('menu',[
                      'mc'        => $mc,
                      'mca'       => $mca,
                      'icon'      => 'fa fa-th'
                  ]);
            }



            //|--------------------------------------------------------
      }

}
