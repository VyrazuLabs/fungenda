@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-md-12 maindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 leftcardshadow">
						<p class="shareyourlocation-heading">Share Your Location</p>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 create-locationform-div">
							<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 create-locationform-sub-div">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
								@if(isset($location_data))
									{{ Form::model($location_data,['method'=>'post', 'files'=>'true', 'url'=>'/share-your-location/update', 'class'=>"form-horizontal"]) }}
									<input type="hidden" name="id" value="{{ $location_data['shared_location_id'] }}">
								@else
									{{ Form::open(['url'=>'/share-your-location/save', 'method' => 'post', 'files'=>'true', 'class'=>"form-horizontal"]) }}
								@endif	
										<div class="form-group yourshare-group">
									    	<div class="col-sm-3 createlocation-error p-0"> 
									      	  {{ Form::label('given_name','Name',['class'=>'control-label']) }}
									      	</div>
									    	<div class="col-sm-7">
									      		{{ Form::text('given_name',null,['class'=>'form-control yourshare-box','id'=>'name','placeholder'=>'Enter your location name']) }}
									      		@if ($errors->has('given_name'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('given_name') }}</span>
				                                    </span>
				                                @endif
									    	</div>
									  	</div>
									    <div class="form-group yourshare-group">
									    	<div class="col-sm-3 createlocation-error p-0"> 
									      	  {{ Form::label('locationname','Location',['class'=>'control-label']) }}
									      	</div>
									    	<div class="col-sm-7">
									      		{{ Form::text('location_name',null,['class'=>'form-control yourshare-box','id'=>'venue','placeholder'=>'Enter location']) }}
									      		@if ($errors->has('location_name'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('location_name') }}</span>
				                                    </span>
				                                @endif
									    	</div>
									    	<div class="col-sm-2 locate-me-div">
									    		<div class="locate-me">
									                <!-- <a href="javascript:void(0)" onclick="getLocation()">
										                <span class="locate-me-icon icon-pointer"></span>
										                <span class="locate-me-text">Locate Me</span>
										            </a> -->
										            <a href="javascript:void(0)" class="locate-me-btn" id="locateMeBtn">
										                <span class="locate-me-icon icon-pointer"></span>
										                <span class="locate-me-text">Locate Me</span>
										            </a>
									            </div>
									    	</div>
									  	</div>
									  	@if(Auth::user())
									  	<div class="form-group radio-btn yourshare-group">
									  		<div class="col-sm-3 createlocation-desc-error p-0">
									  			{{ Form::label('privacy','Privacy',['class'=>'control-label shareyour-radio']) }}
									  		</div>
									  	@if(isset($location_data))
									  		<div class="col-sm-7">
									  		@if($location_data['status'] == 1)
												<label for="publicradio" class="custom-control custom-radio">
								  					{{ Form::radio('radio', 1 , true,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					{{ Form::radio('radio', 2 , false,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											@endif
											@if($location_data['status'] == 2)
												<label for="publicradio" class="custom-control custom-radio">
								  					{{ Form::radio('radio', 1 , false,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					{{ Form::radio('radio', 2 , true,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											@endif
											</div>
									  	@else
									  		<div class="col-sm-7">
												<label for="publicradio" class="custom-control custom-radio">
								  					{{ Form::radio('radio', 1 , true,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					{{ Form::radio('radio', 2 , false,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											</div>
										@endif
										</div>
										@else
										<div class="form-group radio-btn yourshare-group"  style="display:none;">
									  		<div class="col-sm-3 createlocation-desc-error p-0">
									  			{{ Form::label('privacy','Privacy',['class'=>'control-label shareyour-radio']) }}
									  		</div>
									  		<div class="col-sm-7">
												<label for="publicradio" class="custom-control custom-radio">
								  					{{ Form::radio('radio', 1 , true,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								  					<span class="custom-control-description">Public</span>
												</label>
												<label for="privateradio" class="custom-control custom-radio event-btn">
								  					{{ Form::radio('radio', 2 , false,['class'=>'custom-control-input']) }}
								  					<span class="custom-control-indicator"></span>
								 					<span class="custom-control-description">Private</span>
												</label>
											</div>
											
										</div>
										@endif	
										<!-- <div class="form-group yourshare-group">
											<div class="col-sm-4 createlocation-error p-0">
												<label for="countrydropdown" class=" control-label">Country</label> 
											</div>
											<div class="col-sm-8">
												{{ Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'form-control yourshare-box','placeholder'=>'--select--' ] ) }}
												@if ($errors->has('country'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('country') }}</span>
				                                    </span>
				                                @endif
											</div>
										</div> -->
										<div class="form-group yourshare-group">
											<div class="col-sm-3 createlocation-error p-0">
												<label for="countrydropdown" class="control-label">State</label> 
											</div>
											<div class="col-sm-7">

												{{ Form::select('state', [], null, ['class'=>'form-control yourshare-box searchState','id'=>'state']) }}


												<!-- <select id="state" class="form-control yourshare-box searchState" name="state">
		      									</select> -->
												@if ($errors->has('state'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('state') }}</span>
				                                    </span>
				                                @endif
											</div>
										</div>
										<div class="form-group yourshare-group">
											<div class="col-sm-3 createlocation-error p-0">
												<label for="countrydropdown" class=" control-label">City</label> 
											</div>
											<div class="col-sm-7">
											<!-- 	<select multiple="multiple" id="citydropdown" class="form-control yourshare-box" name="city">
													<option>2</option>
													<option>5</option>
													<option>44</option>
													<option>4</option>
		      									</select> -->
		      									{{ Form::select('city', [], null, ['class'=>'form-control yourshare-box','id'=>'citydropdown']) }}


											<!-- @if(isset($location_data['respected_city'])) -->
												<!-- {{ Form::select('city',$location_data['respected_city'], null,[ 'id' => 'citydropdown','class'=>'form-control yourshare-box','placeholder'=>'--select--' ] ) }} -->
												 
											<!-- @else
												{{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'form-control yourshare-box','placeholder'=>'--select--' ] ) }}
											@endif -->
												@if ($errors->has('city'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('city') }}</span>
				                                    </span>
				                                @endif
											</div>
										</div>
										<div class="form-group yourshare-group">
											<div class="col-sm-3 createlocation-desc-error p-0">
												<label for="description" class="control-label">Description</label> 
											</div>
											<div class="col-sm-7">
												{{ Form::textarea('description',null,['class'=>'form-control yourshare-box','row'=>'8']) }}
											</div>
										</div>
									  	<div class="col-lg-12 col-xs-12 p-0">
									  		<div class="col-lg-3 col-md-4 col-sm-4 col-4">
									  		</div>
									  		<div class="col-lg-7 col-md-8 col-sm-8 col-8 p-0">
									  			<div class="googlemaping createeventgooglemap">
						  							<div id="map" class="googlemap"></div>
						  						</div>
									  		</div>
										</div>
										<div class="col-lg-12 col-xs-12 form-group yourshare-group sarefileupload-group">
											<div class="col-sm-3 createlocation-desc-error p-0">
										    	<label for="inputfile" class="">Image</label>
										    </div>
										    <div class="col-sm-7">
										    	{{ Form::file('file[]', ['multiple' => 'multiple','id'=>'inputfile']) }}
										    	@if ($errors->has('file'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('file') }}</span>
				                                    </span>
				                                @endif
										    	<div id="inputfileimages"></div>
										    	@if(isset($location_data))
										    	<div class="share-location-imageshow-div">
										    		@foreach($location_data['images'] as $image)
										    		@if($image)
										    		<div class="show-image-div">
							                          <span>
							                            @if(file_exists(public_path().'/'.'images'.'/'.'share_location'.'/'.$image) == 1)
							                              <img class="edit_image_div" height="200" width="200" src="{{ url('/images/share_location'.'/'.$image) }}">
							                            @else
							                              <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event/placeholder.svg') }}">
							                            @endif
							                                <a href= "{{ route('shared_location_edit_image_delete',['shared_location_id'=> $location_data['shared_location_id'],'img_name'=>$image]) }}" class="edit-image-cross-location"><i class="fa fa-times cross-share-location" aria-hidden="true"></i></a>
							                          </span>
							                      	</div>
							                        @endif
										    		@endforeach
										    	</div>
										    @endif
										    </div>
										</div>
										<div class="col-lg-12 col-xs-12 form-group yourshare-group">
											<div class="col-sm-3"></div>
											<div class="col-sm-7 create-location-btn-div">
											@if(isset($location_data))
												{{ Form::Submit('Update Location Listing',['class'=>'btn share-locationlisting-btn']) }}
											@else
										    	{{ Form::Submit('Submit Location Listing',['class'=>'btn share-locationlisting-btn']) }}
										    @endif
										    </div>
										</div>
										{{ Form::hidden('cities',null,['id'=>'city_share_location']) }}
									{{ Form::close() }}
									<div id="latitude" style="display: none;"></div>
									<div id="longitude" style="display: none;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@include('frontend.layouts.theme.right-sidebar')
			</div>
		</div>
	</div>
</div>
@endsection
@section('add-js')
<script type="text/javascript"> 
      // $("#state").select2();
      $("#citydropdown").select2();
</script>

<script type="text/javascript">

//image upload start
	function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
	// files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="locationimagebox"><span class="imagesnames">'+escape(f.name)+'</span><a href="javascript:void(0)" class="locationimageboxcross" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('inputfileimages').innerHTML =  output.join('');
    console.log(output);
  }

  document.getElementById('inputfile').addEventListener('change', handleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
  }
//image upload end
$(document).ready(function(){
	$('#countrydropdown').on('change', function(){
		var value = $(this).val();
		// console.log(value);
		$.ajax({
			type: 'get',
			url: "{{ url('/fetch_state') }}",
			data: { data: value },
			success: function(data){
				// console.log(data);
				$('#state').empty();
				$.each(data,function(index, value){
					$('#state').append('<option value="'+ index +'">'+value+'</option>');
				});
			}
		});
	});

	$('#state').on('change', function() {
    	var value = $(this).val();
    	$.ajax({
    		type: 'get',
    		url: "{{ url('/fetch_country') }}",
    		data: { data: value },
    		success: function(data){
    			$('#citydropdown').empty();
    			$.each(data,function(index, value){
    				$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
    			});
    		}
    	});
	});




	/* state selection by searching */
	$('.searchState').select2({
		placeholder: "Search for state",
	  	ajax: {
			headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
	    	url: "{{ url('/state/search') }}",
			dataType: 'json', 
	  		type: 'POST',
			delay: 250,

			data: function (params) { 
				return { 
					state_name: params.term // search term 
				}; 
			}, 
			processResults: function (data, params) {
				params.page = params.page || 1; 
				return { 
					results: data // pagination: { // more: (params.page * 30) < data.total_count // } 

				}; 
			}, 
			cache: true
	  	},
	  	// placeholder: 'Search for a repository',
		escapeMarkup: function (markup) { 
		return markup; 
	},
	    minimumInputLength: 3,
	    templateResult: function (repo) { return repo.name },
	    templateSelection: function (repo) { return repo.name }
	});
	


	// $('#citydropdown').on('change',function(){
 //    	var country = $('#countrydropdown option:selected').text();
 //    	var state = $('#state option:selected').text();
 //    	var city = $('#citydropdown option:selected').text();
 //    	var full_address = country+','+state+','+city;
 //    	var longitude = $('#longitude').val();
 //    	var latitude = $('#latitude').val();
 //    	$.ajax({
	// 	  url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
	// 	  type: "POST",
	// 	  success:function(res){
	// 	    var lat = res.results[0].geometry.location.lat;
	// 	    var long = res.results[0].geometry.location.lng;
	// 	    var long_diff = Math.pow((longitude - long), 2);
	// 	    var lat_diff = Math.pow((latitude - lat), 2);
	// 	    var difference = Math.sqrt(long_diff + lat_diff);
	// 	    if(difference > 10){
	// 	    	new PNotify({
	//               title: 'Error',
	//               text: 'Venue and address should be within 10 km',
	//               type: 'error',
	//               buttons: {
	//                   sticker: false
	//               }
	//           	});
	//           	$("input[type=submit]").attr('disabled','disabled');
	// 	    }
	// 	    else{
	// 	    	$("input[type=submit]").removeAttr('disabled');
	// 	    }
	// 	  }
	// 	});
 //    });
});
</script>
<script>

// var showPositions = function(positions) {
// 	console.log('map not loading');
//     var lat = positions.coords.latitude;
//     var long = positions.coords.longitude;
//     console.log(lat);
//     console.log(long);
//     $.ajax({

// 		    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+long+'&sensor=false',
// 		    success: function(data){
// 		    	// console.log(data);
// 		    	var address = data['results'][0]['formatted_address'];
// 		    	console.log(address);
// 		    	// $('#venue').val(address);
// 		   },
// 		});
    
// }

// var errorCallback = function(error){
// 	console.log('error');
// 	console.log(error);
//     var errorMessage = 'Unknown error';
//     switch(error.code) {
//       case 1:
//         errorMessage = 'Permission denied';
//         break;
//       case 2:
//         errorMessage = 'Position unavailable';
//         break;
//       case 3:
//         errorMessage = 'Timeout';
//         break;
//     }
//     alert(errorMessage);
// };

// var options = {
//     enableHighAccuracy: true,
//     timeout: 3000,
//     maximumAge: 0
// };

// function getLocation() {
// 	initMap();
//     // if (navigator.geolocation) {
//     // 	console.log(navigator.geolocation);
//     // 	console.log('test');
//     //     navigator.geolocation.getCurrentPosition(showPositions,errorCallback,options);
//     // } else { 
//     //    console.log("Geolocation is not supported by this browser.");
//     // }
// }

// Location function

function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: -33.8688, lng: 151.2195},
	  zoom: 17
	});

	var input = document.getElementById('venue');

	var autocomplete = new google.maps.places.Autocomplete(input);

	// Bind the map's bounds (viewport) property to the autocomplete object,
	// so that the autocomplete requests use the current map bounds for the
	// bounds option in the request.
	autocomplete.bindTo('bounds', map);

	var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

	autocomplete.addListener('place_changed', function() {
	  marker.setVisible(false);
	  var place = autocomplete.getPlace();
	  if (!place.geometry) {
	    // User entered the name of a Place that was not suggested and
	    // pressed the Enter key, or the Place Details request failed.
	    window.alert("No details available for input: '" + place.name + "'");
	    return;
	  }

	  // If the place has a geometry, then present it on a map.
	  if (place.geometry.viewport) {
	    map.fitBounds(place.geometry.viewport);
	  } else {
	    map.setCenter(place.geometry.location);
	    map.setZoom(17);  // Why 17? Because it looks good.
	  }
	  marker.setPosition(place.geometry.location);
	  marker.setVisible(true);
	});

	document.getElementById('locateMeBtn').addEventListener('click', function() {
      locateMe(map);
    });
}

function locateMe(map) {
	var geocoder = new google.maps.Geocoder;
	var infoWindow = new google.maps.InfoWindow;

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    var pos = {
	      lat: position.coords.latitude,
	      lng: position.coords.longitude
	    };

	    var markers = [];

	    var marker = new google.maps.Marker({
		    position: pos,
		    map: map
		});
	    map.setCenter(pos);
	    console.log(pos);
	    geocodeLatLng(geocoder, map, pos);
	  }, function() {
	    handleLocationError(true, infoWindow, map.getCenter());
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleLocationError(false, infoWindow, map.getCenter());
	}
}

function geocodeLatLng(geocoder, map, pos) {
	geocoder.geocode({'location': pos}, function(results, status) {
	  if (status === 'OK') {
	    if (results[0]) {
	      $('#venue').val(results[0].formatted_address);
	    } else {
	      window.alert('No results found');
	    }
	  } else {
	    window.alert('Geocoder failed due to: ' + status);
	  }
	});
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
	                      'Error: The Geolocation service failed.' :
	                      'Error: Your browser doesn\'t support geolocation.');
	infoWindow.open(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHZpcyDU3JbFSCUDIEN59Apxj4EqDomI&libraries=places&callback=initMap"
         async defer></script>
@endsection