<!--start most favourite-->
<div class="col-md-3 rightsidediv">
	<?php if(count(MostFavorite::mostFavorite()) != 0): ?>
		<div class="customdetailright">
			<p class="right-heading">Most Favorite:</p>
			<hr class="rightdevide">
			<?php $__currentLoopData = MostFavorite::mostFavorite(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($data['business_id']): ?>
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
					<a href="<?php echo e(route('frontend_more_business',['q'=>$data['business_id']])); ?>">
						<?php if(!empty($data['business_discount'])): ?>
						<div class="ribbon-wrapper-green sidebar-ribbon">
							<div class="img-discount-badge sidebar-img-discount-badge">
								Discounts
							</div>
						</div>
						<?php endif; ?>
						<?php if(!empty($data['image'][0])): ?>
							<?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1): ?>

								<img src="<?php echo e(url('/images/business/'.$data['image'][0])); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
							<?php else: ?>
								<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
							<?php endif; ?>
						<?php else: ?>
							<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
						<?php endif; ?>
					</a>
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="<?php echo e(route('frontend_more_business',['q'=>$data['business_id']])); ?>"><?php echo e($data['business_title']); ?></a></p>

					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <?php echo e($key); ?> <?php echo e($key>1 ? 'FAVORITES' : 'FAVORITE'); ?>

						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			<?php endif; ?>
			<?php if($data['event_id']): ?>
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">

					<a href="<?php echo e(route('frontend_more_event',['q'=>$data['event_id']])); ?>">
						<?php if(!empty($data['event_discount'])): ?>
						<div class="ribbon-wrapper-green sidebar-ribbon">
							<div class="img-discount-badge sidebar-img-discount-badge">
								Discounts
							</div>
						</div>
						<?php endif; ?>
						<?php if(!empty($data['image'][0])): ?>
							<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1): ?>

								<img src="<?php echo e(url('/images/event/'.$data['image'][0])); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
							<?php else: ?>
								<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
							<?php endif; ?>
						<?php else: ?>
							<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
						<?php endif; ?>
					</a>

				
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="<?php echo e(route('frontend_more_event',['q'=>$data['event_id']])); ?>"><?php echo e($data['event_title']); ?></a></p>

					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <?php echo e($key); ?> <?php echo e($key>1 ? 'FAVORITES' : 'FAVORITE'); ?>

						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php endif; ?>
	<!--end most favourite-->
	<!--start recent viewed-->
	
	<!--end recent viewed-->
	<!--start recent update-->
	<?php if(count(RecentlyUpdated::recentlyUpdated()) != 0): ?>
		<div class="customdetailrightsecond">
			<p class="right-heading">Recently Updated:</p>
			<hr class="rightdevide">
			<?php $__currentLoopData = RecentlyUpdated::recentlyUpdated(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(isset($data['event_id'])): ?>
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
					<a href="<?php echo e(route('frontend_more_event',['q'=>$data['event_id']])); ?>">
					<?php if(!empty($data['event_discount'])): ?>
					<div class="ribbon-wrapper-green sidebar-ribbon">
						<div class="img-discount-badge sidebar-img-discount-badge">
							Discounts
						</div>
					</div>
					<?php endif; ?>
					<?php if(!empty($data['image'][0])): ?>
						<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1): ?>

							<img src="<?php echo e(url('/images/event/'.$data['image'][0])); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91"></a>
						<?php else: ?>
							<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
						<?php endif; ?>
					<?php else: ?>
						<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
					<?php endif; ?>
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="<?php echo e(route('frontend_more_event',['q'=>$data['event_id']])); ?>"><?php echo e($data['event_title']); ?></a></p>
					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <?php echo e($data['fav_count']); ?> <?php echo e($data['fav_count']>1 ? 'FAVORITES' : 'FAVORITE'); ?>

						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			<?php endif; ?>
			<?php if(isset($data['business_id'])): ?>
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
					<a href="<?php echo e(route('frontend_more_business',['q'=>$data['business_id']])); ?>">
					<?php if(!empty($data['business_discount'])): ?>
					<div class="ribbon-wrapper-green sidebar-ribbon">
						<div class="img-discount-badge sidebar-img-discount-badge">
							Discounts
						</div>
					</div>
					<?php endif; ?>
					<?php if(!empty($data['image'][0])): ?>
						<?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1): ?>

							<img src="<?php echo e(url('/images/business/'.$data['image'][0])); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91"></a>
						<?php else: ?>
							<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
						<?php endif; ?>
					<?php else: ?>
						<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive image_modified sidebar-image" height="96" width="91">
					<?php endif; ?>
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="<?php echo e(route('frontend_more_business',['q'=>$data['business_id']])); ?>"><?php echo e($data['business_title']); ?></a></p>
					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <?php echo e($data['fav_count']); ?> <?php echo e($data['fav_count']>1 ? 'FAVORITES' : 'FAVORITE'); ?>

						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php endif; ?>

</div>
<!--end recent updated -->
