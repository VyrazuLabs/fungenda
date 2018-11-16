<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('add-css'); ?>
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-beer" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Events</span>
              <span class="info-box-number"><?php echo e(count($all_events)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Business</span>
              <span class="info-box-number"><?php echo e(count($all_business)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Registered Users</span>
              <span class="info-box-number"><?php echo e(count($all_users)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <div class="col-md-6">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Updated</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box"> 
              	<?php if(count(RecentlyUpdated::recentlyUpdated()) != 0): ?>
	              	<?php $__currentLoopData = RecentlyUpdated::recentlyUpdated(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	              	<?php if($data['event_image']): ?>
	                <li class="item">
	                <?php if(!empty($data['image'][0])): ?> 
	                  	<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1): ?>
	                  	  <div class="product-img">
		                    <img src="<?php echo e(url('/images/event/'.$data['image'][0])); ?>" alt="Product Image">
		                  </div>
	                  	<?php else: ?>	
		                  <div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                  	<?php endif; ?>
	                <?php else: ?>
	                	<div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                <?php endif; ?>
	                  <div class="product-info">
	                    <?php echo e($data['event_title']); ?>

	                      <span class="label label-success pull-right location-eventprsn"><?php echo e($data['event_venue']); ?></span>
	                    <span class="product-description">
	                          <?php echo e($data['event_website']); ?>

	                        </span>
	                  </div>
	                </li>
	                <?php endif; ?>
	                <?php if($data['business_image']): ?>
	                <li class="item">
	                <?php if(!empty($data['image'][0])): ?>  
	                  	<?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1): ?>
	                  	  <div class="product-img">
		                    <img src="<?php echo e(url('/images/business/'.$data['image'][0])); ?>" alt="Product Image">
		                  </div>
	                  	<?php else: ?>	
		                  <div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                  	<?php endif; ?>
	                <?php else: ?>
	                	<div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                <?php endif; ?>
	                  <div class="product-info">
	                    <?php echo e($data['business_title']); ?>

	                      <span class="label label-success pull-right location-eventprsn"><?php echo e($data['business_venue']); ?></span>
	                    <span class="product-description">
	                          <?php echo e($data['business_website']); ?>

	                        </span>
	                  </div>
	                </li>
	                <?php endif; ?>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Viewed</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box"> 
              	<?php if(count(RecentlyViewed::recentlyViewed()) != 0): ?>
	              	<?php $__currentLoopData = RecentlyViewed::recentlyViewed(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	              	<?php if($data['type'] == 2): ?>
	                <li class="item">
	                <?php if(!empty($data['image'][0])): ?> 
	                  	<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1): ?>
	                  	  <div class="product-img">
		                    <img src="<?php echo e(url('/images/event/'.$data['image'][0])); ?>" alt="Product Image">
		                  </div>
	                  	<?php else: ?>	
		                  <div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                  	<?php endif; ?>
	                <?php else: ?>
	                	<div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                <?php endif; ?>
	                  <div class="product-info">
	                    <?php echo e($data['name']); ?>

	                      <span class="label label-success pull-right location-eventprsn"><?php echo e($data['location']); ?></span>
	                    <span class="product-description">
	                          <?php echo e($data['website']); ?>

	                        </span>
	                  </div>
	                </li>
	                <?php endif; ?>
	                <?php if($data['type'] == 1): ?>
	                <li class="item"> 
	                <?php if(!empty($data['image'][0])): ?>
	                  	<?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1): ?>
	                  	  <div class="product-img">
		                    <img src="<?php echo e(url('/images/business/'.$data['image'][0])); ?>" alt="Product Image">
		                  </div>
	                  	<?php else: ?>	
		                  <div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                  	<?php endif; ?>
	                <?php else: ?>
	                	<div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                <?php endif; ?>
	                  <div class="product-info">
	                    <?php echo e($data['name']); ?>

	                      <span class="label label-success pull-right location-eventprsn"><?php echo e($data['location']); ?></span>
	                    <span class="product-description">
	                          <?php echo e($data['website']); ?>

	                        </span>
	                  </div>
	                </li>
	                <?php endif; ?>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Most Favorite</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box"> 
              	<?php if(count(MostFavorite::mostFavorite()) != 0): ?>
	              	<?php $__currentLoopData = MostFavorite::mostFavorite(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	              	<?php if($data['event_image']): ?>
	                <li class="item">
	                <?php if(!empty($data['image'][0])): ?> 
	                  	<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1): ?>
	                  	  <div class="product-img">
		                    <img src="<?php echo e(url('/images/event/'.$data['image'][0])); ?>" alt="Product Image">
		                  </div>
	                  	<?php else: ?>	
		                  <div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                  	<?php endif; ?>
	                <?php else: ?>
	                	<div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                <?php endif; ?>
	                  <div class="product-info">
	                    <?php echo e($data['event_title']); ?>

	                      <span class="label label-success pull-right location-eventprsn"><?php echo e($data['event_venue']); ?></span>
	                    <span class="product-description">
	                          <?php echo e($data['event_website']); ?>

	                        </span>
	                  </div>
	                </li>
	                <?php endif; ?>
	                <?php if($data['business_image']): ?>
	                <li class="item">   
	                <?php if(!empty($data['image'][0])): ?> 

	                  	<?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1): ?>
	                  	  <div class="product-img">
		                    <img src="<?php echo e(url('/images/business/'.$data['image'][0])); ?>" alt="Product Image">
		                  </div>
	                  	<?php else: ?>	
		                  <div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                  	<?php endif; ?>
	                <?php else: ?>
	                	<div class="product-img">
		                    <img src="<?php echo e(url('/images/placeholder.svg')); ?>" alt="Product Image">
		                  </div>
	                <?php endif; ?>
	                  <div class="product-info">
	                    <?php echo e($data['business_title']); ?>

	                      <span class="label label-success pull-right location-eventprsn"><?php echo e($data['business_venue']); ?></span>
	                    <span class="product-description">
	                          <?php echo e($data['business_website']); ?>

	                        </span>
	                  </div>
	                </li>
	                <?php endif; ?>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>

<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>