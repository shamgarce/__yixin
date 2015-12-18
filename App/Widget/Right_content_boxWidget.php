<?php

namespace App\Widget;

use Sham\Widget\Widget;

class Right_content_boxWidget extends Widget {

      public function invoke($data){
            $this->assign('key','key');
            $this->display('',$data);
      }

}
