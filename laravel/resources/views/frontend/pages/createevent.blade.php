@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">
			@if(isset($all_event))
              <p class="profile text-left">Edit Event:</p>
            @else
              <p class="profile text-left">Create Event:</p>
            @endif
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard">
				<div class="text-center profileform">

				 @if(empty($all_event))
                    {!! Form::open(['url' => '/save-events', 'method' => 'post', 'files'=>'true']) !!}
                 @endif
                 @if(!empty($all_event))
                    {{ Form::model($all_event,['method'=>'post', 'files'=>'true', 'url'=>'/event/update']) }}

                    {{ Form::hidden('event_id',null,[]) }}
                 @endif
				 		{{ csrf_field() }}
				 		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('eventname','EVENT NAME') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('name',null,['id'=>'eventname','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Name']) }}
		      				@if ($errors->has('name'))
                                    <span id="eventnameerror" class="help-block">
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
						@if(isset($event))
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
							@foreach($event['images'] as $image)
	                            <div class="edit-image-show-div">
	                             @if($image)
	                              <span>
	                                @if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$image) == 1)
	                                  <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event'.'/'.$image) }}">
	                                @else
	                                  <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event/placeholder.svg') }}">
	                                @endif
	                                  <a href= "{{ route('event_edit_image_delete',['event_id'=> $event->event_id,'img_name'=>$image]) }}" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
	                              </span>
	                             @endif
	                            </div>
                            @endforeach
							</div>
						@endif
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				{{ Form::label('eventcost','EVENT COST') }}
				      				<span class="require-star"></span>
				      				{{ Form::text('costevent',null,['id'=>'eventcost','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Amount']) }}
				      				@if ($errors->has('costevent'))
                                    <span id="eventcosterror" class="help-block">
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
											@if(isset($all_event))
				                              {{ Form::checkbox('checkbox',1,null, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
				                            @else
				                              {{ Form::checkbox('checkbox',1,null, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
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
		      				{{ Form::label('description','ENTER BRIEF DESCRIPTION OF DISCOUNT') }}
		      				{{ Form::textarea('comment', null, ['size' => '64x7','placeholder'=>'Enter Description of Discount','class'=>'createeventtextarea','id'=>'eventcomment']) }}
		      				@if ($errors->has('comment'))
                                    <span class="help-block">
                                        <span id="eventcommenterror" class="signup-error">{{ $errors->first('comment') }}</span>
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
                                    <span id="datestarterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('startdate') }}</span>
                                    </span>
                                @endif
				      			</div>
				      			
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			{{ Form::label('starttime','START TIME') }}
					      			<span class="require-star"></span>
				      				{{ Form::text('starttime',null,['id'=>'timestart','class'=>'form-control profileinput createeventinput eventstarttime','placeholder'=>'Select Time']) }}
									<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
				      				@if ($errors->has('starttime'))
                                    <span id="timestarterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('starttime') }}</span>
                                    </span>
                                @endif
					      		</div>
					      		
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				{{ Form::label('enddate','END DATE') }}
				      				<span class="require-star"></span>
				      				{{ Form::text('enddate',null,['id'=>'dateend','class'=>'form-control profileinput createeventinput datetimecalender','placeholder'=>'Select Date']) }}
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<img src="{{ url('images/calenderpic.png') }}" class="img-responsive createcalender">
				      				@if ($errors->has('enddate'))
                                    <span id="dateenderror" class="help-block">
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
	                                    <span id="timeenderror" class="help-block">
	                                        <span class="signup-error">{{ $errors->first('endtime') }}</span>
	                                    </span>
                               	 	@endif
				      			</div>		
			      			</div>
		    			</div>
		    			<div id="another_date_div"></div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup paragraphdiv">
		    				<p class="createeventdate"><a href="JavaScript:Void(0);" id="add_date">Add another Date for this Event</a></p>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('venue','VENUE') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('venue',null,['id'=>'venue','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Venue of Your Event']) }}
		      				@if ($errors->has('venue'))
                                    <span id="venueerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('venue') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('streetaddress','ADDRESS LINE 1') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Address of Venue']) }}
		      				@if ($errors->has('address_line_1'))
                                    <span id="streetaddress1error" class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_1') }}</span>
                                    </span>
                                @endif
		    			</div>
		    			
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				{{ Form::label('streetaddress','ADDRESS LINE 2') }}
		      				<span class="require-star"></span>
		      				{{ Form::text('address_line_2',null,['id'=>'streetaddress2','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Address of Venue']) }}
		      				@if ($errors->has('address_line_2'))
                                    <span id="streetaddress2error" class="help-block">
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
                                    <span id="countrydropdownerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('country') }}</span>
                                    </span>
                                @endif
									</div>
									
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
									<label for="state">STATE</label>
									<span class="require-star"></span>
									<div class="stateselect">
									@if(isset($event['respected_states']))
		                              {{ Form::select('state',$event['respected_states'], null,[ 'id' => 'state', 'class'=>'stateblock', 'placeholder'=>'--select--' ] ) }}
		                            @else
		                              {{ Form::select('state',[], null,[ 'id' => 'state', 'class'=>'stateblock', 'placeholder'=>'--select--' ] ) }}
		                            @endif
									 	@if ($errors->has('state'))
                                    <span id="stateerror" class="help-block">
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
						      		@if(isset($event['respected_city']))
		                              {{ Form::select('city',$event['respected_city'], null,[ 'id' => 'citydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] ) }}
		                            @else
		                              {{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] ) }}
		                            @endif
										@if ($errors->has('city'))
                                    <span id="citydropdownerror" class="help-block">
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
                                    <span id="zipcodeerror" class="help-block">
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
						      		{{ Form::text('latitude',null,['id'=>'latitude','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Latitude','readonly']) }}
						      		@if ($errors->has('latitude'))
                                    <span id="latitudeerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('latitude') }}</span>
                                    </span>
                                @endif
						      	</div>
						      	
						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
						      		{{ Form::label('longitude','LONGITUDE') }}
						      		<span class="require-star"></span>
						      		{{ Form::text('longitude',null,['id'=>'longitude','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Longitude','readonly']) }}
						      		@if ($errors->has('longitude'))
                                    <span id="longitudeerror" class="help-block">
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
						      		{{ Form::text('contactNo',null,['id'=>'contactno','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Contact No.']) }}
						      		@if ($errors->has('contactNo'))
                                    <span id="contactnoerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('contactNo') }}</span>
                                    </span>
                                @endif
						      	</div>
						      	
						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
						      		{{ Form::label('email','EMAIL') }}
						      		<span class="require-star"></span>
						      		{{ Form::text('email',null,['id'=>'emailid','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Email Id.']) }}
						      		@if ($errors->has('email'))
                                    <span id="emailiderror" class="help-block">
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
				    		@if(isset($all_event))
				    		{{ Form::submit('Update Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile']) }}
				    		@else
		    				{{ Form::submit('Create Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile']) }}
		    				@endif
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

//image upload start
	function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
	// files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('uploadfile').innerHTML =  output.join('');
    // console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
  }
//image upload end
//for date time picker start
function dateTimePicker(){
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
}
$(document).ready(function(){
	dateTimePicker();
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
    			// console.log(data);
    			$('#citydropdown').empty();
    			$.each(data,function(index, value){
    				$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
    				// console.log(value);
    			});
    		}
    	});
	});

	var counter = 0;
	$('#add_date').on('click',function(){
		counter++;
		$('#another_date_div').append('<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv"><label for="startdate">START DATE</label><span class="require-star"></span><input type="text" name="startdate'+counter+'" id="datestart'+counter+'" class="form-control profileinput createeventinput datetimecalender" placeholder="Select Date"><i class="fa fa-angle-down datetimedown" aria-hidden="true"></i><img src="{{ url('images/calenderpic.png') }}" class="img-responsive createcalender"></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv"><label for="starttime">START TIME</label><span class="require-star"></span><input type="text" name="starttime'+counter+'" id="timestart'+counter+'" class="form-control profileinput createeventinput eventstarttime" placeholder="Select Time"><i class="fa fa-angle-down datetimedown" aria-hidden="true"></i><i class="fa fa-clock-o timepick" aria-hidden="true"></i></div></div></div><div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv"><label for="enddate">END DATE</label><span class="require-star"></span><input type="text" name="enddate'+counter+'" id="dateend'+counter+'" class="form-control profileinput createeventinput datetimecalender" placeholder="Select Date"<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i><img src="{{ url('images/calenderpic.png') }}" class="img-responsive createcalender"></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv"><label for="endtime">END TIME</label><span class="require-star"></span><input type="text" name="endtime'+counter+'" id="timeend'+counter+'" class="form-control profileinput createeventinput eventstarttime" placeholder="Select Time"><i class="fa fa-angle-down datetimedown" aria-hidden="true"></i><i class="fa fa-clock-o timepick" aria-hidden="true"></i></div></div></div>');
		
		dateTimePicker();
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
		  url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
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
//datetime picker end

$('#eventname').on('keyup',function(){
	$('#eventnameerror').html('');
})

$('#eventcost').on('keyup',function(){
	$('#eventcosterror').html('');
})

$('#eventcomment').on('keyup',function(){
	$('#eventcommenterror').html('');
})

$('#datestart').on('focus',function(){
	$('#datestarterror').html('');
})

$('#timestart').on('focus',function(){
	$('#timestarterror').html('');
})

$('#dateend').on('focus',function(){
	$('#dateenderror').html('');
})

$('#timeend').on('focus',function(){
	$('#timeenderror').html('');
})

$('#venue').on('keyup',function(){
	$('#venueerror').html('');
	if($('#longitude').html != ''){
		$('#longitudeerror').html('');
	}
	if($('#latitude').html != ''){
		$('#latitudeerror').html('');
	}
})

$('#streetaddress1').on('keyup',function(){
	$('#streetaddress1error').html('');
})

$('#streetaddress2').on('keyup',function(){
	$('#streetaddress2error').html('');
})

$('#countrydropdown').on('change',function(){
	$('#countrydropdownerror').html('');
})

$('#state').on('change',function(){
	$('#stateerror').html('');
})

$('#citydropdown').on('change',function(){
	$('#citydropdownerror').html('');
})

$('#zipcode').on('keyup',function(){
	$('#zipcodeerror').html('');
})

$('#contactno').on('keyup',function(){
	$('#contactnoerror').html('');
})

$('#emailid').on('keyup',function(){
	$('#emailiderror').html('');
})
</script>
@endsection
