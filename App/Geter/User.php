<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/1 0001
 * Time: 19:47
 */

namespace App\Geter;


class User
{
      /*
      |--------------------------------------------------
      | 数据接口列表
      |--------------------------------------------------
      | user.cookies    //本地存储的login
      | user.info       //用户的信息
      | user.group      //用户的用户组信息
      | user.rulelib
      | user.all        //用户列表
      | user.id.num     //根据id
      | user.login.chr  //根据login
      |
      */

      /*
      |--------------------------------------------------
      | 用户数据库中的信息
      |--------------------------------------------------
      |
      */
      public function info()
      {
            $res = array();
            $userlogin = $this->cookies();            //

            //test
            $userlogin = 'irones';




            if($userlogin){
                  $userlogin = addslashes($userlogin);
                  //根据用户名查询出用户信息 -> to bus
                  $sql =     "SELECT * FROM `user`, user_profile
                              WHERE `user`.userid = user_profile.userid
                              AND `user`.userid =(
                                select userid from `user`
                                where login = '$userlogin'
                              )";
                  $res = sapp('db')->getrow($sql);
            }


            $res['pic'] = '/assets/LTE/img/avatar3.png';

            return $res;
      }

      /*
      |--------------------------------------------------
      | 用户组的信息
      |--------------------------------------------------
      |
      */
      public function group()
      {
            //返回用户组信息
            $groupid = bus('user')['groupId']?:$this->info()['groupId'];
            $res = array();
            if($groupid){
                  $groupid = intval($groupid);
                  $sql = "select * from user_group where groupid = $groupid";
                  $res = sapp('db')->getrow($sql);
            }
            return $res;
      }


      //用户组的RBAC信息 -> 数据库中的rulelib
      public function rulelib()
      {
            $res = bus('usergroup')['ruleLib']?:$this->group()['ruleLib']?:array();
            return $res;
      }
      /*
      |----------------------------------------------------
      | 获取本地存储的用户信息
      |----------------------------------------------------
      | 首先验证本地存储的cookies 是否有效 通过hash 进行运算判断
      | 先获取cookie记录的username 根据username 查询数据库得到
      |
      */
      public function cookies()
      {
            $userlogin  = sapp('Cookies')->get('userlogin');
            $logintime  = sapp('Cookies')->get('logintime');
            $sccheck    = sapp('Cookies')->get('sccheck');
            if(shamhash($userlogin,$logintime) == $sccheck){
                  //验证通过 返回数据
                  $res = $userlogin;
            }else{
                  $res = null;
            }
            return $res;
      }


      //返回所有的用户
      public function all()
      {
            $sql =     "SELECT * FROM `user`, user_profile
                              WHERE `user`.userid = user_profile.userid
                              order by sort desc
                              ";
            $res = sapp('db')->getall($sql);
            return $res;
      }

      //根据id返回用户
      public function id($userid = 0)
      {
            $sql =     "SELECT * FROM `user`, user_profile
                              WHERE `user`.userid = user_profile.userid
                              and `user`.userid = $userid
                              ";
            $res = sapp('db')->getrow($sql);
            return $res;
      }

      //根据login返回用户
      public function login($userlogin = '')
      {
            $sql =     "SELECT * FROM `user`, user_profile
                              WHERE `user`.userid = user_profile.userid
                              and `user`.login = $userlogin
                              ";
            $res = sapp('db')->getrow($sql);
            return $res;
      }



}

/*
mixed xcache_get(string name)
bool xcache_set(string name, mixed value [, int ttl])
bool xcache_isset(string name)
bool xcache_unset(string name)
bool xcache_unset_by_prefix(string prefix)
    //低版本没有这个函数，使用之前要测试一下

int xcache_inc(string name [, int value [, int ttl]])
   //自增函数，value为步长，如果没有初始化，则默认为零，ttl为过期时间

int xcache_dec(string name [, int value [, int ttl]])
   //自减函数，同上


    注意：xcache不能存放对象、资源等内容。

2、管理函数：
int xcache_count(int type)



array xcache_list(int type, int id)



void xcache_clear_cache(int type, int id)
string xcache_coredump(int op_type)



*/