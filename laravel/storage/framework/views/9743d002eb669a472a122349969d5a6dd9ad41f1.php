<?php $__env->startSection('meta_tag'); ?>
	<meta property="og:description" content="<?php echo e($data['given_name']); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharedlocationmaindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 col-xs-12 leftcardshadow shareditemdiv">
						<div class="col-md-6 col-sm-6 col-xs-12 customleftsharediv">
							<div class="col-md-12 col-xs-12">
								<div class="sharenewtextbtndiv">
									<p class="customleftsharedivhead"><?php echo e($data['given_name']); ?></p>

									<div class="shareattendingdiv">

										<span class="fav-btn-container" id="fav-btn-container">

											<?php if(!SharedLocationMyFavorite::check($data['shared_location_id'])): ?>
												<button type="button" data-id="<?php echo e($data['shared_location_id']); ?>" id="shared_location_fav_btn" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											<?php else: ?>
												<button type="button" data-id="<?php echo e($data['shared_location_id']); ?>" id="shared_location_rvm_fav_btn" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											<?php endif; ?>
										</span>
									</div>
								</div>
								<p id="location"><?php echo e($data['location_name']); ?></p>
								<?php if(!empty($data['description'])): ?>
								<p>
									<h3>Description</h3>
									<?php echo e($data['description']); ?>

								</p>
								<?php endif; ?>
								<p>
									<?php if(Auth::check() && Auth::user()->user_id == $data->user_id): ?>
									<a href="<?php echo e(route('edit_shared_location',$data['shared_location_id'])); ?>" class="btn btn-success more-location-edit-btn">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>

									<a onclick="deleteFunction(this)" target="#" data-id = "<?php echo e($data['shared_location_id']); ?>" class="btn btn-danger more-location-edit-btn more-location-delete-btn">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>
									<?php endif; ?>

									<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/more_shared_location?q=').$data['shared_location_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

									<a class="btn btn-social-icon btn-envelope email" href="mailto:?subject=Click the link&body=<?php echo e(url('/more_shared_location').'/'.$data['shared_location_id']); ?>"><span class="fa fa-envelope"></span></a>

									<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;location;url=<?php echo e(url('/more_shared_location').'/'.$data['shared_location_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

								</p>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<?php if(empty($data['images'][0])): ?>
								<div class="col-md-12 owlcarouseldiv" style="text-align: center;">
									<img  style="width: 50%;"  src="<?php echo e(url('/images/placeholder.svg')); ?>">
								</div>
							<?php else: ?>
								<?php if(count($data['images']) == 1): ?>
									<div class="col-md-12 owlcarouseldiv">
										<img src="<?php echo e(url('images/share_location/'.$data['images'][0])); ?>" class="sharelocation-single-image">
									</div>
								<?php else: ?>
									<div class="col-md-12 owlcarouseldiv">
										<div class="slickitem-1">
											<?php $__currentLoopData = $data['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="slick-slide">
												<img src="<?php echo e(url('images/share_location/'.$image)); ?>">
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
										<div class="slider-nav">
											<?php $__currentLoopData = $data['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="slick-slide">
												<img src="<?php echo e(url('images/share_location/'.$image)); ?>">
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
							<div class="col-md-12 col-xs-12 mapdiv">
	  							<div class="googlemaping">
	  								<div id="map" class="googlemap"></div>
	  							</div>
	  						</div>
						</div>
					</div>
				</div>
				<!--end event div-->
				<?php echo $__env->make('frontend.layouts.theme.right-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>
<div id="city" style="display: none;"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">

$(document).ready(function(){
	var full_address = $('#location').html();
	$.ajax({
			type: 'get',
			url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false&key=AIzaSyBlmxfYLHB9mW6gpPHLmSUMjq8JzMPi824",
			success: function(res){
				var latitude = res.results[0].geometry.location.lat;
		    	var longitude = res.results[0].geometry.location.lng;
				myMap(latitude,longitude);
			}
		});
})

/*for google map start*/
	function myMap(latitude = 51.508742,longitude = -0.120850) {
	  var myCenter = new google.maps.LatLng(latitude,longitude);
	  var mapCanvas = document.getElementById("map");
	  var mapOptions = {center: myCenter, zoom: 11};
	  var map = new google.maps.Map(mapCanvas, mapOptions);
	  var marker = new google.maps.Marker({position:myCenter});
	  marker.setMap(map);
	}
	/*for google map end*/

/*for owl carousel*/
$(document).ready(function() {

	$('.slickitem-1').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  infinite: true,
	  speed: 300,
	  arrows: false,
	  fade: true,
	  asNavFor: '.slider-nav',
	  autoplay: true
	});
	$('.slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  arrows: true,
	  asNavFor: '.slickitem-1',
	  dots: false,
	  focusOnSelect: true,
	});

	// $('#shared_location_fav_btn').on('click',function(){
	// 	var id = $(this).attr('data-id');
	// 	$.ajax({
	// 			headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
	// 			type: 'post',
	// 			url: "<?php echo e(route('add_to_favourite_shared_location')); ?>",
	// 			data: { 'id': id },
	// 			success: function(data){
	// 				console.log(data);

	// 				var html = '<button type="button" id="shared_location_rvm_fav_btn"  data-id="' + id + '" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>';

	// 				if(data.status == 1){
	// 					$('#fav-btn-container').html(html);
	// 					// specific.parent().html(_html);
	// 				}
	// 				if(data.status == 2){
	// 					$('#myModal').modal('show');
	// 				}

	// 			}
	// 		});
	// });

	// // Remove from favorite section
 //    	$(document).on('click','#shared_location_rvm_fav_btn',function(){
 //    		var id = $(this).attr('data-id');
 //    		$.ajax({
	// 			headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
	// 			type: 'post',
	// 			url: "<?php echo e(route('remove_to_favourite_shared_location')); ?>",
	// 			data: { 'id': id },
	// 			success: function(data){
	// 				console.log(data);

	// 				var html = '<button type="button" id="shared_location_fav_btn" data-id="' + id + '" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>';

	// 				if(data.status == 1){
	// 					$('#fav-btn-container').html(html);
	// 				}
	// 			}
	// 		});
 //    	});

});
/*end owl carousel*/
</script>
<script>
  function deleteFunction(location) {
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
      window.location.href = "<?php echo e(url('/share-your-location/delete')); ?>"+"/"+id;
    })
  }

