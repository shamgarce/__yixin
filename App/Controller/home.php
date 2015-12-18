<?php

namespace Controller;

use Sham\View\View;

class home extends BaseController {

    public function __construct(){
        parent::__construct();
    }
    //根据情况进行跳转
    public function doIndex(){
        echo json_encode([
            'code'  => 401,
            'msg'   => 'index page'
        ]);
    }

}
