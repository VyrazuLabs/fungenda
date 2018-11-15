<?php $__env->startSection('content'); ?>
<!--shared location heading with button start-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 sharedfirstdiv">
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12  shared sharepublic">
				<?php if(Auth::User()): ?>
					<p class="sharemaintext sharepublic-text" id="public_heading">Public Locations</p>
				<?php else: ?>
					<p class="sharemaintext sharepublic-text">Public Locations</p>
				<?php endif; ?>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 sharedbtndiv">
				<a href="<?php echo e(url('/share-your-location')); ?>"><button type="button" id="privately_saved" class="btn privatelocation">Add your locations</button></a>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 sharedbtndiv private_parent">
				<a href="<?php echo e(url('/location/privately_saved')); ?>"><button type="button" id="privately_saved" class="btn privatelocation">View my privately saved locations</button></a>
			</div>
			<div style="display: none;" class="col-lg-4 col-md-3 col-sm-12 col-xs-12 sharedbtndiv public_parent">
				<a href="<?php echo e(url('/location')); ?>"><button type="button" id="privately_saved" class="btn privatelocation">View my publicly saved locations</button></a>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		</div>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharedmaindiv">
	<div class="container">
		<div class="shareddiv">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharepubliclocation">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 shareshadowdiv">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<form id="sharedLocationSearchForm">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="searchfor">Search For</label>
		      				<input type="text" id="searchfor" name="term" class="form-control shareinput search-data" placeholder="More terms like Yoga and Bicycle etc…' ">
	    				</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="city">City</label>
		      				<input type="text" id="city" name="city_name" class="form-control shareinput search-data" placeholder="Type name of the city">
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="state">State</label>
		      				<input type="text" id="state" class="form-control shareinput search-data" placeholder="Type name of the state" name="state_name">
						</div>

						<div id="apend"></div>
						<div id="main">
							<?php if($type == 'private'): ?>
								<input type="hidden" value="private" id="private" name="type">
								<?php $__currentLoopData = $ar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$share_location_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
										<h2 class="shareheadca"><?php echo e($share_location_array['state_name']); ?></h2>
										<?php $__currentLoopData = $share_location_array['cities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<ul class="cllist">

												<li class="city_name"><?php echo e($share_location['city_name']); ?></li>
												<?php $__currentLoopData = $share_location['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<ul class="clsublist">
													<li>
														<a href="<?php echo e(url('more_shared_location').'/'.$key); ?>">
															<?php echo e($location); ?>

														</a>
													</li>
												</ul>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
							<?php if(!empty($ar)): ?>
							<input type="hidden" value="public" id="private" name="type">
								<?php $__currentLoopData = $ar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$share_location_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
										<h2 class="shareheadca"><?php echo e($share_location_array['state_name']); ?></h2>
										<?php $__currentLoopData = $share_location_array['cities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<ul class="cllist">

												<li class="city_name"><?php echo e($share_location['city_name']); ?></li>
												<?php $__currentLoopData = $share_location['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<ul class="clsublist">
													<li>
														<a href="<?php echo e(url('more_shared_location').'/'.$key); ?>">
															<?php echo e($location); ?>

														</a>
													</li>
												</ul>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<div class="eventmain businessevent">
									<center><img style="margin-top: 56px; margin-bottom: 30px;" src="<?php echo e(url('/images/error/Image_from_Skype1.png')); ?>" height="100" width="100"></center><br>
									<center><h4>Nothing Found...</h4></center>
									<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
								</div>
							<?php endif; ?>
							<?php endif; ?>
						</div>
						</form>
					</div>
				</div>
				<?php echo $__env->make('frontend.layouts.theme.right-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
		<span id="pub_url" style="display: none;"><?php echo e(url('/more_shared_location')); ?></span>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('add-js'); ?>
	<script type="text/javascript">
		// $(document).ready(function() {
		// 	var city_append = '',
		// 	state = '',
		// 	location ='';
		// 	$('#searchfor').on('keyup',function(){
		// 		var pub_url = $('#pub_url').html();
		// 		state = '';
		// 		city_append = '';
		// 		location = '';
		// 		var search_hidden = $('#private').val();
		// 		// alert(search_hidden);
		// 		var search_key = $(this).val();
		// 		var form_data = new FormData($("#sharedLocationSearchForm")[0]);
			// 	$.ajax({
			// 		headers: {'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>'},
			// 		url: "<?php echo e(url('/location/search/searchfor')); ?>",
			// 		type: 'post',
			// 		data: {'data': search_key,
			// 				'search_hidden': search_hidden
			// 			  },
			// 		success: function(data){
			// 			state = '';
			// 			city_append = '';
			// 			location = '';
			// 			$('#apend').html('');
			// 			console.log(data);
			// 				$('#main').hide();
			// 				$( ".rvm" ).remove();
			// 			$.each(data,function(key,value){
			// 				city_append = '';
			// 				$.each(value.cities,function(key,city){
			// 					location = '';
			// 					$.each(city.locations,function(id,location_name){
			// 						location += '<ul class="clsublist">'+
			// 									'<li>'+
			// 										'<a href="'+pub_url+'/'+id+'">'+
			// 										location_name+
			// 										'</a>'+
			// 									'</li>'
			// 									+'</ul>';
			// 					});
			// 					city_append += '<ul class="cllist">'+
			// 								'<li class="city_name">'+
			// 								city.city_name +
			// 								'</li>'+
			// 								location
			// 							+'</ul>';
			// 				});

			// 				state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
			// 					+'<h2 class="shareheadca">'+
			// 							value.state_name +
			// 							'</h2>'
			// 							+city_append
			// 						+'</div>';

			// 			});
			// 			$('#apend').append(state);
			// 		}
			// 	})
			// });

		// 	$('#state').on('keyup',function(){
		// 		var pub_url = $('#pub_url').html();
		// 		state = '';
		// 		city_append = '';
		// 		location = '';
		// 		$('#apend').html('');
		// 		var search_key = $(this).val();
		// 		var search_hidden = $('#private').val();
		// 		$.ajax({
		// 			headers: {'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>'},
		// 			url: "<?php echo e(url('/location/search/state')); ?>",
		// 			type: 'post',
		// 			data: {'data': search_key, 'search_hidden': search_hidden},
		// 			success: function(data){
		// 				state = '';
		// 				city_append = '';
		// 				location = '';
		// 				$('#apend').html('');
		// 				console.log(data);
		// 					$('#main').hide();
		// 					$( ".rvm" ).remove();
		// 				$.each(data,function(key,value){
		// 					city_append = '';
		// 					$.each(value.cities,function(key,city){
		// 						location = '';
		// 						$.each(city.locations,function(id,location_name){
		// 							location += '<ul class="clsublist">'+
		// 										'<li>'+
		// 											'<a href="'+pub_url+'/'+id+'">'+
		// 											location_name+
		// 											'</a>'+
		// 										'</li>'
		// 										+'</ul>';
		// 						});
		// 						city_append += '<ul class="cllist">'+
		// 									'<li class="city_name">'+
		// 									city.city_name +
		// 									'</li>'+
		// 									location
		// 								+'</ul>';
		// 					});

		// 					state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
		// 						+'<h2 class="shareheadca">'+
		// 								value.state_name +
		// 								'</h2>'
		// 								+city_append
		// 							+'</div>';

		// 				});
		// 				$('#apend').append(state);
		// 			}
		// 		})
		// 	});

		// 	$('#city').on('keyup',function(){
		// 		var pub_url = $('#pub_url').html();
		// 		state = '';
		// 		city_append = '';
		// 		location = '';
		// 		var search_key = $(this).val();
		// 		var search_hidden = $('#private').val();
		// 		$.ajax({
		// 			headers: {'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>'},
		// 			url: "<?php echo e(url('/location/search/city')); ?>",
		// 			type: 'post',
		// 			data: {'data': search_key, 'search_hidden': search_hidden},
		// 			success: function(data){
		// 				state = '';
		// 				city_append = '';
		// 				location = '';
		// 				$('#apend').html('');
		// 				console.log(data);
		// 					$('#main').hide();
		// 					$( ".rvm" ).remove();
		// 				$.each(data,function(key,value){
		// 					city_append = '';
		// 					$.each(value.cities,function(key,city){
		// 						location = '';
		// 						$.each(city.locations,function(id,location_name){
		// 							location += '<ul class="clsublist">'+
		// 										'<li>'+
		// 											'<a href="'+pub_url+'/'+id+'">'+
		// 											location_name+
		// 											'</a>'+
		// 										'</li>'
		// 										+'</ul>';
		// 						});
		// 						city_append += '<ul class="cllist">'+
		// 									'<li class="city_name">'+
		// 									city.city_name +
		// 									'</li>'+
		// 									location
		// 								+'</ul>';
		// 					});

		// 					state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
		// 						+'<h2 class="shareheadca">'+
		// 								value.state_name +
		// 								'</h2>'
		// 								+city_append
		// 							+'</div>';

		// 				});
		// 				$('#apend').append(state);
		// 			}
		// 		})
		// 	});
		// });
		$(document).ready(function() {
			var pageURL = $(location).attr("href");
            if(pageURL.indexOf('privately_saved') != -1) {
            	$('#public_heading').html('My Private Locations');
            	$('.private_parent').hide();
            	$('.public_parent').show();
            } else {
            	$('.private_parent').show();
            	$('.public_parent').hide();
            }
		})


		$('.search-data').blur(function(){
			var form_data = new FormData($("#sharedLocationSearchForm")[0]);
			searchLocation(form_data);
		});

		function searchLocation(form_data) {
			$.ajax({
				headers: {'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>'},
				url: "<?php echo e(url('/location/search/shared-locations')); ?>",
				type: 'post',
				data: form_data,
				contentType: false,
				processData: false,
				success: function(data){
					var state = '';
					var city_append = '';
					var location = '';
					$('#apend').html('');
					console.log(data);
					$('#main').hide();
					$( ".rvm" ).remove();
					$.each(data,function(key,value){
						city_append = '';
						$.each(value.cities,function(key,city){
							location = '';
							$.each(city.locations,function(id,location_name){
								location += '<ul class="clsublist">'+
											'<li>'+
												'<a href="'+pub_url+'/'+id+'">'+
												location_name+
												'</a>'+
											'</li>'
											+'</ul>';
							});
							city_append += '<ul class="cllist">'+
										'<li class="city_name">'+
										city.city_name +
										'</li>'+
										location
									+'</ul>';
						});

						state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
							+'<h2 class="shareheadca">'+
									value.state_name +
									'</h2>'
									+city_append
								+'</div>';

					});
					$('#apend').append(state);
					}
			});
		}
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>