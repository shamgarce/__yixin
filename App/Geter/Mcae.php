<?php

namespace App\Geter;


class Mcae
{

      public function path()
      {
            $info = $this->self();
            if($info['p']){
                  $path[] = $info['p'];
            }
            $path[] = $info;
            return $path;
      }

      public function self()
      {
            $moudle     = bus('router')['m']?:'N';
            $controller = bus('router')['c']?:'N';
            $action     = bus('router')['a']?:'N';
            $actionext  = bus('router')['e']?:'N';
            $mothed     = bus('router')['type']?:'N';
            $sql = "select * from mcae where
                  module = '$moudle'
                  and controller = '$controller'
                  and action = '$action'
                  and actionext = '$actionext'
                  and mothed = '$mothed'
                  and active = 1";
            $res = sapp('SQLite')->getrow($sql);

            $res['belong'] = 1;
            if($res['belong']){
                  $res['p'] = sapp('SQLite')->getrow("select * from mcae where id = {$res['belong']}");
            }
            $res['p']['name']      = "home";
            $res['name']      = "名称";
            $res['des']       = "说明 $moudle / $controller / $action / $actionext / $mothed";
            return $res;
      }




}
