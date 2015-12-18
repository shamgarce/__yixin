<?php

namespace App\Widget;

use Sham\Widget\Widget;

class Head_messageWidget extends Widget {

    public function invoke($data){

        $this->assign('key','key');

        $this->display('',$data);

    }

}
