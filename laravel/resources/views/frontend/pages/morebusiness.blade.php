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
								<p class="attendaddress" id="location">{{ $data->getAddress->address_1 }},{{ $data->getAddress->address_2 }},{{ $data->getAddress->getCity->name}}</p>
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

								<div class="shareattendicon eventmoreshareicon">
									@if($data['business_fb_link'] != 'http://')
									<a target="_blank" href="//{{ $data['business_fb_link'] }}" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
									@endif
									<a href="mailto:{{ $data['business_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
									@if($data['business_twitter_link'] != 'http://')
									<a target="_blank" href="//{{ $data['business_twitter_link'] }}" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<div class="col-md-12 owlcarouseldiv">
						@if(!empty($data['image'][0]))
							@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)
								@if(count($data['image']) > 1)
									<div id="sync1" class="owl-carousel owl-theme">
									@foreach($data['image'] as $image)
										<div class="item">
											<img src="{{ url('/images/business/'.$image) }}" class="carousel-full-img">
										</div>
									@endforeach
									</div>
									<div id="sync2" class="owl-carousel owl-theme">
									@foreach($data['image'] as $image)
										<div class="item">
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

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  var slidesPerPage = 3; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: false,
    autoplay: true,
    dots: false,
    loop: true,
    // responsiveRefreshRate : 200,
  }).on('changed.owl.carousel', syncPosition);

  sync2
    .on('initialized.owl.carousel', function () {
      sync2.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
    items : slidesPerPage,
    dots: false,
    nav: true,
    smartSpeed: 200,
    slideSpeed : 500,
    loop:true,
    slideBy: slidesPerPage,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
     //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
    // responsiveRefreshRate : 100,
  }).on('changed.owl.carousel', syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();
    
    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  
  function syncPosition2(el) {
    if(syncedSecondary) {
      var number = el.item.index;
      // console.log(number);
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
  });

   $('.see_more').hide();
	$('#see_more').on('click',function(){
		$('.see_more').toggle();
	});
});
/*end owl carousel*/
</script>
@endsection