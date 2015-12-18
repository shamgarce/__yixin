<?php

namespace Controller;

/**
 * ?  “访客”
 * @  “已授权“
 */


class home extends BaseController {

      //------------------------------------------------------
      //行为
      public function doIndex_delete($param){}
      public function doIndex_states($param){}
      public function doIndex_boxPost($param){}
      public function doIndex_box($param){}
      public function doIndex_dialogPost($param){}
      public function doIndex_dialog($param){}
      public function doIndex_ed($param){}
      public function doIndex_ext($param){}
//      public function doIndex($param){}
      //------------------------------------------------------

      public function doIndex($param){
            //echo 主界面
            view();
      }

}




