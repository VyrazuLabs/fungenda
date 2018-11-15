<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-md-12 col-xs-12 maindiv">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 business">
			<div class="col-md-12 col-xs-12 custombox">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 left-div">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow">
						<p class="shareyourlocation-heading">Share Your Location</p>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 create-locationform-div">
							<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 create-locationform-sub-div share-locations-boxes-div">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<?php if(isset($location_data)): ?>
									<?php echo e(Form::model($location_data,['method'=>'post', 'files'=>'true', 'url'=>'/share-your-location/update', 'class'=>"form-horizontal"])); ?>

									<input type="hidden" name="id" value="<?php echo e($location_data['shared_location_id']); ?>">
								<?php else: ?>
									<?php echo e(Form::open(['url'=>'/share-your-location/save', 'method' => 'post', 'files'=>'true', 'class'=>"form-horizontal"])); ?>

								<?php endif; ?>
								<?php if(session('city_id')): ?>
									<dir style="display: none;" id="city_id"><?php echo e(session("city_id")); ?></dir>
								<?php endif; ?>
										<div class="form-group yourshare-group">
									    	<div class="col-sm-3 col-xs-12  createlocation-error p-0">
									      	  <?php echo e(Form::label('given_name','Name',['class'=>'control-label'])); ?>

									      	</div>
									    	<div class="col-sm-7 col-xs-12">
									      		<?php echo e(Form::text('given_name',null,['class'=>'form-control yourshare-box','id'=>'name','placeholder'=>'Enter your location name'])); ?>

									      		<?php if($errors->has('given_name')): ?>
				                                    <span class="help-block">
				                                        <span class="signup-error"><?php echo e($errors->first('given_name')); ?></span>
				                                    </span>
				                                <?php endif; ?>
									    	</div>
									  	</div>
									    <div class="form-group yourshare-group">
									    	<div class="col-sm-3 col-xs-12 createlocation-error p-0">
									      	  <?php echo e(Form::label('locationname','Location',['class'=>'control-label'])); ?>

									      	</div>
									    	<div class="col-sm-7 col-xs-12 ">
									      		<?php echo e(Form::text('location_name',null,['class'=>'form-control yourshare-box','id'=>'venue','placeholder'=>'Enter location'])); ?>

									      		<?php if($errors->has('location_name')): ?>
				                                    <span class="help-block">
				                                        <span class="signup-error"><?php echo e($errors->first('location_name')); ?></span>
				                                    </span>
				                                <?php endif; ?>
									    	</div>
									    	<div class="col-sm-2 col-xs-12 locate-me-div">
									    		<div class="locate-me">
									                <!-- <a href="javascript:void(0)" onclick="getLocation()">
										                <span class="locate-me-icon icon-pointer"></span>
										                <span class="locate-me-text">Locate Me</span>
										            </a> -->
										            <a href="javascript:void(0)" class="locate-me-btn" id="locateMeBtn">
										                <span class="locate-me-icon icon-pointer"></span>
										                <span class="locate-me-text">Locate Me</span>
										            </a>
									            </div>
									    	</div>
									  	</div>
									  	<?php if(Auth::user()): ?>
									  	<div class="form-group radio-btn yourshare-group">
									  		<div class="col-sm-3 col-xs-12 createlocation-desc-error p-0">
									  			<?php echo e(Form::label('privacy','Privacy',['class'=>'control-label shareyour-radio'])); ?>

									  		</div>
									  	<?php if(isset($location_data)): ?>
									  		<div class="col-sm-7 col-xs-12">
									  		<?php if($location_data['status'] == 1): ?>
												<label for="publicradio" class="custom-control custom-radio">
								  					<?php echo e(Form::radio('radio', 1 , true,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					<?php echo e(Form::radio('radio', 2 , false,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											<?php endif; ?>
											<?php if($location_data['status'] == 2): ?>
												<label for="publicradio" class="custom-control custom-radio">
								  					<?php echo e(Form::radio('radio', 1 , false,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					<?php echo e(Form::radio('radio', 2 , true,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											<?php endif; ?>
											</div>
									  	<?php else: ?>
									  		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
												<label for="publicradio" class="custom-control custom-radio">
								  					<?php echo e(Form::radio('radio', 1 , true,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					<?php echo e(Form::radio('radio', 2 , false,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											</div>
										<?php endif; ?>
										</div>
										<?php else: ?>
										<div class="form-group radio-btn yourshare-group"  style="display:none;">
									  		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 createlocation-desc-error p-0">
									  			<?php echo e(Form::label('privacy','Privacy',['class'=>'control-label shareyour-radio'])); ?>

									  		</div>
									  		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
												<label for="publicradio" class="custom-control custom-radio">
								  					<?php echo e(Form::radio('radio', 1 , true,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					<?php echo e(Form::radio('radio', 2 , false,['class'=>'custom-control-input'])); ?>

								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											</div>

										</div>
										<?php endif; ?>

										<div class="form-group yourshare-group">
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 createlocation-error p-0">
												<label for="countrydropdown" class="control-label">State</label>
											</div>
											<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 create-share-city-selectbox">

											<?php if(isset($location_data['state'])): ?>
												<span style="display: none;" id="edit_state_value"><?php echo e($location_data['state_name']); ?></span>
												<span style="display: none;" id="edit_city_value"><?php echo e($location_data['city_name']); ?></span>
											<?php endif; ?>

											<?php if(isset($location_data['respected_state'])): ?>
												<?php echo e(Form::select('state',$location_data['respected_state'], null,[ 'id' => 'state','class'=>'form-control yourshare-box searchState','placeholder'=>'--select--' ] )); ?>


											<?php else: ?>
												<?php echo e(Form::select('state', $all_states, null, ['class'=>'form-control yourshare-box searchState','id'=>'state','placeholder'=>'--select--'])); ?>

											<?php endif; ?>
												<!-- <select id="state" class="form-control yourshare-box searchState" name="state">
		      									</select> -->
												<?php if($errors->has('state')): ?>
				                                    <span class="help-block">
				                                        <span class="signup-error"><?php echo e($errors->first('state')); ?></span>
				                                    </span>
				                                <?php endif; ?>
											</div>
										</div>
										<div class="form-group yourshare-group">
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-left p-0">
												<label for="countrydropdown" class=" control-label">City</label>
											</div>
											<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 create-share-city-selectbox">
											<!-- 	<select multiple="multiple" id="citydropdown" class="form-control yourshare-box" name="city">
													<option>2</option>
													<option>5</option>
													<option>44</option>
													<option>4</option>
		      									</select> -->
		      								<?php if(isset($location_data['respected_city'])): ?>
												<?php echo e(Form::select('city',$location_data['respected_city'], null,[ 'id' => 'citydropdown','class'=>'form-control yourshare-box','placeholder'=>'--select--' ] )); ?>


											<?php else: ?>

		      									<?php echo e(Form::select('city', [], null, ['class'=>'form-control yourshare-box','id'=>'citydropdown','placeholder'=>'--select--'])); ?>

		      								<?php endif; ?>

												<?php if($errors->has('city')): ?>
				                                    <span class="help-block">
				                                        <span class="signup-error"><?php echo e($errors->first('city')); ?></span>
				                                    </span>
				                                <?php endif; ?>
											</div>
										</div>
										<div class="form-group yourshare-group">
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 createlocation-desc-error p-0">
												<label for="description" class="control-label">Description</label>
											</div>
											<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
												<?php echo e(Form::textarea('description',null,['class'=>'form-control yourshare-box','row'=>'8'])); ?>

											</div>
										</div>
									  	<div class="col-lg-12 col-xs-12 p-0">
									  		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
									  		</div>
									  		<div class="col-lg-7 col-md-8 col-sm-8 col-xs-12 p-0">
									  			<div class="googlemaping createeventgooglemap">
						  							<div id="map" class="googlemap"></div>
						  						</div>
									  		</div>
										</div>
										<div class="col-lg-12 col-xs-12 form-group yourshare-group sarefileupload-group">
											<div class="col-sm-3 createlocation-desc-error p-0">
										    	<label for="inputfile" class="">Image</label>
										    </div>
										    <div class="col-sm-7 col-xs-12">
										    	<?php echo e(Form::file('file[]', ['multiple' => 'multiple','id'=>'inputfile'])); ?>

										    	<?php if($errors->has('file')): ?>
				                                    <span class="help-block">
				                                        <span class="signup-error"><?php echo e($errors->first('file')); ?></span>
				                                    </span>
				                                <?php endif; ?>
										    	<div id="inputfileimages"></div>
										    	<?php if(isset($location_data)): ?>
										    	<div class="share-location-imageshow-div">
										    		<?php $__currentLoopData = $location_data['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										    		<?php if($image): ?>
										    		<div class="show-image-div">
							                          <span>
							                            <?php if(file_exists(public_path().'/'.'images'.'/'.'share_location'.'/'.$image) == 1): ?>
							                              <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/share_location'.'/'.$image)); ?>">
							                            <?php else: ?>
							                              <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event/placeholder.svg')); ?>">
							                            <?php endif; ?>
							                                <a href= "<?php echo e(route('shared_location_edit_image_delete',['shared_location_id'=> $location_data['shared_location_id'],'img_name'=>$image])); ?>" class="edit-image-cross-location"><i class="fa fa-times cross-share-location" aria-hidden="true"></i></a>
							                          </span>
							                      	</div>
							                        <?php endif; ?>
										    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										    	</div>
										    <?php endif; ?>
										    </div>
										</div>
										<div class="col-lg-12 col-xs-12 form-group yourshare-group">
											<div class="col-sm-3"></div>
											<div class="col-lg-12 col-xs-12 create-location-btn-div create-location-btn-div-box">
											<?php if(isset($location_data)): ?>
												<?php echo e(Form::Submit('Update Location Listing',['class'=>'btn share-locationlisting-btn'])); ?>

											<?php else: ?>
										    	<?php echo e(Form::Submit('Submit Location Listing',['class'=>'btn share-locationlisting-btn'])); ?>

										    <?php endif; ?>
										    </div>
										</div>
										<?php echo e(Form::hidden('cities',null,['id'=>'city_share_location'])); ?>

									<?php echo e(Form::close()); ?>

									<div id="latitude" style="display: none;"></div>
									<div id="longitude" style="display: none;"></div>
								</div>
							</div>
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
<script type="text/javascript">
      // $("#state").select2();
      $("#citydropdown").select2();
</script>

<script type="text/javascript">

//image upload start
	function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
	// files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="locationimagebox"><span class="imagesnames">'+escape(f.name)+'</span><a href="javascript:void(0)" class="locationimageboxcross" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('inputfileimages').innerHTML =  output.join('');
    console.log(output);
  }

  document.getElementById('inputfile').addEventListener('change', handleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
  }
//image upload end
$(document).ready(function(){
	// var edit_state_value = $('#edit_state_value').html();

	// var data = {
	// 	id: 1,
	//     state: edit_state_value
	// };

	// var newOption = new Option(data.id,data.state, false, false);
	// $('#state').append(newOption).trigger('change');

	// $('#countrydropdown').on('change', function(){
	// 	var value = $(this).val();
	// 	// console.log(value);
	// 	$.ajax({
	// 		type: 'get',
	// 		url: "<?php echo e(url('/fetch_state')); ?>",
	// 		data: { data: value },
	// 		success: function(data){
	// 			// console.log(data);
	// 			$('#state').empty();
	// 			$.each(data,function(index, value){
	// 				$('#state').append('<option value="'+ index +'">'+value+'</option>');
	// 			});
	// 		}
	// 	});
	// });

	// var city_id = $('#city_id').html();

	// $('#state').on('change', function() {
 //    	var value = $(this).val();
 //    	$.ajax({
 //    		type: 'get',
 //    		url: "<?php echo e(url('/fetch_country')); ?>",
 //    		data: { data: value },
 //    		success: function(data){
 //    			$('#citydropdown').empty();
 //    			$.each(data,function(index, value){
 //    				$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
 //    			});
 //    		}
 //    	});
	// });




	$('#countrydropdown').on('change', function(){
		var value = $(this).val();
		// console.log(value);
		$.ajax({
			type: 'get',
			url: "https://fun-genda.com/fetch_state",
			data: { data: value },
			success: function(data){
				// console.log(data);
				$('#state').empty();
				$.each(data,function(index, value){
					$('#state').append('<option value="'+ index +'">'+value+'</option>');
				});
			}
		});
	});

    $('#state').on('change', function() {
    	var value = $(this).val();
    	$.ajax({
    		type: 'get',
    		url: "<?php echo e(url('/fetch_country')); ?>",
    		data: { data: value },
    		success: function(data){
    			$('#citydropdown').empty();
    			$.each(data,function(index, value){
    				$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
    				// console.log(value);
    			});
    		}
    	});
	});

	var state_id = $('#state').val();
	var city_id = $('#city_id').html();
	// console.log(city_id);
	if(state_id != '') {
		$.ajax({
    		type: 'get',
    		url: "<?php echo e(url('/fetch_country')); ?>",
    		data: { data: state_id },
    		success: function(data){
    			$('#citydropdown').empty();
    			$.each(data,function(index, value){
    				if(index == city_id) {
    					$('#citydropdown').append('<option value="'+ index +'" selected>'+value+'</option>');

    				}
    				else {
    					$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');

    				}
    				// console.log(value);
    			});
    		}
    	});
	}




	/* state selection by searching */
	$('.searchState').select2();
});
</script>
<script>

// Location function
var markers = [];
function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: 40.4173, lng: -82.9071},
	  zoom: 7
	});


	var input = document.getElementById('venue');

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
 	// This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function(event) {
	  var geocoder = new google.maps.Geocoder;
	  var pos = {
	      lat: event.latLng.lat(),
	      lng: event.latLng.lng()
	    };
	  geocodeLatLng(geocoder, map, pos);
      marker.setPosition(event.latLng);
    });

	autocomplete.addListener('place_changed', function() {
	  marker.setVisible(false);
	  var place = autocomplete.getPlace();
	  if (!place.geometry) {
	    // User entered the name of a Place that was not suggested and
	    // pressed the Enter key, or the Place Details request failed.
	    window.alert("No details available for input: '" + place.name + "'");
	    return;
	  }

	  // If the place has a geometry, then present it on a map.
	  if (place.geometry.viewport) {
	    map.fitBounds(place.geometry.viewport);
	  } else {
	    map.setCenter(place.geometry.location);
	    map.setZoom(17);  // Why 17? Because it looks good.
	  }
	  marker.setPosition(place.geometry.location);
	  marker.setVisible(true);
	});

	document.getElementById('locateMeBtn').addEventListener('click', function() {
      locateMe(map, marker);
    });
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
	var marker = new google.maps.Marker({
	  position: location,
	  map: map
	});
	markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
	  markers[i].setMap(map);
	}
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
	setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
	clearMarkers();
	markers = [];
}

function locateMe(map, marker) {
	var geocoder = new google.maps.Geocoder;
	var infoWindow = new google.maps.InfoWindow;

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    var pos = {
	      lat: position.coords.latitude,
	      lng: position.coords.longitude
	    };

	 //    var markers = [];

	 //    var marker = new google.maps.Marker({
		//     position: pos,
		//     map: map
		// });
		marker.setPosition(pos);
	    map.setCenter(pos);
	    console.log(pos);
	    geocodeLatLng(geocoder, map, pos);
	  }, function() {
	    handleLocationError(true, infoWindow, map.getCenter());
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleLocationError(false, infoWindow, map.getCenter());
	}
}

function geocodeLatLng(geocoder, map, pos) {
	geocoder.geocode({'location': pos}, function(results, status) {
	  if (status === 'OK') {
	    if (results[0]) {
	      $('#venue').val(results[0].formatted_address);
	    } else {
	      window.alert('No results found');
	    }
	  } else {
	    window.alert('Geocoder failed due to: ' + status);
	  }
	});
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
	                      'Error: The Geolocation service failed.' :
	                      'Error: Your browser doesn\'t support geolocation.');
	infoWindow.open(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHZpcyDU3JbFSCUDIEN59Apxj4EqDomI&libraries=places&callback=initMap"
         async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>