<div class="col-xs-12">

      <div class="box box-danger collapsed-box">
            <div class="box-header">
                  <h3 class="box-title"><a class="btn btn-default" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">添加用户组</a>
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
                        <div class="row">
                              <div class="form-group col-xs-6">
                                    <label for="exampleInputEmail1">用户组名称</label>
                                    <input class="form-control boxgroupname" type="text" placeholder="部门名称">
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group col-xs-6">
                                    <label for="exampleInputPassword1">用户组标识</label>
                                    <input class="form-control boxgroupchr" type="text" placeholder="用户组标识[字符串]">
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group col-xs-6">
                                    <label for="exampleInputPassword1">排序</label>
                                    <input class="form-control boxsort" type="text" placeholder="数字">
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group col-xs-6">
                                    <label for="exampleInputPassword1">描述</label>
                                    <input class="form-control boxdes" type="text" placeholder="说明">
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group col-xs-6">
                                    <div class="checkbox">
                                          <label>
                                                <input type="checkbox" class="boxactive" value="1" checked> active
                                          </label>
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group col-xs-6">
                                    <a class="btn btn-primary boxaddnew">添加</a>
                              </div>
                        </div>
            </div>
      </div>

</div>


<script language="JavaScript" type="text/javascript">
      $(document).ready(function(){
            $('.boxaddnew').click(function(){
                  var res = $.ajax({
                        url : '/admin/user/group/box/',
                        type: 'post',
                        data: {
                              'groupname' : $('.boxgroupname').val(),
                              'groupchr'  : $('.boxgroupchr').val(),
                              'sort'      : $('.boxsort').val(),
                              'active'    : $('input[class="boxactive"]:checked').val(),
                              'des'       : $('.boxdes').val()
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
