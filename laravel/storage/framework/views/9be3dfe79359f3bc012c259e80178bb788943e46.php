<?php $__env->startSection('meta_tag'); ?>
	<meta property="og:description" content="<?php echo e($data['business_title']); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-12 sharedlocationmaindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 col-xs-12 leftcardshadow shareditemdiv">
						<div class="col-md-6 col-sm-6 col-xs-12 customleftsharediv">
							<div class="col-md-12 col-xs-12">
								<div class="sharenewtextbtndiv">
									<p class="customleftsharedivhead"><?php echo e($data['business_title']); ?></p>
									<h5 class="colors customleftsharedivsubtext">Listed in <a href="<?php echo e(route('frontend_category',['q'=> $data['category_id']])); ?>"><?php echo e($data->getCategory()->first()->name); ?></a></h5>

									<div class="shareattendingdiv ">
										<span class="fav-btn-container">
											<?php if(!Favourite::check($data['business_id'], 1)): ?>
												<button type="button" data-id="<?php echo e($data['business_id']); ?>" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											<?php else: ?>
												<button type="button" data-id="<?php echo e($data['business_id']); ?>" class="btn favourite rvm_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											<?php endif; ?>
										</span>

									<?php if(IAmAttending::IAmAttendingButtonCheck($data['business_id'],1) == true): ?>
										<button type="button" data-id = "<?php echo e($data['business_id']); ?>" class="btn favourite eventattendbtn i_am_attending_business"><span class="favourite-btn"> I am Attending</span></button>
									<?php endif; ?>

									</div>
								</div>
								<?php if(count($data->getWhoAreAttending) > 0): ?>
								<?php 
									$counter = 1;
									$count = 0;
								 ?>
								<p class="whoattending">Who's Attending?</p>
								<?php $__currentLoopData = $data->getWhoAreAttending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($counter <= 4): ?>
										<span class="attendingmail">
											<?php 
												$count++;
											 ?>
											<?php if(isset($user->getUser->first_name)): ?>
												<?php echo e($user->getUser->first_name); ?><?php echo e($count != count($data->getWhoAreAttending) ? ',' : ''); ?>

											<?php endif; ?>
										</span>
									<?php else: ?>
										<span class="attendingmail see_more">
											<?php 
												$count++;
											 ?>
											<?php if(isset($user->getUser->first_name)): ?>
												<?php echo e($user->getUser->first_name); ?><?php echo e($count != count($data->getWhoAreAttending) ? ',' : ''); ?>

											<?php endif; ?>
										</span>
									<?php endif; ?>
									<?php if($counter == 4): ?>
										<br>
									<?php endif; ?>
									<?php 
										$counter++;
									 ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php if($counter > 4): ?>
										<p class="attendingmail dropseemore"><a id="see_more" href="JavaScript:Void(0)">See More <i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
									<?php endif; ?>
								<?php endif; ?>

								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress" id="location"><?php echo e($data->address_data); ?></p>
								<?php if(!empty($data['business_venue'])): ?>
									<p class="attendaddress"><span class="eventdatetime"><span>Venue: </span></span><?php echo e($data['business_venue']); ?></p>
								<?php endif; ?>
								<?php if(!empty($data['business_mobile'])): ?>
									<p class="attendaddress"><span class="eventdatetime"><span>Contact number: </span></span><?php echo e($data['business_mobile']); ?></p>
								<?php endif; ?>
								<?php if(!empty($data['business_email'])): ?>
									<p class="attendaddress"><span class="eventdatetime"><span>Email: </span></span>
										<a href="mailto:<?php echo e($data['business_email']); ?>"><?php echo e($data['business_email']); ?></a>
									</p>
								<?php endif; ?>
								<?php if(!empty($data['business_website'])): ?>
								<p class="sharedcontactinfo">Website:</p>

										<?php if(strpos($data['business_website'], "http") === 0): ?>
											<p class="attendaddress"><span ><a href="<?php echo e($data['business_website']); ?>" target="_blank"><?php echo e($data['business_website']); ?></a></span></p>
										<?php else: ?>
											<p class="attendaddress"><span ><a href="//<?php echo e($data['business_website']); ?>" target="_blank"><?php echo e($data['business_website']); ?></a></span></p>
										<?php endif; ?>
									
								<?php endif; ?>
								<p class="sharedcontactinfo">Hours:</p>
								<?php if(!empty(explode(',',$data['business_hours']['sunday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Sunday</span> @ <?php echo e(explode(',',$data['business_hours']['sunday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['sunday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['sunday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									 to
									<?php echo e(explode(',',$data['business_hours']['sunday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['sunday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['sunday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>
								<?php if(!empty(explode(',',$data['business_hours']['monday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Monday</span> @ <?php echo e(explode(',',$data['business_hours']['monday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['monday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['monday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									 to
									<?php echo e(explode(',',$data['business_hours']['monday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['monday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['monday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>
								<?php if(!empty(explode(',',$data['business_hours']['tuesday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Tuesday</span> @ <?php echo e(explode(',',$data['business_hours']['tuesday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['tuesday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['tuesday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									to
									<?php echo e(explode(',',$data['business_hours']['tuesday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['tuesday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['tuesday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>
								<?php if(!empty(explode(',',$data['business_hours']['wednesday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Wednesday</span> @ <?php echo e(explode(',',$data['business_hours']['wednesday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['wednesday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['wednesday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									to
									<?php echo e(explode(',',$data['business_hours']['wednesday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['wednesday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['wednesday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>
								<?php if(!empty(explode(',',$data['business_hours']['thursday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Thursday</span> @ <?php echo e(explode(',',$data['business_hours']['thursday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['thursday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['thursday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									to
									<?php echo e(explode(',',$data['business_hours']['thursday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['thursday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['thursday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>
								<?php if(!empty(explode(',',$data['business_hours']['friday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Friday</span> @ <?php echo e(explode(',',$data['business_hours']['friday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['friday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['friday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									to
									<?php echo e(explode(',',$data['business_hours']['friday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['friday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['friday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>
								<?php if(!empty(explode(',',$data['business_hours']['saturday_start'])[0])): ?>
									<p class="attendtimedate"><span class="eventdatetime">Saturday</span> @ <?php echo e(explode(',',$data['business_hours']['saturday_start'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['saturday_start'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['saturday_start'])[1] == 1): ?>
										pm
									<?php endif; ?>
									to
									<?php echo e(explode(',',$data['business_hours']['saturday_end'])[0]); ?>

									<?php if(explode(',',$data['business_hours']['saturday_end'])[1] == 0): ?>
										am
									<?php endif; ?>
									<?php if(explode(',',$data['business_hours']['saturday_end'])[1] == 1): ?>
										pm
									<?php endif; ?>
									</p>
								<?php endif; ?>

								<?php if(!empty($data['business_cost'])): ?>
								<p class="sharedcontactinfo">Business Cost:</p>
									<p class="attendtimedate"><span class="eventdatetime"><span class=""></span></span><?php echo e($data['business_cost']); ?></p>
								<?php endif; ?>

								<p class="sharedcontactinfo"></p>
								
									<?php if($data['business_offer']['business_discount_types'] == '1'): ?>
										<p class="attendaddress"><span class="eventdatetime">Kid friendly</span></p>
									<?php endif; ?>
									<?php if($data['business_offer']['business_discount_types'] == '2'): ?>
										<p class="attendaddress"><span class="eventdatetime">Pet friendly</span></p>
									<?php endif; ?>
									<?php if($data['business_offer']['business_discount_types'] == '1,2'): ?>
										<p class="attendaddress"><span class="eventdatetime">kid and pet friendly</span></p>
									<?php endif; ?>
									<?php if($data['business_offer']['business_discount_types'] == '0' && empty($data['business_offer']['business_discount_rate'])): ?>
										<p class="attendaddress"><span class="eventdatetime">No discount</span></p>
									<?php endif; ?>

									<?php if(!empty($data['business_offer']['business_discount_rate'])): ?>
										<p class="sharedcontactinfo">Discount</p>
										<p class="attendaddress"><span class="eventdatetime"><?php echo e($data['business_offer']['business_discount_rate']); ?></span></p>
									<?php endif; ?>

								<p class="sharedcontactinfo">Description:</p>
								<p class="attendtimedate"><span class="eventdatetime"></span><?php echo nl2br($data['business_description']); ?></p>

								<?php if(count($data['all_tags']) > 0): ?>
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										<?php $__currentLoopData = $data['all_tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if(count($value) > 0): ?>
												<span class="listed_in_index"><?php echo e($value[0]); ?></span>
												<?php if($key == count($data['all_tags'])-1): ?>

												<?php else: ?>
													,
												<?php endif; ?>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</span>
								</p>
								<?php endif; ?>

								<div class="shareattendicon eventmoreshareicon margin-for-button">
									<!-- <a target="_blank" href="//<?php echo e($data['business_fb_link']); ?>" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a> -->

									<!-- <div class="fb-share-button" data-href="<?php echo e(url('/morebusiness?q=').$data['business_id']); ?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

									<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/morebusiness?q=').$data['business_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

									<!-- <a data-link="<?php echo e(url('/morebusiness?q=').$data['business_id']); ?>" data-document="<?php echo e($data['business_title']); ?>" href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a> -->

									<a href="mailto:?subject=Click the link&body=<?php echo e(url('/morebusiness?q=').$data['business_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

									<!-- <a target="_blank" href="//<?php echo e($data['business_twitter_link']); ?>" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a> -->

									<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url=<?php echo e(url('/morebusiness?q=').$data['business_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>
								</div>
								<?php if(FlagAsInappropriate::FlagAsInappropriateButtonCheck($data['business_id'],1) == true): ?>
									<button type="button" data-id = "<?php echo e($data['business_id']); ?>" class="btn favourite eventattendbtn flag_as_inappropriate_business"><span class="favourite-btn">Flag as Inappropriate</span></button>
								<?php endif; ?>
								<?php if(Auth::check() && Auth::user()->user_id == $data['created_by']): ?>
									<a href="<?php echo e(route('edit_business',['q'=> $data['business_id']])); ?>" class="btn favourite eventattendbtn flag_as_inappropriate_business more-business-btn-edit">Edit</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">

							<div class="col-md-12 owlcarouseldiv">
						<?php if(!empty($data['image'][0])): ?>
							<?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1): ?>
							<span style="display: none;" id="img-arr-count"><?php echo e(count($data['image'])); ?></span>
								<?php if(count($data['image']) > 1): ?>
									<div class="slickitem-1">
									<?php $__currentLoopData = $data['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="slick-slide">
											<img src="<?php echo e(url('/images/business/'.$image)); ?>" class="carousel-full-img">
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="slider-nav">
									<?php $__currentLoopData = $data['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="slick-slide">
											<img src="<?php echo e(url('/images/business/'.$image)); ?>">
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								<?php else: ?>
									<?php $__currentLoopData = $data['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="single-img-div">
											<img class="single-image" src="<?php echo e(url('/images/business/'.$image)); ?>">
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>

							<?php else: ?>

								<div class="single-img-div">
									<img class="single-image" src="<?php echo e(url('/images/placeholder.svg')); ?>">
								</div>

							<?php endif; ?>
						<?php else: ?>
							<div class="single-img-div">
								<img class="single-image" src="<?php echo e(url('/images/placeholder.svg')); ?>">
							</div>
						<?php endif; ?>

							</div>
							<div class="col-md-12 col-xs-12 mapdiv">
	  							<div class="googlemaping">
	  								<div id="maps" class="googlemap"></div>
	  							</div>
	  						</div>
						</div>
					</div>
				</div>
				<!--end event div
				<?php echo $__env->make('frontend.layouts.theme.right-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>
<div id="fb-root"></div>

<div id="city" style="display: none;"><?php echo e($data->getAddress()->first()->getCity()->first()->name); ?></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">
// fetch lat long
var city = $('#city').html();
	$(document).ready(function(){
	var full_address = $('#location').html();
	$.ajax({
			type: 'get',
			url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false&key=AIzaSyBlmxfYLHB9mW6gpPHLmSUMjq8JzMPi824",
			success: function(res){
				var lati = res.results[0].geometry.location.lat;
		    	var longi = res.results[0].geometry.location.lng;
				myMap(lati,longi);
			}
		});
});

/*for google map start*/
	function myMap(latitude = 51.508742,longitude = -0.120850) {
	  var myCenter = new google.maps.LatLng(latitude,longitude);
	  var mapCanvas = document.getElementById("maps");
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
	  arrows: false,
	  fade: true,
	  asNavFor: '.slider-nav',
	  autoplay: true,
	  infinite: true
	});
	$('.slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 3,
	  arrows: true,
	  dots: false,
	  centerMode: countslick(),
	  focusOnSelect: true,
	  asNavFor: '.slickitem-1',
	  autoplay: false
	});

   $('.see_more').hide();
	$('#see_more').on('click',function(){
		$('.see_more').toggle();
	});
});
/*end owl carousel*/
function countslick(){
	var count = $('#img-arr-count').html();
	console.log(count);
	if(count == 2) {
		return false;
	}
	else {
	  	return true;
	}
}
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

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
		    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+long+'&sensor=false&key=AIzaSyBlmxfYLHB9mW6gpPHLmSUMjq8JzMPi824',
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlmxfYLHB9mW6gpPHLmSUMjq8JzMPi824&libraries=places&callback=initAutocomplete"
         async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>