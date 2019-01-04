<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 sharedfirstdiv">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0">
				<p class="sharemaintext member-homepage-heading">Member Homepage</p>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharedmaindiv">
	<div class="container">
		<div class="shareddiv">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharepubliclocation">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="col-lg-12 col-xs-12 shareshadowdiv member-homepage-shadow-div">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca member-homepage-subhead">Your Favorites</h2>
							<div class="member-homepage-subhead-line"></div>
							<ul class="cllist member-homepage-favorites-list">
								<li>Businesses, Events and Locations:</li>
								<ul class="clsublist">
									<?php if(count($all_businesses) > 0): ?>
										<?php $__currentLoopData = $all_businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li>
												<a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>"><?php echo e($business[0]['business_title']); ?></a>
												<?php if(Auth::check() && Auth::user()->user_id == $business[0]->created_by): ?>
												<a href="<?php echo e(route('edit_business',$business[0]['business_id'])); ?>">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
												<a href="JavaScript:Void(0)" onclick="deleteFunctionBusiness(this)" data-id = "<?php echo e($business[0]['business_id']); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												<?php endif; ?>
											</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>

									<?php if(count($all_events) > 0): ?>
										<?php $__currentLoopData = $all_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li>
												<a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>"><?php echo e($event[0]['event_title']); ?></a>
												<?php if(Auth::check() && Auth::user()->user_id == $event[0]->created_by): ?>
												<a href="<?php echo e(route('edit_event',$event[0]['event_id'])); ?>">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>

													<a href="JavaScript:Void(0)" onclick="deleteFunction(this)" data-id = "<?php echo e($event[0]['event_id']); ?>">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
												<?php endif; ?>
											</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>

									<?php if(count($all_share_location) > 0): ?>
										<?php $__currentLoopData = $all_share_location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

											<li>
												<a href="<?php echo e(route('frontend_more_shared_location',[$share_location[0]['shared_location_id']])); ?>"><?php echo e($share_location[0]['given_name']); ?></a>
												<?php if(Auth::check() && Auth::user()->user_id == $share_location[0]['user_id']): ?>
												<a href="<?php echo e(route('edit_shared_location',$share_location[0]['shared_location_id'])); ?>">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>

												<a onclick="deleteFunctionSharedLocation(this)" target="#" data-id = "<?php echo e($share_location[0]['shared_location_id']); ?>">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
												<?php endif; ?>
											</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</ul>
							</ul>
						</div>
					</div>
					<div class="col-lg-12 col-xs-12 shareshadowdiv member-homepage-shadow-div">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca member-homepage-subhead">Your Listings</h2>
							<div class="member-homepage-subhead-line"></div>
							<ul class="cllist member-homepage-favorites-list">
								<?php if(count($myCreatedBusiness) > 0): ?>
								<li>Businesses</li>
								<ul class="clsublist">
									<?php $__currentLoopData = $myCreatedBusiness; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<a href="<?php echo e(route('frontend_more_business',['q'=>$business['business_id']])); ?>"><?php echo e($business['business_title']); ?></a>
											<a href="<?php echo e(route('edit_business',$business['business_id'])); ?>">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											 <a href="JavaScript:Void(0)" onclick="deleteFunctionBusiness(this)" data-id = "<?php echo e($business['business_id']); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<?php endif; ?>
								<?php if(count($myCreatedEvents) > 0): ?>
								<li>Events:</li>
								<ul class="clsublist">
									<?php $__currentLoopData = $myCreatedEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<a href="<?php echo e(route('frontend_more_event',['q'=>$event['event_id']])); ?>"><?php echo e($event['event_title']); ?></a>
											<a href="<?php echo e(route('edit_event',$event['event_id'])); ?>">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a href="JavaScript:Void(0)" onclick="deleteFunction(this)" data-id = "<?php echo e($event['event_id']); ?>">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<?php endif; ?>
								<?php if(count($mySharedLocation) > 0): ?>
								<li>Locations:</li>
								<ul class="clsublist">
									<?php $__currentLoopData = $mySharedLocation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<a href="<?php echo e(route('frontend_more_shared_location',[$share_location['shared_location_id']])); ?>"><?php echo e($share_location['given_name']); ?></a>

											<a href="<?php echo e(route('edit_shared_location',$share_location['shared_location_id'])); ?>">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>

											<a onclick="deleteFunctionSharedLocation(this)" target="#" data-id = "<?php echo e($share_location['shared_location_id']); ?>">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-12 col-xs-12 shareshadowdiv member-homepage-shadow-div">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca member-homepage-subhead">Categories</h2>
							<div class="member-homepage-subhead-line"></div>
							<ul class="cllist member-homepage-favorites-list">
								<?php if(count($all_category) > 0): ?>
								<ul class="clsublist">
									<?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><a href="<?php echo e(route('frontend_category',['q'=>$category['category_id']])); ?>"><?php echo e($category['name']); ?></a></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php echo $__env->make('frontend.layouts.theme.right-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('add-js'); ?>
<script>
	function deleteFunctionSharedLocation(location) {
	    var id = $(location).attr('data-id');
	    // alert(id);
	    swal({
	      title: 'Are you sure?',
	      text: "Are you really want to delete!",
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Yes, delete it!'
	    }).then(function () {
	      window.location.href = "<?php echo e(url('/share-your-location/member/delete')); ?>"+"/"+id;
	    })
	}
  function deleteFunction(event) {
    var id = $(event).attr('data-id');
    swal({
      title: 'Are you sure?',
      text: "Are you really want to delete!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
        url: "<?php echo e(route('user_event_delete')); ?>",
        type: 'post',
        data: {data: id},
        success: function(data){
          if(data.status == 1){
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then(function(){
              location.reload();
            })
          }
        }
      })
    })
  }

  function deleteFunctionBusiness(event) {
    var id = $(event).attr('data-id');
    // console.log(id);
    swal({
      title: 'Are you sure?',
      text: "Are you really want to delete!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
        url: "<?php echo e(route('user_business_delete')); ?>",
        type: 'post',
        data: {data: id},
        success: function(data){
          console.log(data);
          if(data.status == 1){
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then(function(){
              location.reload();
            })
          }
        }
      })
    })
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>