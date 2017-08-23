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
										<button type="button" class="btn favourite eventcustomsharedbtn"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
										<button type="button" class="btn favourite eventattendbtn"><span class="favourite-btn"> I am Attending</span></button>
									</div>
								</div>
								<p class="whoattending">Who's Attending?</p>
								<p class="attendingmail">tammiebayen@gmail.com,trudy</p>
								<p class="attendingmail">allanturner@gmail.com,allan</p>
								<p class="attendingmail">samwilson@gmail.com,sam</p>
								<p class="attendingmail">samwilson@gmail.com,sam</p>
								<p class="attendingmail dropseemore"><a href="#">See More <i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
								<div class="attendtime">
									<p class="startattendtime">Start Date: {{ $data['start_date'][0] }}</p>
									<p>End Date: {{ $data['end_date'][0] }}</p>
								</div>
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress">{{ $data->getAddress()->first()->address_1 }},{{ $data->getAddress()->first()->address_2 }},{{ $data->getAddress()->first()->getCity()->first()->name}}</p>
								<p class="sharedcontactinfo">Hours:</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">{{ $data['date_in_words'] }}</a></span> @ {{ $data['event_start_time'] }}</p>
								
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
									@if(count($data['all_tags']) > 0)
										@foreach($data->all_tags as $value)
											<a href="#">{{ $value[0] }}</a>, 
										@endforeach
									@endif
									</span>
								</p>
								<div class="shareattendicon eventmoreshareicon">
									<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
									<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
									<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<div class="col-md-12 owlcarouseldiv">
								<div id="sync1" class="owl-carousel owl-theme">
								@foreach($data['image'] as $image)
									<div class="item">
										<img src="{{ url('/images/event/'.$image) }}">
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
	$.ajax({
			type: 'get',
			url: "{{ url('/get_longitude_latitude') }}",
			data: { data: city},
			success: function(data){
				var longitude = data.longitude;
				var latitude = data.latitude;
				$('#latitude').val(latitude);
				$('#longitude').val(longitude);
				myMap(latitude,longitude);
			}
		});
/*for google map start*/
	function myMap(latitude = 51.508742,longitude = -0.120850) {
	  var myCenter = new google.maps.LatLng(latitude,longitude);
	  var mapCanvas = document.getElementById("map");
	  var mapOptions = {center: myCenter, zoom: 5};
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
});
/*end owl carousel*/
</script>
@endsection