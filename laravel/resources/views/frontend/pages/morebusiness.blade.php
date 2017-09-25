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
								<p class="whoattending">Who's Attending?</p>
								@foreach( $data->getWhoAreAttending as $user)
									<span class="attendingmail">
									@if(isset($user->getUser->first_name))
										{{ $user->getUser->first_name }},
									@endif
									</span>
								@endforeach
								<p class="attendingmail dropseemore"><a href="#">See More <i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
								@endif
								<div class="attendtime">
									<p class="startattendtime">Start Date: {{ $data['business_start_date'] }}</p>
									<p>End Date: {{ $data['business_end_date'] }}</p>
								</div>
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress" id="location">{{ $data->getAddress->address_1 }},{{ $data->getAddress->address_2 }},{{ $data->getAddress->getCity->name}}</p>
								<p class="sharedcontactinfo">Hours:</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">July 25,2017</a></span> @ 7:30pm</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">July 26,2017</a></span> @ 7:30pm</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">July 27,2017</a></span> @ 7:30pm</p>

								@if(count($data['all_tags']) > 0)
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										@foreach($data['all_tags'] as $value)
											@if(count($value) > 0)
												<a href="#">{{ $value[0] }}</a>, 
											@endif
										@endforeach
									</span>
								</p>
								@endif

								<div class="shareattendicon eventmoreshareicon">
									<a target="_blank" href="{{ $data['business_fb_link'] }}" class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
									<a href="mailto:{{ $data['business_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
									<a target="_blank" href="{{ $data['business_twitter_link'] }}" class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<div class="col-md-12 owlcarouseldiv">

						@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)

							@if(count($data['image']) > 1)
								<div id="sync1" class="owl-carousel owl-theme">
								@foreach($data['image'] as $image)
									<div class="item">
										<img src="{{ url('/images/business/'.$image) }}">
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

							</div>
							<div class="col-md-12 col-xs-12 mapdiv">
	  							<div class="googlemaping">
	  								<div id="map" class="googlemap"></div>
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
			url:"http://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
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
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
  });
});
/*end owl carousel*/
</script>
@endsection