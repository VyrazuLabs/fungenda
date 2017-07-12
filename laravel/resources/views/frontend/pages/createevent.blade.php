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
				 	<form>
				 		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="eventname">EVENT NAME</label>
		      				<input type="text" id="eventname" name="name" class="form-control profileinput createeventinput" placeholder="Enter Name">
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="category">CATEGORY</label>
		      				<div class="categoryselect">
						      	<select class="form-control categorydropdown">
						      		<option selected="selected" class="selectcat">Select Category of Event</option>
						      		<option value="city2">1</option>
									<option value="city3">2</option>
									<option value="city3">3</option>
								</select>
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
			      					<input type="file" id="files" name="files[]" class="eventbrowsefile" multiple/>
			      					<output id="list"></output>
			      				</div>
							</div>
						</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				<label for="eventcost">EVENT COST</label>
				      				<input type="text" id="eventcost" name="costevent" class="form-control profileinput createeventinput" placeholder="Enter Amount">
				      			</div>
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			<label for="discount">DISCOUNT(IF AVAILABLE)</label>
				      				<input type="text" id="discount" name="eventdiscount" class="form-control profileinput createeventinput" placeholder="Enter Discount Rate">
				      			</div>
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup checkboxdivcreate">
						    <label for="createeventcheckbox">DISCOUNT AS</label>	
						    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
									<form>
										<div class="form-group checkboxlist createventcheckboxlst">
											<input type="checkbox" class="signincheckbox" id="kidfriendly" name="checkbox1" checked />
											<span></span>
										    <label for="kidfriendly">Kid Friendly</label>
										</div>
										<div class="form-group checkboxlist createventcheckboxlst">
										    <input type="checkbox" id="petfriendly" class="signincheckbox" name="checkbox2" />
										    <span></span>
										    <label for="petfriendly">Pet Friendly</label>
										</div>
									</form>
			    				</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="description">ENTER BRIEF DESCRIPTION OF DISCOUNT</label>
		      				<textarea class="createeventtextarea" rows="7" cols="64" name="comment" form="usrform" placeholder="Enter Description of Discount"></textarea>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				<label for="startdate">START DATE</label>
				      				<input type="text" id="datestart" name="startdate" class="form-control profileinput createeventinput datetimecalender" placeholder="Select Date">
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<img src="images/calenderpic.png" class="img-responsive createcalender">
				      			</div>
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			<label for="starttime">START TIME</label>
				      				<input type="text" id="timestart" name="starttime" class="form-control profileinput createeventinput eventstarttime" placeholder="Select Time">
									<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
					      		</div>
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				<label for="enddate">END DATE</label>
				      				<input type="text" id="dateend" name="enddate" class="form-control profileinput createeventinput datetimecalender" placeholder="Select Date">
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<img src="images/calenderpic.png" class="img-responsive createcalender">
				      			</div>
				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			<label for="endtime">END TIME</label>
				      				<input type="text" id="timeend" name="endtime" class="form-control profileinput createeventinput eventstarttime" placeholder="Select Time">
				      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
				      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
				      			</div>
			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup paragraphdiv">
		    				<p class="createeventdate"><a href="#">Add another Date for this Event</a></p>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="venue">VENUE</label>
		      				<input type="text" id="venue" name="venue" class="form-control profileinput createeventinput" placeholder="Enter Venue of Your Event">
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="streetaddress">ADDRESS LINE 1</label>
		      				<input type="text" id="streetaddress" name="streetaddress" class="form-control profileinput createeventinput" placeholder="Enter Street Address of Venue">
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="streetaddress">ADDRESS LINE 2</label>
		      				<input type="text" id="streetaddress" name="streetaddress" class="form-control profileinput createeventinput" placeholder="Enter Street Address of Venue">
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="streetaddress">ADDRESS LINE 3</label>
		      				<input type="text" id="streetaddress" name="streetaddress" class="form-control profileinput createeventinput" placeholder="Enter Street Address of Venue">
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountdropdowngroup">
					      		<div class="col-lg-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass">
					      			<label for="city">CITY</label>
						      		<div class="select">
						      			<select class="citydropdown">
						      				<option value="city1">Select City</option>
											<option value="city2">kolkata</option>
											<option value="city3">kolkata</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 accountdropddwnclass">
									<label for="state">STATE</label>
									<div class="select">
									 	<select class="citydropdown">
											<option value="city1">Select City</option>
											<option value="city2">kolkata</option>
											<option value="city3">kolkata</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 accountdropddwnclass">
									<label for="zipcode">ZIP CODE</label>
									<input type="text" id="zipcode" name="zipcode" class="form-control profileinput createeventinput" placeholder="Enter Zip Code">
								</div>
							</div>
				    	</div>
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
						      		<label for="latitude">LATITUDE</label>
						      		<input type="text" id="latitude" name="latitude" class="form-control profileinput createeventinput" placeholder="Enter Latitude">
						      	</div>
						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
							      	<label for="longitude">LONGITUDE</label>
						      		<input type="text" id="longitude" name="longitude" class="form-control profileinput createeventinput" placeholder="Enter Longitude">
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
						      		<label for="contactno">CONTACT NO.</label>
						      		<input type="text" id="disabledTextInput" name="location" class="form-control profileinput createeventinput" placeholder="Enter Latitude">
						      	</div>
						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
							      	<label for="email">EMAIL</label>
						      		<input type="text" id="contactno" name="contactno" class="form-control profileinput createeventinput" placeholder="Enter Longitude">
						      	</div>
					      	</div>
					    </div>
					    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<label for="websitelink">WEBSITE LINK</label>
				      		<input type="text" id="websitelink" name="websitelink" class="form-control profileinput createeventinput" placeholder="Enter Venue Of Your Event">
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<label for="fblink">FB LINK</label>
				      		<input type="text" id="disabledTextInput" name="location" class="form-control profileinput createeventinput" placeholder="Enter Street Addres of Venue">
		    			</div>
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<label for="twitterlink">TWITTER LINK</label>
				      		<input type="text" id="fblink" name="fblink" class="form-control profileinput createeventinput" placeholder="Enter Street Addres of Venue">
				    	</div>
				    	<div class="text-center profilesavebtn">
		    				<button type="button" class="btn btn-secondary profilebrowsebtn saveprofile">Create Now</button>
		    			</div>
		    		</form>
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
    console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
	}
//image upload end
//for date time picker start
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
//datetime picker end
</script>
@endsection
