<div class="col-xs-12">

      <div class="box box-danger collapsed-box">
            <div class="box-header">
                  <h3 class="box-title"><a class="btn btn-default" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">添加用户</a>
                  </h3>
                  <div class="box-tools pull-right">
                        <button class="btn btn-default btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                              <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-default btn-sm" title="" data-toggle="tooltip" data-widget="remove" data-original-title="Remove">
                              <i class="fa fa-times"></i>
                        </button>
                  </div>
            </div>
            <div class="box-body" style="display: none;">
                  <form class="form-horizontal">
                  <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">登录名</label>
                        <div class="col-sm-4">
                              <input type="email" class="form-control boxlogin" id="inputEmail3" placeholder="登录名">
                        </div>
                  </div>
                  <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">密码</label>
                        <div class="col-sm-4">
                              <input type="email" class="form-control boxpassword" id="inputEmail3" placeholder="密码">
                        </div>
                  </div>
                        <div class="form-group">
                              <label for="inputEmail3" class="col-sm-1 control-label">部门</label>
                              <div class="col-sm-4">
                                    <select class="form-control boxgroup">
                                          <?php
                                          foreach($group as $key=>$value){
                                          ?>
                                          <option value="<?=$value['groupId']?>"><?=$value['groupname']?></option>
                                          <?php
                                          }
                                          ?>
                                    </select>

                              </div>
                        </div>
                        <div class="form-group">
                              <label for="inputEmail3" class="col-sm-1 control-label">描述</label>
                              <div class="col-sm-4">
                                    <input type="email" class="form-control boxdes" id="inputEmail3" placeholder="描述">
                              </div>
                              <div class="col-sm-1 ">选填</div>
                        </div>
                        <div class="form-group">
                              <div class="col-xs-6">
                                    <a class="btn btn-primary boxaddnew">添加</a>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
</div>


<script language="JavaScript" type="text/javascript">
      $(document).ready(function(){
            $('.boxaddnew').click(function(){
                  var res = $.ajax({
                        url : '/admin/user/index/box/',
                        type: 'post',
                        data: {
                              'login'        : $('.boxlogin').val(),
                              'password'     : $('.boxpassword').val(),
                              'group'        : $('.boxgroup').val(),
                              'des'          : $('.boxdes').val(),
                        },
                        dataType: "json",
                        async:false,
                        cache:false
                  }).responseJSON;
                  //console.log(res);
                  //==========================

                  if(res.code<0){
                        alert(res.msg);
                        return false;
                  }else{
                        location.reload();
                        return true;
                  }
            });
      })
</script>
