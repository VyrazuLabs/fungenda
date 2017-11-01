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
									<p class="customleftsharedivhead">{{ $data['event_title'] }}</p>
									<h5 class="colors customleftsharedivsubtext">Listed in <a href="{{ route('frontend_category',['q'=> $data['category_id']]) }}">{{ $data->getCategory()->first()->name }}</a></h5>
									
									<div class="shareattendingdiv">

										<span class="fav-btn-container">
											@if(!Favourite::check($data['event_id'], 2))
												<button type="button" data-id="{{ $data['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											@else
												<button type="button"  data-id="{{ $data['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											@endif												
										</span>

									@if(IAmAttending::IAmAttendingButtonCheck($data['event_id'],2) == true)
										<button data-id = "{{ $data['event_id'] }}" type="button" class="btn favourite eventattendbtn i_am_attending_event"><span class="favourite-btn"> I am Attending</span></button>
									@endif

									</div>
								</div>
								@if(count($data->getWhoAreAttending) > 0)
								@php
									$counter = 1;
								@endphp
								<p class="whoattending">Who's Attending?</p>
								@foreach( $data->getWhoAreAttending as $user)
									@if($counter <= 4)
										<span class="attendingmail">
											@if(isset($user->getUser->first_name))
												{{ $user->getUser->first_name }},
											@endif
										</span>
									@else
										<span class="attendingmail see_more">
											@if(isset($user->getUser->first_name))
												{{ $user->getUser->first_name }}
												@if($key == 3)

												@else
													,
												@endif
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
								<div class="attendtime">
									<p class="startattendtime">Start Date: {{ implode(', ',explode(',',$data['start_date'][0])) }}</p>
									<p>End Date: {{ implode(', ',explode(',',$data['end_date'][0])) }}</p>
								</div>
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress" id="location">{{ $data->getAddress()->first()->address_1 }},{{ $data->getAddress()->first()->address_2 }},{{ $data->getAddress()->first()->getCity()->first()->name}}</p>
								<p class="sharedcontactinfo">Hours:</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">{{ $data['date_in_words'] }}</a></span> @ {{ $data['event_start_time'] }}</p>

								@if(count($data['all_tags']) > 0)
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										@foreach($data->all_tags as $key => $value)
											@if(count($value) > 0)
												<a href="#">{{ $value[0] }}</a>
												@if($key == count($data['all_tags'])-1)
													
												@else
													,
												@endif 
											@endif
										@endforeach
									</span>
								</p>
								@endif

								<div class="shareattendicon eventmoreshareicon">
									@if(!empty($data['event_fb_link']))
									<a target="_blank" href="//{{ $data['event_fb_link'] }}" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
									@endif
									<a href="mailto:{{ $data['event_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
									@if(!empty($data['event_twitter_link']))
									<a target="_blank" href="//{{ $data['event_twitter_link'] }}" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<div class="col-md-12 owlcarouseldiv">
						@if(!empty($data['image'][0]))
							@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)

								@if(count($data['image']) > 1)
								
									<div id="sync1" class="owl-carousel owl-theme">
									@foreach($data['image'] as $image)
										<div class="item">
											<img src="{{ url('/images/event/'.$image) }}" class="carousel-full-img">
										</div>
									@endforeach
									</div>
									<div id="sync2" class="owl-carousel owl-theme">
									@foreach($data['image'] as $image)
										<div class="item">
											<img src="{{ url('/images/event/'.$image) }}">
										</div>
									@endforeach
									</div>	
								@else

									@foreach($data['image'] as $image)
										<div class="single-img-div">
											
											<img class="single-image" src="{{ url('/images/event/'.$image) }}">
										</div>
									@endforeach
								@endif

							@else
								<div class="single-img-div">
									<img class="single-image" src="{{ url('/images/event/placeholder.svg') }}">	
								</div>

							@endif
						@else
							<div class="single-img-div">
									<img class="single-image" src="{{ url('/images/event/placeholder.svg') }}">	
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
<div id="city" style="display: none;">{{ $data->getAddress()->first()->getCity()->first()->name}}</div>
@endsection

@section('add-js')
<script type="text/javascript">

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
	myMap();
  var sync1 = $('#sync1'),
	sync2 = $('#sync2'),
	duration = 300,
	thumbs = 3;
	// Start Carousel
	sync1.owlCarousel({
	    center : true,
	    loop : true,
	    items : 1,
	    margin:0,
	    nav : false,
	    dots: false,
	});
	sync2.owlCarousel({
	    loop : true,
	    items : thumbs,
	    margin:10,
	    autoplay: true,
	    autoPlaySpeed: 3000,
	    dots: false,
	    nav : true,
	    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
	});
	sync2.on('click', '.owl-item', function() {
	    var i = $(this).index()-(thumbs);
	    sync2.trigger('to.owl.carousel', [i, duration, true]);
	    sync1.trigger('to.owl.carousel', [i, duration, true]);
	}).on('change.owl.carousel', function(event) {
	  if (event.namespace && event.property.name === 'position') {
	    var target = event.relatedTarget.relative(event.property.value, true);
	    sync1.owlCarousel('to', target, 300, true);
	  };
	});

	$('.see_more').hide();
	$('#see_more').on('click',function(){
		$('.see_more').toggle();
	});
});
/*end owl carousel*/
</script>
@endsection