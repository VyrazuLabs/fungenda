<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container text-center">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">
              <p class="profile text-left">Change Password</p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
      <div class="profilecard">
        <div class="text-center profileform">
                <?php echo Form::open(['url' => '/password/changing/', 'method' => 'post', 'files'=>'true']); ?>

                <?php echo e(Form::hidden('email_id',Crypt::encrypt($decripted_email),[])); ?>


              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                <?php echo e(Form::label('password','New Password')); ?>

                <?php echo e(Form::password('password',['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter new password'])); ?>

                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('password')); ?></span>
                                    </span>
                                <?php endif; ?>
              </div>

              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                <?php echo e(Form::label('confirm_password','Confirm Password')); ?>

                <?php echo e(Form::password('confirm_password',['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Confirm your password'])); ?>

                <?php if($errors->has('confirm_password')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('confirm_password')); ?></span>
                                    </span>
                                <?php endif; ?>
              </div>

              <div class="text-center profilesavebtn">
                <?php echo e(Form::submit('Change Password',['class'=>'btn btn-secondary profilebrowsebtn saveprofile'])); ?>

              </div>
            <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('add-js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>