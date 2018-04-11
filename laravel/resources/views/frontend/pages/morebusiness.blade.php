@section('meta_tag')
	<meta property="og:description" content="{{ $data['business_title'] }}"/>
@endsection
@extends('frontend.layouts.main.master')
@section('content')
<div class="col-md-12 sharedlocationmaindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 col-xs-12 leftcardshadow shareditemdiv">
						<div class="col-md-6 col-sm-6 col-xs-12 customleftsharediv">
							<div class="col-md-12 col-xs-12">
								<div class="sharenewtextbtndiv">
									<p class="customleftsharedivhead">{{ $data['business_title'] }}</p>
									<h5 class="colors customleftsharedivsubtext">Listed in <a href="{{ route('frontend_category',['q'=> $data['category_id']]) }}">{{ $data->getCategory()->first()->name }}</a></h5>
									
									<div class="shareattendingdiv ">
										<span class="fav-btn-container">
											@if(!Favourite::check($data['business_id'], 1))
												<button type="button" data-id="{{ $data['business_id'] }}" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											@else
												<button type="button" data-id="{{ $data['business_id'] }}" class="btn favourite rvm_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											@endif
										</span>

									@if(IAmAttending::IAmAttendingButtonCheck($data['business_id'],1) == true)
										<button type="button" data-id = "{{ $data['business_id'] }}" class="btn favourite eventattendbtn i_am_attending_business"><span class="favourite-btn"> I am Attending</span></button>
									@endif
										
									</div>
								</div>
								@if(count($data->getWhoAreAttending) > 0)
								@php
									$counter = 1;
									$count = 0;
								@endphp
								<p class="whoattending">Who's Attending?</p>
								@foreach( $data->getWhoAreAttending as $key => $user)
									@if($counter <= 4)
										<span class="attendingmail">
											@php
												$count++;
											@endphp
											@if(isset($user->getUser->first_name))
												{{ $user->getUser->first_name }}{{ $count != count($data->getWhoAreAttending) ? ',' : '' }}
											@endif
										</span>
									@else
										<span class="attendingmail see_more">
											@php
												$count++;
											@endphp
											@if(isset($user->getUser->first_name))
												{{$user->getUser->first_name}}{{$count != count($data->getWhoAreAttending) ? ',' : ''}}
											@endif
										</span>
									@endif
									@if($counter == 4)
										<br>
									@endif
									@php
										$counter++;
									@endphp
								@endforeach
									@if($counter > 4)
										<p class="attendingmail dropseemore"><a id="see_more" href="JavaScript:Void(0)">See More <i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
									@endif
								@endif
								
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress" id="location">{{ $data->business_venue }}</p>
								<p class="sharedcontactinfo">Hours:</p>
								@if(!empty(explode(',',$data['business_hours']['monday_start'])[0]))
									<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">Monday</span></span> @ {{ explode(',',$data['business_hours']['monday_start'])[0] }}
									@if(explode(',',$data['business_hours']['monday_start'])[1] == 0)
										am
									@endif 
									@if(explode(',',$data['business_hours']['monday_start'])[1] == 1)
										pm
									@endif
									</p>
								@endif
								@if(!empty(explode(',',$data['business_hours']['tuesday_start'])[0]))
									<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">Tuesday</span></span> @ {{ explode(',',$data['business_hours']['tuesday_start'])[0] }}
									@if(explode(',',$data['business_hours']['tuesday_start'])[1] == 0)
										am
									@endif 
									@if(explode(',',$data['business_hours']['tuesday_start'])[1] == 1)
										pm
									@endif
									</p>
								@endif
								@if(!empty(explode(',',$data['business_hours']['wednesday_start'])[0]))
									<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">Wednesday</span></span> @ {{ explode(',',$data['business_hours']['wednesday_start'])[0] }}
									@if(explode(',',$data['business_hours']['wednesday_start'])[1] == 0)
										am
									@endif 
									@if(explode(',',$data['business_hours']['wednesday_start'])[1] == 1)
										pm
									@endif
									</p>
								@endif
								@if(!empty(explode(',',$data['business_hours']['thursday_start'])[0]))
									<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">Thursday</span></span> @ {{ explode(',',$data['business_hours']['thursday_start'])[0] }}
									@if(explode(',',$data['business_hours']['thursday_start'])[1] == 0)
										am
									@endif 
									@if(explode(',',$data['business_hours']['thursday_start'])[1] == 1)
										pm
									@endif
									</p>
								@endif
								@if(!empty(explode(',',$data['business_hours']['friday_start'])[0]))
									<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">Friday</span></span> @ {{ explode(',',$data['business_hours']['friday_start'])[0] }}
									@if(explode(',',$data['business_hours']['friday_start'])[1] == 0)
										am
									@endif 
									@if(explode(',',$data['business_hours']['friday_start'])[1] == 1)
										pm
									@endif
									</p>
								@endif

								<p class="sharedcontactinfo">Business Cost:</p>
								<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">$</span></span>{{ $data['business_cost'] }}</p>

								<p class="sharedcontactinfo">Description:</p>
								<p class="attendtimedate"><span class="eventdatetime"></span>{{ $data['business_description'] }}</p>


								@if(!empty(explode(',',$data['business_hours']['saturday_start'])[0]))
									<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">Saturday</span></span> @ {{ explode(',',$data['business_hours']['saturday_start'])[0] }}
									@if(explode(',',$data['business_hours']['saturday_start'])[1] == 0)
										am
									@endif 
									@if(explode(',',$data['business_hours']['saturday_start'])[1] == 1)
										pm
									@endif
									</p>
								@endif
								@if(count($data['all_tags']) > 0)
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										@foreach($data['all_tags'] as $key => $value)
											@if(count($value) > 0)
												<span class="listed_in_index">{{ $value[0] }}</span>
												@if($key == count($data['all_tags'])-1)
													
												@else
													,
												@endif
											@endif
										@endforeach
									</span>
								</p>
								@endif

								<div class="shareattendicon eventmoreshareicon margin-for-button">
									<!-- <a target="_blank" href="//{{ $data['business_fb_link'] }}" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a> -->

									<!-- <div class="fb-share-button" data-href="{{ url('/morebusiness?q=').$data['business_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

									<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/morebusiness?q=').$data['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

									<!-- <a data-link="{{ url('/morebusiness?q=').$data['business_id'] }}" data-document="{{ $data['business_title'] }}" href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a> -->

									<a href="mailto:{{ $data['business_email'] }}?subject=Click the link&body={{ url('/morebusiness?q=').$data['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

									<!-- <a target="_blank" href="//{{ $data['business_twitter_link'] }}" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a> -->

									<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url={{ url('/morebusiness?q=').$data['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>
								</div>
								@if(FlagAsInappropriate::FlagAsInappropriateButtonCheck($data['business_id'],1) == true)
									<button type="button" data-id = "{{ $data['business_id'] }}" class="btn favourite eventattendbtn flag_as_inappropriate_business"><span class="favourite-btn">Flag as Inappropriate</span></button>
								@endif
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">

							<div class="col-md-12 owlcarouseldiv">
						@if(!empty($data['image'][0]))
							@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)
							<span style="display: none;" id="img-arr-count">{{ count($data['image']) }}</span>
								@if(count($data['image']) > 1)
									<div class="slickitem-1">
									@foreach($data['image'] as $image)
										<div class="slick-slide">
											<img src="{{ url('/images/business/'.$image) }}" class="carousel-full-img">
										</div>
									@endforeach
									</div>
									<div class="slider-nav">
									@foreach($data['image'] as $image)
										<div class="slick-slide">
											<img src="{{ url('/images/business/'.$image) }}">
										</div>
									@endforeach
									</div>
								@else
									@foreach($data['image'] as $image)
										<div class="single-img-div">
											<img class="single-image" src="{{ url('/images/business/'.$image) }}">
										</div>
									@endforeach
								@endif

							@else

								<div class="single-img-div">
									<img class="single-image" src="{{ url('/images/business/placeholder.svg') }}">	
								</div>

							@endif
						@else
							<div class="single-img-div">
								<img class="single-image" src="{{ url('/images/business/placeholder.svg') }}">	
							</div>
						@endif

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
				@include('frontend.layouts.theme.right-sidebar')
			</div>	
		</div>
	</div>
</div>
<div id="fb-root"></div>

<div id="city" style="display: none;">{{ $data->getAddress()->first()->getCity()->first()->name}}</div>
@endsection

@section('add-js')
<script type="text/javascript">
// fetch lat long
var city = $('#city').html();	
	$(document).ready(function(){
	var full_address = $('#location').html();
	$.ajax({
			type: 'get',
			url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlmxfYLHB9mW6gpPHLmSUMjq8JzMPi824&libraries=places&callback=initAutocomplete"
         async defer></script>
@endsection