<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
	  <title>AdminLTE | General UI</title>
	  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	  <!-- bootstrap 3.0.2 -->
	  <link href="http://cdn.bootcss.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	  <!-- font Awesome -->
	  <link href="http://cdn.bootcss.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	  <!-- Theme style -->
	  <link href="/assets/LTE/css/AdminLTE.css" rel="stylesheet" type="text/css" />

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	  <![endif]-->
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->
<?php W('head');?>

<div class="wrapper row-offcanvas row-offcanvas-left">
	  <!-- Left side column. contains the logo and sidebar -->
	<?php W('Ground_left');?>


	  <!-- Right side column. Contains the navbar and content of the page -->
	  <aside class="right-side">
			<!-- Content Header (Page header) -->
			<?php W('right_content_head',[]);?>

			<!--#include virtual = "/box/Usergroupadd" -->

			<!-- Main content -->
			<section class="content">
				  <!-- h2 class="page-header">Alerts and Callouts</h2 -->

				  <!-- END ALERTS AND CALLOUTS -->

				  <div class="row">


						<div class="col-xs-12">
							  <div class="box box-primary">
									<div class="box-header">
										  <h3 class="box-title">RULE管理</h3>
										  <div class="box-tools">
												<div class="input-group pull-right">
													  <input rel="set_get_list" type="checkbox" <?php if($_COOKIE['set_get_list']){ ?>checked<?php }?>> 去除无效
												</div>
										  </div>
									</div><!-- /.box-header -->
									<div class="box-body table-responsive no-padding">
										  <form action=""  method="post">
										  <table class="table table-hover">
												<tr>
													  <th width="60">排序</th>
													  <th width="250">key</th>
													  <th width="400">object</th>

													  <th>DES</th>
													  <th width="200">操作</th>
												</tr>
                                                <?php foreach($res as $key =>$value) {?>
												<tr>
													  <td><input name="s[<?php echo $value['id'];?>]" type="text" id="textfield" size="5" maxlength="5" value="<?php echo $value['sort'];?>"></td>
													  <td><?=$value['key']?></td>

													  <td><?=$value['value'];?></td>

													  <td><?=$value['des'];?></td>
													  <td>
															<?php	if($value['active']) {
																  ?>

																  <a relid=<?php echo $value['id'];?> class="btn btn-primary btn-sm changestate" data-target="#compose-modal" data-toggle="modal">有效</a>

																  <?php
															}else {
																  //else
																  ?>
																  <a relid=<?php echo $value['id'];?> class="btn btn-warning btn-sm changestate" data-target="#compose-modal" data-toggle="modal">无效</a>
																  <?php
															}
															//else
															?>

															<a relid=<?php echo $value['id'];?> class="btn btn-primary btn-sm shamedit">编辑</a>
															<a relid=<?php echo $value['id'];?> class="btn btn-primary btn-sm shamdelete">删除</a>
													  </td>
												</tr>
                                                <?php } ?>
												
												<tr>
													  <td>
												      <input type="submit" name="button" id="button" value="排序"  class="btn btn-primary shamtest submit"></td>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>

													<td>&nbsp;</td><td>&nbsp;</td>
												</tr>
										  </table>
										  </form>
									</div><!-- /.box-body -->


							  </div><!-- /.box -->
						</div>
				  </div>

				  <!-- END TYPOGRAPHY -->
			</section><!-- /.content -->

			<!-- 页脚 -->
			<!--#include virtual = "../sp/right_content_footer.shtml" -->
	  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->


<!-- jQuery 2.0.2 -->
<script src="http://cdn.bootcss.com/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="http://cdn.bootcss.com/bootstrap/3.0.3/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="/assets/LTE/js/AdminLTE/app.js" type="text/javascript"></script>

<script type="text/javascript">
	  $(document).ready(function(){

			//调用
			$('.shamedit').click(function(){
				  var relid = $(this).attr("relid");
				  showAjaxModal('/admin/set/middleware/box/'+relid,'编辑Middleware')
			});

			$('.shamdelete').click(function(){
				  if (confirm("确认要删除？")) {
						var relid = $(this).attr("relid");
						var res = $.ajax({
							  url : '/admin/set/middleware/de/'+relid,
							  type: 'get',
							  data: {},
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
							  //location.href = "/admin/main/index/";
							  location.reload();
							  return true;
						}
				  }
			});




			$('.changestate').click(function(){

				  var relid = $(this).attr("relid");

				  var res = $.ajax({
						url : '/admin/set/middleware/ed/'+relid,
						type: 'get',
						data: {},
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
						//location.href = "/admin/main/index/";
						location.reload();
						return true;
				  }
			});




			$("input[type='checkbox'], input[type='radio']").on('ifClicked', function(event){
				  var rel = event.currentTarget.attributes.rel.nodeValue;
				  setc(rel);
				  location.reload();
			});


	  })
</script>

</body>
</html>