function initAutocomplete() {
	if ( document.readyState === "complete" ){
		var map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: 51.508530, lng: -0.076132},
	  zoom: 13,
	  mapTypeId: 'roadmap'
	});

	// Create the search box and link it to the UI element.
	var input = document.getElementById('venue');
	var searchBox = new google.maps.places.SearchBox(input);
	// map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	// Bias the SearchBox results towards current map's viewport.
	map.addListener('bounds_changed', function() {
	  searchBox.setBounds(map.getBounds());
	});

	var markers = [];
	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener('places_changed', function() {
	  var places = searchBox.getPlaces();

	  if (places.length == 0) {
	    return;
	  }

	  // Clear out the old markers.
	  markers.forEach(function(marker) {
	    marker.setMap(null);
	  });
	  markers = [];

	  // For each place, get the icon, name and location.
	  var bounds = new google.maps.LatLngBounds();
	  places.forEach(function(place) {
	    if (!place.geometry) {
	      console.log("Returned place contains no geometry");
	      return;
	    }
	    var icon = {
	      url: place.icon,
	      size: new google.maps.Size(71, 71),
	      origin: new google.maps.Point(0, 0),
	      anchor: new google.maps.Point(17, 34),
	      scaledSize: new google.maps.Size(25, 25)
	    };

	    // Create a marker for each place.
	    markers.push(new google.maps.Marker({
	      map: map,
	      icon: icon,
	      title: place.name,
	      position: place.geometry.location
	    }));

	    if (place.geometry.viewport) {
	      // Only geocodes have viewport.
	      bounds.union(place.geometry.viewport);
	    } else {
	      bounds.extend(place.geometry.location);
	    }

	    document.getElementById('latitude').value = place.geometry.location.lat();
		document.getElementById('longitude').value = place.geometry.location.lng();
		// console.log(place.geometry.location.lat());
		var lat = place.geometry.location.lat();
		var long = place.geometry.location.lng();
		$.ajax({
		    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+long+'&sensor=false',
		    success: function(data){
		        var formatted = data.results;
		        var address_array = formatted[6].formatted_address.split(',');
		        // var city = address_array[0];
		         $.each( data['results'],function(i, val) {
	                $.each( val['address_components'],function(i, val) {
	                    if (val['types'] == "locality,political") {
	                        if (val['long_name']!="") {
	                            // console.log(val['long_name']);
	                            $('#city_share_location').val(val['long_name']);
	                        }
	                        else {
	                            console.log("unknown");
	                        }
	                    }
	                });
	            })
		        // console.log(address_array);
		   }
		});
	  });
	  map.fitBounds(bounds);
	});
	}
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHZpcyDU3JbFSCUDIEN59Apxj4EqDomI&libraries=places&callback=initAutocomplete"
         async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>