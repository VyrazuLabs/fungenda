@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">	
			@if(isset($all_business))
              <p class="profile text-left">Edit Business:</p>
            @else
              <p class="profile text-left">Create Business:</p>
            @endif
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard">
				<div class="text-center profileform">

					@if(empty($all_business))
                      {!! Form::open(['url' => '/save-business', 'method' => 'post', 'files'=>'true']) !!}
                    @endif
                    @if(!empty($all_business))
                      {{ Form::model($all_business,['method'=>'post', 'files'=>'true', 'url'=>'/business/update']) }}
                      {{ Form::hidden('business_id',null,[]) }}
                    @endif

				 		{{ csrf_field() }}
				 		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				 			{{ Form::label('eventname','BUSINESS NAME') }}
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
						@if(isset($business))
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
			      			@foreach($business['images'] as $image)
	                        <div class="edit-image-show-div">
	                         @if($image)
	                          <span>
	                            @if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$image) == 1)
	                              <img class="edit_image_div" height="200" width="200" src="{{ url('/images/business'.'/'.$image) }}">
	                            @else
	                              <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event/placeholder.svg') }}">
	                            @endif
	                                <a href= "{{ route('business_edit_image_delete',['business_id'=> $business->business_id,'img_name'=>$image]) }}" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
	                          </span>
	                         @endif
	                        </div>
	                        @endforeach 	
						</div>
						@endif
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				{{ Form::label('eventcost','BUSINESS COST') }}
				      				<span class="require-star"></span>
				      				{{ Form::text('costbusiness',null,['id'=>'eventcost','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Amount']) }}
				      				@if ($errors->has('costbusiness'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('costbusiness') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
				      				{{ Form::label('discount','DISCOUNT(IF AVAILABLE)') }}
				      				{{ Form::text('businessdiscount',null,['id'=>'discount','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Discount Rate']) }}
				      				@if ($errors->has('businessdiscount'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('businessdiscount') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup checkboxdivcreate">
						    <label for="createeventcheckbox">DISCOUNT AS</label>
						    {{ Form::label('createeventcheckbox','DISCOUNT AS') }}	
						    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
										<div class="form-group checkboxlist createventcheckboxlst">
											@if(isset($all_business))
				                                {{ Form::checkbox('checkbox',1,null, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
				                            @else
				                                {{ Form::checkbox('checkbox',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
				                            @endif
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
		      				<label for="venue" class="houroperation">HOURS OF OPERATION</label>
		      				<div class="form-group operationgroup">
		      					<div class="col-md-12 form-inline operationform">
		      						<div class="col-md-4 day">
		      						{{ Form::label('venue','Mon') }}
			      					</div>
			      					<div class="col-md-8 daylist">
				      					{{ Form::text('monday_start',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('mon_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
										<span>to</span>
										{{ Form::text('monday_end',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('mon_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						{{ Form::label('venue','Tue') }}
			      					</div>
			      					<div class="col-md-8 daylist">
										{{ Form::text('tuesday_start',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('tue_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
										<span>to</span>
										{{ Form::text('tuesday_end',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('tue_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						{{ Form::label('venue','Wed') }}
			      					</div>
			      					<div class="col-md-8 daylist">
										{{ Form::text('wednessday_start',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('wed_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
										<span>to</span>
										{{ Form::text('wednessday_end',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('wed_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						{{ Form::label('venue','Thurs') }}
			      					</div>
			      					<div class="col-md-8 daylist">
										{{ Form::text('thursday_start',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('thurs_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
										<span>to</span>
										{{ Form::text('thursday_end',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('thurs_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						{{ Form::label('venue','Fri') }}
			      					</div>
			      					<div class="col-md-8 daylist">
										{{ Form::text('friday_start',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('fri_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
										<span>to</span>
										{{ Form::text('friday_end',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('fri_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						{{ Form::label('venue','Sat') }}
			      					</div>
			      					<div class="col-md-8 daylist">
										{{ Form::text('saturday_start',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('sat_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
										<span>to</span>
										{{ Form::text('saturday_end',null,['class'=>'form-control operationformcontrol']) }}
										{{ Form::select('sat_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] ) }}
									</div>
			      				</div>
			      			</div> 
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
						      			{{ Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] ) }}
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
									<div class="select">
										@if(isset($business['respected_states']))
			                              {{ Form::select('state',$business['respected_states'], null,[ 'id' => 'state', 'class'=>'stateblock', 'placeholder'=>'--select--' ] ) }}
			                            @else
			                            {{ Form::select('state',[], null,[ 'id' => 'state','class'=>'stateblock', 'placeholder'=>'--select--'] ) }}
			                            @endif
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
						      			@if(isset($business['respected_city']))
			                              {{ Form::select('city',$business['respected_city'], null,[ 'id' => 'citydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] ) }}
			                            @else
			                            {{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] ) }}
			                            @endif
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
						    {{ Form::text('websitelink',null,['id'=>'websitelink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Venue Of Your Event']) }}
						    @if ($errors->has('websitelink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('websitelink') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		{{ Form::label('fblink','FB LINK') }}
						    {{ Form::text('fblink',null,['id'=>'disabledTextInput','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Addres of Venue']) }}
						    @if ($errors->has('fblink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('fblink') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		{{ Form::label('twitterlink','TWITTER LINK') }}
						    {{ Form::text('twitterlink',null,['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Addres of Venue']) }}
						    @if ($errors->has('twitterlink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('twitterlink') }}</span>
                                    </span>
                                @endif
				    	</div>
				    	
				    	<div class="text-center profilesavebtn">
				    		@if(empty($all_business))
				    			{{ Form::submit('Create Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile']) }}
				    		@else
		    					{{ Form::submit('Update Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile']) }}
		    				@endif
		    			</div>
		    		{!! Form::close() !!}
		    	</div>
		    </div>
		</div>
	</div>
</div>
</section>
@endsection
@section('add-js')
<script type="text/javascript">

	$(document).ready(function(){
		$('#countrydropdown').on('change', function(){
		var value = $(this).val();
		// console.log(value);
		$.ajax({
			type: 'get',
			url: "{{ url('/fetch_state_business') }}",
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
	    	// console.log(value);
	    	$.ajax({
	    		type: 'get',
	    		url: "{{ url('/fetch_country_business') }}",
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
	    	var address1 = $('#streetaddress1').val();
	    	var address2 = $('#streetaddress2').val();
	    	var country = $('#countrydropdown option:selected').text();
	    	var state = $('#state option:selected').text();
	    	var city = $('#citydropdown option:selected').text();
	    	var full_address = address1+','+address2+','+country+','+state+','+city;
	    	var longitude = $('#longitude').val();
	    	var latitude = $('#latitude').val();
	    	$.ajax({
			  url:"http://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
			  type: "POST",
			  success:function(res){
			  	// console.log(longitude);
			  	// console.log(latitude);
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
</script>
@endsection