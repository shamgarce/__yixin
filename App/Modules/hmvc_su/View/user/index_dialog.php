<div class="row">
<div class="col-md-12">

	<form class="form-horizontal">
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">登录名</label>
			<div class="col-sm-8">
				<?=$res['login']?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">密码</label>
			<div class="col-sm-8">
				<input type="email" class="form-control dialogpassword" id="inputEmail3" placeholder="密码">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">部门</label>
			<div class="col-sm-8">
				<select class="form-control dialoggroup">
					<?php
					foreach($group as $key=>$value){
						?>
						<option value="<?=$value['groupId']?>" <?php if($res['groupId'] == $value['groupId']){?>selected<?php }?>><?=$value['groupname']?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">描述</label>
			<div class="col-sm-8">
				<input type="email" class="form-control dialogdes" id="inputEmail3" placeholder="描述" value="<?=$res['des']?>">
			</div>
			<div class="col-sm-2 ">选填</div>
		</div>
		<input type="hidden" class="dialogid" value="<?php echo $res['userId'];?>">
	</form>





</div>
</div>

<script type="text/dialog">
	  $(document).ready(function(){
			$('.modal_ok').click(function(){


				  var res = $.ajax({
						url : '/admin/user/index/dialog/',
						type: 'post',
						data: {

							'password' 	: $('.dialogpassword').val(),
							'group' 	: $('.dialoggroup').val(),
							'des' 		: $('.dialogdes').val(),
							'userid' 	: $('.dialogid').val(),

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