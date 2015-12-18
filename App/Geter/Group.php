<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/1 0001
 * Time: 19:47
 */

namespace App\Geter;


class Group
{
      /*
      |--------------------------------------------------
      | 数据接口列表
      |--------------------------------------------------
      | user.all        //用户组列表
      | user.id.num     //根据id
      | user.chr.chr  //根据chr
      |
      */

      private $res = array(); //数据结果集

      public function KeyGroupidActiveTrue()
      {
            $sql = "    select * from user_group
                        where active = 1
                        order by sort desc,groupId desc";
            $this->res = sapp('db')->getall($sql,'groupId');
            return $this->res;
      }
            //返回所有的用户
      public function all($active = 1)
      {
            $active = intval($active);
            $sql = "    select * from user_group
                        where active = $active
                        order by sort desc,groupId desc";
            $this->res = sapp('db')->getall($sql);
            return $this->res;
      }

      //根据id返回用户
      public function id($groupid = 0)
      {
            $sql = "select * from user_group WHERE groupId = $groupid";
            return sapp('db')->getrow($sql);
      }

      //根据login返回用户
      public function chr($groupchr = '')
      {
            $sql = "select * from user_group WHERE groupchr = $groupchr";
            return sapp('db')->getrow($sql);
      }



}
