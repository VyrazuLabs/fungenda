<?php $__env->startSection('meta_tag'); ?>
	<meta property="og:description" content="<?php echo e($data['event_title']); ?>"/>
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
									<p class="customleftsharedivhead"><?php echo e($data['event_title']); ?></p>
									<h5 class="colors customleftsharedivsubtext">Listed in <a href="<?php echo e(route('frontend_category',['q'=> $data['category_id']])); ?>"><?php echo e($data->getCategory()->first()->name); ?></a></h5>

									<div class="shareattendingdiv">

										<span class="fav-btn-container">
											<?php if(!Favourite::check($data['event_id'], 2)): ?>
												<button type="button" data-id="<?php echo e($data['event_id']); ?>" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											<?php else: ?>
												<button type="button"  data-id="<?php echo e($data['event_id']); ?>" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											<?php endif; ?>
										</span>

									<?php if(IAmAttending::IAmAttendingButtonCheck($data['event_id'],2) == true): ?>
										<button data-id = "<?php echo e($data['event_id']); ?>" type="button" class="btn favourite eventattendbtn i_am_attending_event"><span class="favourite-btn"> I am Attending</span></button>
									<?php endif; ?>

									</div>
								</div>
								<?php if(count($data->getWhoAreAttending) > 0): ?>
								<?php 
									$counter = 1;
									$count = 0;
								 ?>
								<p class="whoattending">Who's Attending?</p>
								<?php $__currentLoopData = $data->getWhoAreAttending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
								<div class="attendtime">
								</div>
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress" id="location"><?php echo e($data->address_data); ?></p>
								<?php if(!empty($data['event_venue'])): ?>
									<p class="attendaddress"><span class="eventdatetime"><span>Venue: </span></span><?php echo e($data['event_venue']); ?></p>
								<?php endif; ?>
								<?php if(!empty($data['event_mobile'])): ?>
									<p class="attendaddress"><span class="eventdatetime"><span>Contact number: </span></span><?php echo e($data['event_mobile']); ?></p>
								<?php endif; ?>
								<?php if(!empty($data['event_email'])): ?>
									<p class="attendaddress"><span class="eventdatetime"><span>Email: </span></span>
										<a href="mailto:<?php echo e($data['event_email']); ?>"><?php echo e($data['event_email']); ?></a>
									</p>
								<?php endif; ?>
								<?php if(!empty($data['event_website'])): ?>
									<div class="attendtime">
										<p class="sharedcontactinfo pl-0">Website:</p>
										<?php if(strpos($data['event_website'], "http") === 0): ?>
											<p class="attendaddress p-0"><span ><a href="<?php echo e($data['event_website']); ?>" target="_blank"><?php echo e($data['event_website']); ?></a></span></p>
										<?php else: ?>
											<p class="attendaddress p-0"><span ><a href="//<?php echo e($data['event_website']); ?>" target="_blank"><?php echo e($data['event_website']); ?></a></span></p>
										<?php endif; ?>
									</div>
								<?php endif; ?>



								<?php if($data['recurring_status'] == 1): ?>
								<div class="attendtime">
									<p class="sharedcontactinfo pl-0">Daily Recurring : <?php  echo date("m/d/Y");  ?></p>
								</div>

								<?php elseif($data['recurring_status'] == 2): ?>
									<?php 
										$date1 = date_create($data['from_date']); // Event start date

										$date2 = date_create(date('Y-m-d')); // Todays date
										$diff = date_diff($date1, $date2);
										$check1 = $diff->days % 7;
										$get_next_date1 = 7 - $check1;

										// Get next event date
										date_add($date2, date_interval_create_from_date_string($get_next_date1 . " days"));
										$next_weekly_date = date_format($date2, "d/m/Y");
									 ?>
									<div class="attendtime">
										<p class="sharedcontactinfo pl-0">Weekly Recurring : <?php echo e($next_weekly_date); ?></p>
									</div>
								<?php elseif($data['recurring_status'] == 3): ?>
									<?php 
										$date1 = date_create($data['from_date']); // Event start date

										$date2 = date_create(date('Y-m-d')); // Todays date
										$diff = date_diff($date1, $date2);
										$check1 = $diff->days % 30;
										$get_next_date1 = 30 - $check1;

										// Get next event date
										date_add($date2, date_interval_create_from_date_string($get_next_date1 . " days"));
										$next_monthly_date = date_format($date2, "d/m/Y");
									 ?>
									<div class="attendtime">
										<p class="sharedcontactinfo pl-0">Monthly Recurring : <?php echo e($next_monthly_date); ?></p>
									</div>
								<?php endif; ?>
								<div class="attendtime">
									<p class="sharedcontactinfo pl-0">Hours:</p>
									<?php $__currentLoopData = $data['date_in_words']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<p class="attendaddress p-0"><span class="eventdatetime"><span><?php echo e($value['date']); ?></span></span> @ <?php echo e($value['start_time']); ?> to <?php echo e($value['end_time']); ?></p>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<div class="attendtime">
									<p class="sharedcontactinfo pl-0"></p>
									
										<?php if($data['event_offer']['discount_types'] == '1'): ?>
											<p class="attendaddress p-0"><span class="eventdatetime">Kid friendly</span></p>
										<?php endif; ?>
										<?php if($data['event_offer']['discount_types'] == '2'): ?>
											<p class="attendaddress p-0"><span class="eventdatetime">Pet friendly</span></p>
										<?php endif; ?>
										<?php if($data['event_offer']['discount_types'] == '1,2'): ?>
											<p class="attendaddress p-0"><span class="eventdatetime">kid and pet friendly</span></p>
										<?php endif; ?>
										<?php if($data['event_offer']['discount_types'] == 0 && empty($data['event_offer']['discount_rate'])): ?>
											<p class="attendaddress p-0"><span class="eventdatetime">No discount</span></p>
										<?php endif; ?>
									
								</div>
								<?php if(!empty($data['event_offer']['discount_rate'])): ?>
								<div class="attendtime">
									<p class="sharedcontactinfo pl-0">Discount</p>
										<p class="attendaddress p-0"><span class="eventdatetime"><?php echo e($data['event_offer']['discount_rate']); ?></span></p>
								</div>
								<?php endif; ?>
								<?php if(!empty($data['event_offer']['offer_description'])): ?>
									<div class="attendtime">
										<p class="sharedcontactinfo pl-0">Discount Offer Description:</p>
										<p class="attendaddress p-0"><span class="eventdatetime"><?php echo nl2br($data['event_offer']['offer_description']); ?></span></p>
									</div>
								<?php endif; ?>
								<div class="attendtime pl-0">
									<p class="sharedcontactinfo">Event Cost:</p>
									<?php if(!empty($data['event_cost'])): ?>
										<p class="attendtimedate"><span class="eventdatetime"><span></span></span><?php echo e($data['event_cost']); ?></p>
									<?php else: ?>
										<p class="attendtimedate"><span class="eventdatetime"><span>Free event</span></p>
									<?php endif; ?>
								</div>

								<p class="sharedcontactinfo">Description:</p>
								<p class="attendtimedate"><span class="eventdatetime"></span><?php echo nl2br($data['event_description']); ?></p>

								<?php if(!empty($data->all_tags)): ?>
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										<span class="listed_in_index"><?php echo e($data->all_tags); ?></span>
									</span>
								</p>
								<?php endif; ?>

								<div class="shareattendicon eventmoreshareicon margin-for-button">
									<!-- <a target="_blank" href="//<?php echo e($data['event_fb_link']); ?>" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a> -->

									<!-- <div class="fb-share-button" data-href="<?php echo e(url('/moreevent?q=').$data['event_id']); ?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

									<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/moreevent?q=').$data['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

									<a href="mailto:?subject=Click the link&body=<?php echo e(url('/moreevent?q=').$data['event_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

									<!-- <a target="_blank" href="//<?php echo e($data['event_twitter_link']); ?>" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a> -->

									<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url=<?php echo e(url('/moreevent?q=').$data['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>
								</div>

								<?php if(FlagAsInappropriate::FlagAsInappropriateButtonCheck($data['event_id'],2) == true): ?>
									<button data-id = "<?php echo e($data['event_id']); ?>" type="button" class="btn favourite eventattendbtn flag_as_inappropriate_event"><span class="favourite-btn">Flag as Inappropriate</span></button>
								<?php endif; ?>
								<?php if(Auth::check() && Auth::user()->user_id == $data['created_by']): ?>
									<a href="<?php echo e(route('edit_event',['q'=> $data['event_id']])); ?>" class="btn favourite eventattendbtn flag_as_inappropriate_business more-business-btn-edit">Edit</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">

							<div class="col-md-12 owlcarouseldiv">
						<?php if(!empty($data['image'][0])): ?>
							<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1): ?>
							<span style="display: none;" id="img-arr-count"><?php echo e(count($data['image'])); ?></span>
								<?php if(count($data['image']) > 1): ?>

									<div class="slickitem-1">
									<?php $__currentLoopData = $data['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="slick-slide">
											<img src="<?php echo e(url('/images/event/'.$image)); ?>" class="carousel-full-img">
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="slider-nav">
									<?php $__currentLoopData = $data['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="slick-slide">
											<img src="<?php echo e(url('/images/event/'.$image)); ?>">
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								<?php else: ?>

									<?php $__currentLoopData = $data['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="single-img-div">

											<img class="single-image" src="<?php echo e(url('/images/event/'.$image)); ?>">
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
				<!--end event div-->
				<?php echo $__env->make('frontend.layouts.theme.right-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>
<div id="fb-root"></div>
<?php 
$get_city = $data->getAddress()->first()->getCity()->first();
if(!empty($get_city)) {
	$get_city_name = $get_city->name;
}
else {
	$get_city_name = '';
}
 ?>
<div id="city" style="display: none;"><?php echo e($get_city_name); ?></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">

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

/*for slick carousel*/
$(document).ready(function() {
	// myMap();
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
	  asNavFor: '.slickitem-1',
	  focusOnSelect: true,
	  autoplay: false
	});
	$('.see_more').hide();
	$('#see_more').on('click',function(){
		$('.see_more').toggle();
	});
});
/*end slick carousel*/
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