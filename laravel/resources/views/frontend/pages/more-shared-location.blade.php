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
									<p class="customleftsharedivhead">{{ explode(',',$data['location_name'])[0] }}</p>
									
									<div class="shareattendingdiv">

										<span class="fav-btn-container" id="fav-btn-container">
											
											@if(!SharedLocationMyFavorite::check($data['shared_location_id']))
												<button type="button" data-id="{{ $data['shared_location_id'] }}" id="shared_location_fav_btn" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											@else
												<button type="button" data-id="{{ $data['shared_location_id'] }}" id="shared_location_rvm_fav_btn" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favourites</span></i></button>
											@endif											
										</span>
									</div>
								</div>
								<p id="location">{{ $data['location_name'] }}</p>
								@if(!empty($data['description']))
								<p>	
									<h3>Description</h3>
									{{ $data['description'] }}
								</p>
								@endif
								<p>
									@if(Auth::check() && Auth::user()->user_id == $data->user_id)
									<a href="{{ route('edit_shared_location',$data['shared_location_id']) }}" class="btn btn-success more-location-edit-btn">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>

									<a onclick="deleteFunction(this)" target="#" data-id = "{{ $data['shared_location_id']}}" class="btn btn-danger more-location-edit-btn more-location-delete-btn">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>

									<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ Auth::user()->email }}?subject=Click the link&body={{ url('/more_shared_location').'/'.$data['shared_location_id'] }}"><span class="fa fa-envelope"></span></a>
									@endif

									<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=bhjsbfsfjs','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

														
									<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url=dfadadad','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

								</p>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							@if(empty($data['images'][0]))
								<div class="col-md-12 owlcarouseldiv">
									<img src="{{ url('/images/placeholder.svg') }}">
								</div>
							@else
								@if(count($data['images']) == 1)
									<div class="col-md-12 owlcarouseldiv">
										<img src="{{ url('images/share_location/'.$data['images'][0]) }}" class="sharelocation-single-image">
									</div>
								@else
									<div class="col-md-12 owlcarouseldiv">
										<div class="slickitem-1">
											@foreach($data['images'] as $image)
											<div class="slick-slide">
												<img src="{{ url('images/share_location/'.$image) }}">
											</div>
											@endforeach
										</div>
										<div class="slider-nav">
											@foreach($data['images'] as $image)
											<div class="slick-slide">
												<img src="{{ url('images/share_location/'.$image) }}">
											</div>
											@endforeach
										</div>	
									</div>
								@endif
							@endif
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
<div id="city" style="display: none;"></div>
@endsection

@section('add-js')
<script type="text/javascript">

$(document).ready(function(){
	var full_address = $('#location').html();
	$.ajax({
			type: 'get',
			url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
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
	// myMap();
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
	$('.slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  arrows: true,
	  asNavFor: '.slickitem-1',
	  dots: false, 
	  focusOnSelect: true,
	});

	$('#shared_location_fav_btn').on('click',function(){
		var id = $(this).attr('data-id');
		$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ route('add_to_favourite_shared_location') }}",
				data: { 'id': id },
				success: function(data){
					console.log(data);

					var html = '<button type="button" id="shared_location_rvm_fav_btn"  data-id="' + id + '" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>';

					if(data.status == 1){
						$('#fav-btn-container').html(html);
						// specific.parent().html(_html);
					}
					if(data.status == 2){
						$('#myModal').modal('show');
					}

				}
			});
	});

	// Remove from favorite section
    	$(document).on('click','#shared_location_rvm_fav_btn',function(){
    		var id = $(this).attr('data-id');
    		$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ route('remove_to_favourite_shared_location') }}",
				data: { 'id': id },
				success: function(data){
					console.log(data);

					var html = '<button type="button" id="shared_location_fav_btn" data-id="' + id + '" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>';

					if(data.status == 1){
						$('#fav-btn-container').html(html);
					}
				}
			});
    	});

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
      window.location.href = "{{ url('/share-your-location/delete') }}"+"/"+id;
    })
  }
</script>

@endsection