<div class="row">
<div class="col-md-12">
                  <form>
                        <div class="row">
							  <div class="col-md-2">
									ID :
							  </div>
							  <div class="col-md-9">
									<?php echo $res['id']?>
							  </div>
							  <div class="col-md-2">
									ROOT :
							  </div>
							  <div class="col-md-9">
									<?php echo $res['key']?>
							  </div>

                              <div class="col-md-2"> 
                                    value : 
                              </div>
                              <div class="col-md-9">
									<?php echo $res['value']?>
                              </div>
                        </div>
                        
                        
                        <div class="row">
                              <div class="col-md-2"> 
                                    DES : 
                              </div>
                              <div class="col-md-9">
									<textarea class="form-control boxdes" rows="3"><?php echo $res['des'];?></textarea>
									<input type="hidden" class="boxid" value="<?php echo $res['id'];?>">
                              </div>
                        </div>


                  </form>

</div>
</div>

<script type="text/dialog">
	  $(document).ready(function(){
			$('.modal_ok').click(function(){


				  var res = $.ajax({
						url : '/admin/set/middleware/box/',
						type: 'post',
						data: {
							'des' :　$('.boxdes').val(),
							'id' :　$('.boxid').val(),

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