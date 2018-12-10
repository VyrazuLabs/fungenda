<?php $__env->startSection('title', 'Show Profile'); ?>

<?php $__env->startSection('add-css'); ?>
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/AdminLTE.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Profile
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
        <?php if(!empty($user_details['user_image'])): ?>
        
          <img class="profile-user-img profile-pic-admin img-responsive img-circle" src="<?php echo e(url('/images/user'.'/'.$user_details['user_image'])); ?>" alt="User profile picture">
        <?php else: ?>
          <img src="<?php echo e(url('/images/user/personicon.png')); ?>" class="profile-user-img profile-pic-admin img-responsive img-circle" alt="User profile picture">
        <?php endif; ?>
          <h3 class="profile-username text-center"><?php echo e($user_details['first_name']); ?> <?php echo e($user_details['last_name']); ?></h3>

          <a href="<?php echo e(route('edit_profile_page',['id'=>$user_details['user_id']])); ?>" class="btn btn-primary btn-block"><b>EDIT</b></a>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
    	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong>Email</strong>

          <p class="text-muted">
            <?php echo e($user_details['email']); ?>

          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

          <?php if(!empty($user_details['address'])): ?>
            <p class="text-muted"><?php echo e($user_details['address']); ?></p>
          <?php else: ?>
            <p class="text-muted">Address not updated yet</p>
          <?php endif; ?>
          <hr>

          <strong><i class="fa fa-pencil margin-r-5"></i> Phone number</strong>

            <?php if(!empty($user_details['phone_number'])): ?>
              <p class="text-muted"><?php echo e($user_details['phone_number']); ?></p>
            <?php else: ?>
              <p class="text-muted">Phone number not updated yet</p>
            <?php endif; ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
    <!-- /.col -->
  <!-- /.row -->
</section>

<?php $__env->stopSection(); ?>

<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>