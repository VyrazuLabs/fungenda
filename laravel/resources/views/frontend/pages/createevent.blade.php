@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">
			<p class="profile text-left">Create Event:</p>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard">
				<div class="text-center profileform">
				 	{!! Form::open(['url' => '/save-events', 'method' => 'post', 'files'=>'true']) !!}
				 		{{ csrf_field() }}
				 		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('eventname','EVENT NAME') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('name',null,['id'=>'eventname','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Name']) }}
		      				@if ($errors->has('name'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('category','CATEGORY') }}
		      				<span class="require-star"></span>
		      				<div class="categoryselect">
							{{ Form::select('category',$all_category1, null,['class'=>'form-control categorydropdown' ] ) }}
							@if ($errors->has('category'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('category') }}</span>
                                    </span>
                                @endif
						</div>
						
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                {{ Form::label('tags','TAGS') }}
                <div class="categoryselect">
                  {{ Form::select('tags[]',$all_tag, null,[ 'multiple'=>'multiple','class'=>'tagdropdown form-control add-tag categorydropdown' ]) }}
                </div>
              </div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
			      			<label for="image">IMAGE</label>
			      			<span class="require-star"></span>
			      			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventimagediv">	
			      				<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 eventtextboxdiv">
				      				<div id="uploadfile" class="upload-file-container" >
				      					<span id="uploadfile" class="businessselectfile"></span>
				      				</div>
								</div>
			      				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
									<button type="button" class="btn btn-secondary browsebtn">Browse</button>
			      					{{ Form::file('file[]', ['multiple' => 'multiple','id'=>'files','class'=>'eventbrowsefile']) }}
			      					<output id="list"></output>
			      					@if ($errors->has('file'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('file') }}</span>
                                    </span>
                                @endif
			      				</div>
			      				
							</div>
						</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				{{ Form::label('eventcost','EVENT COST') }}
				      				<span class="require-star"></span>
				      				{{ Form::text('costevent',null,['id'=>'eventcost','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Amount']) }}
				      				@if ($errors->has('costevent'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('costevent') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			{{ Form::label('discount','DISCOUNT(IF AVAILABLE)') }}
				      				{{ Form::text('eventdiscount',null,['id'=>'discount','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Discount Rate']) }}
				      				@if ($errors->has('eventdiscount'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('eventdiscount') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup checkboxdivcreate">
						    {{ Form::label('createeventcheckbox','DISCOUNT AS') }}	
						    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
									
										<div class="form-group checkboxlist createventcheckboxlst">
											{{ Form::checkbox('checkbox',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
											<span></span>
										    {{ Form::label('kidfriendly','Kid Friendly') }}
										</div>
										<div class="form-group checkboxlist createventcheckboxlst">
										    {{ Form::checkbox('checkbox',2,null,['class' => 'signincheckbox','id'=>'petfriendly']) }}
										    <span></span>
										    {{ Form::label('petfriendly','Pet Friendly') }}
										</div>
									
			    				</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('description','ENTER BRIEF DESCRIPTION OF DISCOUNT') }}
		      				{{ Form::textarea('comment', null, ['size' => '64x7','placeholder'=>'Enter Description of Discount','class'=>'createeventtextarea']) }}
		      				@if ($errors->has('comment'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('comment') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				{{ Form::label('startdate','START DATE') }}
				      				<span class="require-star"></span>
				      				{{ Form::text('startdate',null,['id'=>'datestart','class'=>'form-control profileinput createeventinput datetimecalender','placeholder'=>'Select Date']) }}
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<img src="{{ url('images/calenderpic.png') }}" class="img-responsive createcalender">
				      				@if ($errors->has('startdate'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('startdate') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			<label for="starttime">START TIME</label>
					      			{{ Form::label('starttime','START TIME') }}
					      			<span class="require-star"></span>
				      				{{ Form::text('starttime',null,['id'=>'timestart','class'=>'form-control profileinput createeventinput eventstarttime','placeholder'=>'Select Time']) }}
									<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
				      				@if ($errors->has('starttime'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('starttime') }}</span>
                                    </span>
                                @endif
					      		</div>
					      		
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				<label for="enddate">END DATE</label>
				      				{{ Form::label('enddate','END DATE') }}
				      				<span class="require-star"></span>
				      				{{ Form::text('enddate',null,['id'=>'dateend','class'=>'form-control profileinput createeventinput datetimecalender','placeholder'=>'Select Date']) }}
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<img src="{{ url('images/calenderpic.png') }}" class="img-responsive createcalender">
				      				@if ($errors->has('enddate'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('enddate') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			{{ Form::label('endtime','END TIME') }}
					      			<span class="require-star"></span>
				      				{{ Form::text('endtime',null,['id'=>'timeend','class'=>'form-control profileinput createeventinput eventstarttime','placeholder'=>'Select Time']) }}
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
				      				@if ($errors->has('endtime'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('endtime') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup paragraphdiv">
		    				<p class="createeventdate"><a href="#">Add another Date for this Event</a></p>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('venue','VENUE') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('venue',null,['id'=>'venue','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Venue of Your Event']) }}
		      				@if ($errors->has('venue'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('venue') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('streetaddress','ADDRESS LINE 1') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Address of Venue']) }}
		      				@if ($errors->has('address_line_1'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_1') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('streetaddress','ADDRESS LINE 2') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('address_line_2',null,['id'=>'streetaddress2','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Address of Venue']) }}
		      				@if ($errors->has('address_line_2'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_2') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountdropdowngroup">

				    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
					      			<label for="city">COUNTRY</label>
					      			<span class="require-star"></span>
						      		<div class="select">
										{{ Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'citydropdown','placeholder'=>'--select--' ] ) }}
										@if ($errors->has('country'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('country') }}</span>
                                    </span>
                                @endif
									</div>
									
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
									<label for="state">STATE</label>
									<span class="require-star"></span>
									<div class="stateselect">
									 	{{ Form::select('state',[], null,[ 'id' => 'state', 'class'=>'stateblock', 'placeholder'=>'--select--' ] ) }}
									 	@if ($errors->has('state'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('state') }}</span>
                                    </span>
                                @endif
									</div>
									
								</div>


								
							</div>
				    	</div>
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountdropdowngroup">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
					      			<label for="city">CITY</label>
					      			<span class="require-star"></span>
						      		<div class="select">
										{{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] ) }}
										@if ($errors->has('city'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('city') }}</span>
                                    </span>
                                @endif
									</div>
									
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
									{{ Form::label('zipcode','ZIP CODE') }}
									<span class="require-star"></span>
									{{ Form::text('zipcode',null,['id'=>'zipcode','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Zip Code']) }}
									@if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('zipcode') }}</span>
                                    </span>
                                @endif

								</div>
								
							</div>
				    	</div>
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
						      		{{ Form::label('latitude','LATITUDE') }}
						      		<span class="require-star"></span>
						      		{{ Form::text('latitude',null,['id'=>'latitude','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Latitude']) }}
						      		@if ($errors->has('latitude'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('latitude') }}</span>
                                    </span>
                                @endif
						      	</div>
						      	
						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
						      		{{ Form::label('longitude','LONGITUDE') }}
						      		<span class="require-star"></span>
						      		{{ Form::text('longitude',null,['id'=>'longitude','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Longitude']) }}
						      		@if ($errors->has('longitude'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('longitude') }}</span>
                                    </span>
                                @endif
						      	</div>
						      	
					      	</div>
		    			</div>
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
							<div class="googlemaping createeventgooglemap">
  								<div id="map" class="googlemap"></div>
  							</div>
  						</div>
  						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
						      		{{ Form::label('contactno','CONTACT NO.') }}
						      		<span class="require-star"></span>
						      		{{ Form::text('contactNo',null,['id'=>'disabledTextInput','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Contact No.']) }}
						      		@if ($errors->has('contactNo'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('contactNo') }}</span>
                                    </span>
                                @endif
						      	</div>
						      	
						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
						      		{{ Form::label('email','EMAIL') }}
						      		<span class="require-star"></span>
						      		{{ Form::text('email',null,['id'=>'contactno','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Email Id.']) }}
						      		@if ($errors->has('email'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('email') }}</span>
                                    </span>
                                @endif
						      	</div>
						      	
					      	</div>
					    </div>
					    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		{{ Form::label('websitelink','WEBSITE LINK') }}
				      		<span class="require-star"></span>
						    {{ Form::text('websitelink',null,['id'=>'websitelink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Venue Of Your Event']) }}
						    @if ($errors->has('websitelink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('websitelink') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		{{ Form::label('fblink','FB LINK') }}
				      		<span class="require-star"></span>
						    {{ Form::text('fblink',null,['id'=>'disabledTextInput','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Addres of Venue']) }}
						    @if ($errors->has('fblink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('fblink') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		{{ Form::label('twitterlink','TWITTER LINK') }}
				      		<span class="require-star"></span>
						    {{ Form::text('twitterlink',null,['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Addres of Venue']) }}
						    @if ($errors->has('twitterlink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('twitterlink') }}</span>
                                    </span>
                                @endif
				    	</div>
				    	
				    	<div class="text-center profilesavebtn">
		    				{{ Form::submit('Create Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile']) }}
		    			</div>
		    		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('add-js')
<script type="text/javascript">
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
//image upload start
	function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
	// files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('uploadfile').innerHTML =  output.join('');
    console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
  }
//image upload end
//for date time picker start
$(document).ready(function(){
	// for getting map
	myMap();
	$('.datetimecalender').datetimepicker({
	    format: 'L'
	});
	$(".datetimecalender").on("dp.show", function (e) {
        $(this).parent().addClass('dates');
    });
	$(".datetimecalender").on("dp.hide", function (e) {
        $(this).parent().removeClass('dates');
    });

	// $('#fromdate').datepicker();
	$('.eventstarttime').datetimepicker({
	    format: 'LT'
	});
	$(".eventstarttime").on("dp.show", function (e) {
        $(this).parent().addClass('times');
    });
	$(".eventstarttime").on("dp.hide", function (e) {
        $(this).parent().removeClass('times');
    });

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
		var selectedCountry = $('#countrydropdown').find('option:selected').text();
		var selectedState = $('#state').find('option:selected').text();
		var address1 = $('#streetaddress1').val();
		var address2 = $('#streetaddress2').val();
		var city = $(this).find('option:selected').text()+' '+selectedCountry+' '+selectedState+' '+address1+' '+address2;
		console.log(city);
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
	});
});


//datetime picker end
</script>
@endsection
