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
									$count = 0;
								@endphp
								<p class="whoattending">Who's Attending?</p>
								@foreach( $data->getWhoAreAttending as $user)
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
								<div class="attendtime">
									<p class="startattendtime">Start Date: {{ date('d-m-Y',strtotime(implode(', ',explode(',',$data['start_date'][0])))) }}</p>
									<p>End Date: {{ date('d-m-Y',strtotime(implode(', ',explode(',',$data['end_date'][0])))) }}</p>
								</div>
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress" id="location">{{ $data->getAddress()->first()->address_1 }},{{ $data->getAddress()->first()->address_2 }},{{ $data->getAddress()->first()->getCity()->first()->name}}</p>
								<p class="sharedcontactinfo">Hours:</p>
								<p class="attendtimedate"><span class="eventdatetime"><span class="listed_in_index">{{ $data['date_in_words'] }}</span></span> @ {{ explode(',',$data['event_start_time'])[0] }}</p>

								@if(count($data['all_tags']) > 0)
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										@foreach($data->all_tags as $key => $value)
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

								<div class="shareattendicon eventmoreshareicon">
									<!-- <a target="_blank" href="//{{ $data['event_fb_link'] }}" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a> -->

									<!-- <div class="fb-share-button" data-href="{{ url('/moreevent?q=').$data['event_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

									<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$data['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

									<a href="mailto:{{ $data['event_email'] }}?subject=Click the link&body={{ url('/moreevent?q=').$data['event_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

									<!-- <a target="_blank" href="//{{ $data['event_twitter_link'] }}" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a> -->

									<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url={{ url('/moreevent?q=').$data['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<div class="col-md-12 owlcarouseldiv">
						@if(!empty($data['image'][0]))
							@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)

								@if(count($data['image']) > 1)
								
									<div class="slickitem-1">
									@foreach($data['image'] as $image)
										<div class="slick-slide">
											<img src="{{ url('/images/event/'.$image) }}" class="carousel-full-img">
										</div>
									@endforeach
									</div>
									<div class="slider-nav">
									@foreach($data['image'] as $image)
										<div class="slick-slide">
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
<div id="fb-root"></div>

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

/*for slick carousel*/
$(document).ready(function() {
	myMap();
	$('.slickitem-1').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
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
		

	$('.see_more').hide();
	$('#see_more').on('click',function(){
		$('.see_more').toggle();
	});
});
/*end slick carousel*/
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
@endsection