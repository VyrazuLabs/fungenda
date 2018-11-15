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
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 create-locationform-sub-div">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									{{ Form::open(['url'=>'/share-your-location/save', 'method' => 'post', 'files'=>'true', 'class'=>"form-horizontal"]) }}
									    <div class="form-group yourshare-group">
									    	<div class="col-sm-4 createlocation-error p-0">
									      	  {{ Form::label('locationname','Location',['class'=>'control-label']) }}
									      	</div>
									    	<div class="col-sm-8">
									      		{{ Form::text('location_name',null,['class'=>'form-control yourshare-box','id'=>'venue','placeholder'=>'Enter Name']) }}
									      		@if ($errors->has('location_name'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('location_name') }}</span>
				                                    </span>
				                                @endif
									    	</div>
									  	</div>
									  	<div class="form-group radio-btn yourshare-group"  style="display:none;">
									  		<div class="col-sm-4 createlocation-desc-error p-0">
									  			{{ Form::label('privacy','Privacy',['class'=>'control-label shareyour-radio']) }}
									  		</div>
									  		<div class="col-sm-8">
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
										<div class="form-group yourshare-group">
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
										</div>
										<div class="form-group yourshare-group">
											<div class="col-sm-4 createlocation-error p-0">
												<label for="countrydropdown" class="control-label">State</label>
											</div>
											<div class="col-sm-8">
												{{ Form::select('state',[], null,[ 'id' => 'state','class'=>'form-control yourshare-box','placeholder'=>'--select--' ] ) }}
												@if ($errors->has('state'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('state') }}</span>
				                                    </span>
				                                @endif
											</div>
										</div>
										<div class="form-group yourshare-group">
											<div class="col-sm-4 createlocation-error p-0">
												<label for="countrydropdown" class=" control-label">City</label>
											</div>
											<div class="col-sm-8">
												{{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'form-control yourshare-box','placeholder'=>'--select--' ] ) }}
												@if ($errors->has('city'))
				                                    <span class="help-block">
				                                        <span class="signup-error">{{ $errors->first('city') }}</span>
				                                    </span>
				                                @endif
											</div>
										</div>
										<div class="form-group yourshare-group">
											<div class="col-sm-4 createlocation-desc-error p-0">
												<label for="description" class="control-label">Description</label>
											</div>
											<div class="col-sm-8">
												{{ Form::textarea('description',null,['class'=>'form-control yourshare-box','row'=>'8']) }}
											</div>
										</div>
									  	<div class="col-lg-12 col-xs-12 p-0">
									  		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
									  		</div>
									  		<div class="col-lg-8 col-md-8 col-sm-8 col-8 p-0">
									  			<div class="googlemaping createeventgooglemap">
						  							<div id="map" class="googlemap"></div>
						  						</div>
									  		</div>
										</div>
										<div class="col-lg-12 col-xs-12 form-group yourshare-group sarefileupload-group">
											<div class="col-sm-4 createlocation-desc-error p-0">
										    	<label for="inputfile" class="">File input</label>
										    </div>
										    <div class="col-sm-8">
										    	{{ Form::file('file[]', ['multiple' => 'multiple','id'=>'inputfile']) }}
										    	<div id="inputfileimages"></div>
										    </div>
										</div>
										<div class="col-lg-12 col-xs-12 form-group yourshare-group">
											<div class="col-sm-4"></div>
											<div class="col-sm-8 create-location-btn-div">
										    	{{ Form::Submit('Submit Location Listing',['class'=>'btn share-locationlisting-btn']) }}
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
    			console.log(data);
    			$('#citydropdown').empty();
    			$.each(data,function(index, value){
    				$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
    				console.log(value);
    			});
    		}
    	});
	});

	$('#citydropdown').on('change',function(){
    	var country = $('#countrydropdown option:selected').text();
    	var state = $('#state option:selected').text();
    	var city = $('#citydropdown option:selected').text();
    	var full_address = country+','+state+','+city;
    	var longitude = $('#longitude').val();
    	var latitude = $('#latitude').val();
    	$.ajax({
		  url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
		  type: "POST",
		  success:function(res){
		    var lat = res.results[0].geometry.location.lat;
		    var long = res.results[0].geometry.location.lng;
		    var long_diff = Math.pow((longitude - long), 2);
		    var lat_diff = Math.pow((latitude - lat), 2);
		    var difference = Math.sqrt(long_diff + lat_diff);
		    if(difference > 10){
		    	new PNotify({
	              title: 'Error',
	              text: 'Venue and address should be within 10 km',
	              type: 'error',
	              buttons: {
	                  sticker: false
	              }
	          	});
	          	$("input[type=submit]").attr('disabled','disabled');
		    }
		    else{
		    	$("input[type=submit]").removeAttr('disabled');
		    }
		  }
		});
    });
});
</script>
@endsection
