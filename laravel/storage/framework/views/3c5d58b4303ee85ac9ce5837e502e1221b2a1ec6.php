<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilediv">
			<p class="text-center profile">Account Settings</p>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard accountcard">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountpicform">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountsettingdiv">
					 	<div class="text-center accountformform">
						 	<?php echo Form::open(['url' => '/save-account-settings', 'method' => 'post']); ?>

				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<?php echo e(Form::label('oldpassword','Current Password')); ?>

				      				<?php echo e(Form::password('oldpassword',['id'=>'oldpass', 'class'=>'form-control profileinput','placeholder'=>'Enter Current Password'])); ?>

				      				<?php if($errors->has('oldpassword')): ?>
	                                    <span class="help-block">
	                                        <span class="signup-error"><?php echo e($errors->first('oldpassword')); ?></span>
	                                    </span>
                                	<?php endif; ?>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<?php echo e(Form::label('newpassword','New Password')); ?>

				      				<?php echo e(Form::password('newpassword',['id'=>'newpass', 'class'=>'form-control profileinput','placeholder'=>'Enter New Password'])); ?>

				      				<?php if($errors->has('newpassword')): ?>
	                                    <span class="help-block">
	                                        <span class="signup-error"><?php echo e($errors->first('newpassword')); ?></span>
	                                    </span>
                                	<?php endif; ?>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<?php echo e(Form::label('confirmpassword','Confirm New Password')); ?>

				      				<?php echo e(Form::password('confirmpassword',['id'=>'passwordconfirm', 'class'=>'form-control profileinput','placeholder'=>'Confirm Your Password'])); ?>

				      				<?php if($errors->has('confirmpassword')): ?>
	                                    <span class="help-block">
	                                        <span class="signup-error"><?php echo e($errors->first('confirmpassword')); ?></span>
	                                    </span>
                                	<?php endif; ?>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group profilegroup accountgroup accountsettingbtndiv savealldiv">
				    				<button type="submit" class="btn btn-secondary changepswbtn accntsavebtn">Save</button>
				    			</div>	
							<?php echo e(Form::close()); ?>


							<?php echo Form::open(['url' => '/save-account-settings-mail', 'method' => 'post']); ?>

							<?php if(isset($email_notification)): ?>
								<?php echo e(Form::model($email_notification)); ?>

							<?php endif; ?>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup switchnotification">
				    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountnotification">
				    					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 emailnotification">

				      					<?php echo e(Form::label('emailnotifications','Email Notifications:')); ?>

				      					</div>
				      					<div class="col-md-6 col-xs-6 toggleswitch">
				      						<label class="switch">
				      						<?php if(isset($email_notification)): ?>
				      							<?php echo e(Form::checkbox('notification_enabled',1,null,['class'=>'togglecheck togglecheckbox'])); ?>

				      						<?php else: ?>
												<?php echo e(Form::checkbox('notification_enabled',1,null,['class'=>'togglecheck togglecheckbox','checked'])); ?>

											<?php endif; ?>
												<div class="slider round"></div>
											</label>
				      					</div>
				      				</div>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountradiobtn">
				      					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
											<label class="custom-control custom-radio">

								  				<?php echo e(Form::radio('notification_frequency', 1, true, ['class' => 'custom-control-input','id'=>'radio1'])); ?>


								  				<span class="custom-control-indicator"></span>
								  				<span class="custom-control-description">Daily</span>
											</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
											<label class="custom-control custom-radio event-btn">

								  				<?php echo e(Form::radio('notification_frequency', 2, false, ['class' => 'custom-control-input','id'=>'radio2'])); ?>


								  				<span class="custom-control-indicator"></span>
								 				<span class="custom-control-description">Weekly</span>
											</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
											<label class="custom-control custom-radio event-btn">
								  				<?php echo e(Form::radio('notification_frequency', 3, false, ['class' => 'custom-control-input','id'=>'radio3'])); ?>


								  				<span class="custom-control-indicator"></span>
								 				<span class="custom-control-description">Monthly</span>
											</label>
										</div>
									</div>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group profilegroup accountgroup accountsettingbtndiv savealldiv">
				    				<button type="submit" class="btn btn-secondary changepswbtn accntsavebtn">Save</button>
				    			</div>
				    		<?php echo e(Form::close()); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">
	$(document).ready(function() {
     $('.accntcancelbtn').hide();
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.personicon').attr('src', e.target.result);
                $('.accntbrwsebtn').hide();
                $('.accntcancelbtn').show();
            }
    		reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".brwsefile").on('change', function(){
        readURL(this);
    });
    
    $(".accntbrwsebtn").on('click', function() {
       $(".brwsefile").click();
    });
});

	$(".accntcancelbtn").click(function(){
		 $('.personicon').attr('src', "images/personicon.png");
            $('.accntcancelbtn').hide();
            $('.accntbrwsebtn').show();
		  
		});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>