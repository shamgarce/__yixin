<?php

namespace App\Widget;

use Sham\Widget\Widget;

class Head_useraccountWidget extends Widget {

    public function invoke($data){

        $this->assign('key','key');

        $this->display('',$data);

    }

}
