<?php $__env->startSection('title', 'Edit Profile'); ?>
<?php $__env->startSection('add-meta'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('add-css'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
      <!-- general form elements -->
    <div class="row">
  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="box box-primary">
		          	<div class="box-header with-border">
					  <h3>
					   Edit Profile
					  </h3>
					</div>
					<div class="text-left createform">
							<div class="text-center">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profileimgdiv">
									<div class="profilecard">
										<div class="picbtn">
										<?php echo Form::open(['url' => '/admin/profile/update', 'method' => 'post', 'files'=>'true']); ?>


									 	<?php echo e(Form::model($user,[])); ?>


									 	<?php echo e(Form::hidden('user_id',null,[])); ?>


											<div class="profileimgdiv">
											<?php if(isset($user['file'])): ?>
												<img src="<?php echo e(url('images').'/'.'user/'.$user['file']); ?>" class="img-responsive personicon" id="img">
											<?php else: ?>
												<img src="<?php echo e(url('/images/personicon.png')); ?>" class="img-responsive personicon" id="img">
											<?php endif; ?>
									 		</div>
									 		<div class="profilebrowsebtndiv">
									 			<button type="button" class="btn btn-secondary profilebrowsebtn">Browse</button>

									 			<?php echo e(Form::file('file', ['class'=>'brwsefile','accept'=>'image*'])); ?>


									 			<button type="button" class="btn btn-secondary profilecancelbtn">Cancel</button>
									 		</div>
									 	</div>
								 		<div class="text-left profileform">

									 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					<?php echo e(Form::label('first_name','First Name')); ?>

							      					<span class="require-star"></span>

							      					<?php echo e(Form::text('first_name',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your First Name"])); ?>


							      					<?php if($errors->has('first_name')): ?>
					                                    <span class="help-block">
					                                        <strong style="float: left; color: red;"><?php echo e($errors->first('first_name')); ?></strong>
					                                    </span>
					                                <?php endif; ?>

							    				</div>
									 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					<?php echo e(Form::label('last_name','Last Name')); ?>

							      					<span class="require-star"></span>
							      					
							      					<?php echo e(Form::text('last_name',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your Last Name"])); ?>


							      					<?php if($errors->has('last_name')): ?>
					                                    <span class="help-block">
					                                        <strong style="float: left; color: red;"><?php echo e($errors->first('last_name')); ?></strong>
					                                    </span>
					                                <?php endif; ?>

							    				</div>
							    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					<?php echo e(Form::label('email','Email Address')); ?>

							      					<span class="require-star"></span>
							      					
							      					<?php echo e(Form::text('email',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your Email Address", 'readonly'])); ?>


							      					<?php if($errors->has('email')): ?>
					                                    <span class="help-block">
					                                        <strong style="float: left; color: red;"><?php echo e($errors->first('email')); ?></strong>
					                                    </span>
					                                <?php endif; ?>

							    				</div>
							    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					<?php echo e(Form::label('phone_number','Phone Number')); ?>

							      					<span class="require-star"></span>
							      					
							      					<?php echo e(Form::text('phone_number',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Enter Your Phone No."])); ?>


							      					<?php if($errors->has('phone_number')): ?>
					                                    <span class="help-block">
					                                        <strong style="float: left; color: red;"><?php echo e($errors->first('phone_number')); ?></strong>
					                                    </span>
					                                <?php endif; ?>

							    				</div>
							    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					<?php echo e(Form::label('address','Address')); ?>

							      					<span class="require-star"></span>

							      					<?php echo e(Form::textarea('address', null, ['size' => '64x7','placeholder'=>'Enter Address','class'=>'form-control profileinput','id'=>'profileaddress'])); ?>


							      					<?php if($errors->has('address')): ?>
					                                    <span class="help-block">
					                                        <strong style="float: left; color: red;"><?php echo e($errors->first('address')); ?></strong>
					                                    </span>
					                                <?php endif; ?>

							    				</div>
							    				<div class="text-center profilesavebtn">
							    					<?php echo e(Form::submit('Save',['class'=>'btn btn-secondary saveprofile'])); ?>

							    				</div>

							    			<?php echo Form::close(); ?>

										</div>
									</div>
								</div>
							
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">
	$(document).ready(function() {
     $('.profilecancelbtn').hide();
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.personicon').attr('src', e.target.result);
                $('.profilebrowsebtn').hide();
                $('.profilecancelbtn').show();
            }
    		reader.readAsDataURL(input.files[0]);
        }
    }
    
    var old_image = '';
    $(".brwsefile").on('change', function(){
    	old_image = $('.personicon').attr('src');
        readURL(this);
    });
    
    $(".profilebrowsebtn").on('click', function() {
       $(".brwsefile").click();
    });

    $(".profilecancelbtn").click(function(){
		var image = $('#img').attr('src');
		 $('.personicon').attr('src', old_image);
            $('.profilecancelbtn').hide();
            $('.profilebrowsebtn').show();
            old_image = '';
		});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>