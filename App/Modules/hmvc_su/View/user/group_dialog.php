<div class="row">
<div class="col-md-12">
                  <form>
                        <div class="row">
							  <div class="col-md-2">
									ID :
							  </div>
							  <div class="col-md-10">
								  <div class="form-group">
									  <?=$res['groupId']?>
								  </div>
							  </div>



							<div class="col-md-2">
								分组名 :
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<input type="email" class="form-control dialoggroupname" id="exampleInputEmail1" value="<?=$res['groupname']?>">
								</div>
							</div>


								<div class="col-md-2">
									标识 :
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<input type="email" class="form-control dialoggroupchr" id="exampleInputEmail1" value="<?=$res['groupchr']?>">
									</div>
								</div>


						</div>
                        
                        
                        <div class="row">
                              <div class="col-md-2"> 
                                    描述 :
                              </div>
							<div class="col-md-10">
								<div class="form-group">
									<input type="email" class="form-control dialogdes" id="exampleInputEmail1" value="<?=$res['des']?>">
									<input type="hidden" class="dialogid" value="<?php echo $res['groupId'];?>">
								</div>
							</div>
                        </div>


                  </form>

</div>
</div>

<script type="text/dialog">
	  $(document).ready(function(){
			$('.modal_ok').click(function(){


				  var res = $.ajax({
						url : '/admin/user/group/dialog/',
						type: 'post',
						data: {
							'groupname' : $('.dialoggroupname').val(),
							'groupchr' 	: $('.dialoggroupchr').val(),
							'des' 		: $('.dialogdes').val(),
							'id' 		: $('.dialogid').val(),

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