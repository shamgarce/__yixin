<?php

/**
 * 用户模型
 * 添加 ->signup($res)
 * 登陆 ->signin($res)
 * 登出 ->signout($res)
 *
 */

class Logc extends Model
{

    public $res = array();
    private $sign = array();
    private $log = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function L($code=0,$msg='ini')
    {
        $this->log['code'] = $code;        //code
        $this->log['msg'] = $msg;        //code
        $this->systeminfo();
        $this->signer();
        $this->save();
        return true;
    }

    public function save()
    {
        $this->log['time']      = serialize($this->log['time']);
        $this->log['_GET']      = serialize($this->log['_GET']);
        $this->log['_POST']     = serialize($this->log['_POST']);
        $this->log['_FILE']     = serialize($this->log['_FILE']);
        $this->log['router']    = serialize($this->log['router']);
        $this->log['sign']      = serialize($this->log['sign']);
        $this->S->table->g_log->insert($this->log);
	}

    public function signer()
    {
        $this->sign['salt'] 		= SALT;				//
        $this->sign['timestamp']    = $this->S->request->get['timestamp'];
        $this->sign['deviceid']     = $this->S->request->get['deviceid'];
//        $this->sign['openid']       = $this->Seter->request->get['openid'];
        $this->sign['signature']    = $this->S->request->get['signature'];
        $this->sign['user']         = $this->S->request->get['user'];

        $this->sign['sign'] 		= false;

//        print_r($_SERVER);
        $opendid = md5($this->sign['user'].$this->sign['deviceid']);
        $signature = md5($opendid . $this->sign['timestamp'] . SALT);
        if($signature == $this->sign['signature'])$this->sign['sign'] 		= true;
        $this->log['sign'] = $this->sign;
        return true;
    }

    public function systeminfo()
    {
//D(C('Router'));

        $this->log['controller']= C('Router')['method_controller'];
        $this->log['action']    = C('Router')['method_action'];
        $this->log['time']['timebe'] = BTIME;        //log
        $this->log['time']['timecu'] = time();        //log
        $this->log['_GET']      = $this->S->request->get;            //log
        $this->log['_POST']     = $this->S->request->post;        //log
        $this->log['_FILE']    = $_FILES;
        $this->log['router']    = C('router');              //获得路由信息
        return true;
    }

}


