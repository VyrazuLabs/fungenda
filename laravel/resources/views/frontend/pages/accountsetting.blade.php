@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilediv">
			<p class="text-center profile">Account Settings</p>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard accountcard">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountpicform">
					<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 accountpersondiv">
						<div class="picbtn accountpicbtn">
							<div id="accountimagediv" class="profileimgdiv">
						 		<img src="images/personicon.png" class="img-responsive personicon">
						 	</div>
						 	<div class="profilebrowsebtndiv acountbrowsediv">
						 		<button type="button" class="btn btn-secondary profilebrowsebtn accntbrwsebtn">Browse</button>
						 		<input type="file" accept="image*" class="brwsefile">
							</div>
								<button type="button" class="btn btn-secondary profilebrowsebtn accntcancelbtn">Cancel</button>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 accountsettingdiv">
					 	<div class="text-center accountformform">
						 	<form>
						 		<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<label for="email">Email</label>
				      				<input type="text" id="accountmail" name="email" class="form-control profileinput" placeholder="Enter Name">
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<label for="oldpassword">Current Password</label>
				      				<input type="password" id="oldpass" name="oldpassword" class="form-control profileinput" placeholder="Enter Current Password">
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<label for="newpassword">New Password</label>
				      				<input type="password" id="newpass" name="newpassword" class="form-control profileinput" placeholder="Enter New Password">
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<label for="confirmpassword">Confirm New Password</label>
				      				<input type="password" id="passwordconfirm" name="confirmpassword" class="form-control profileinput" placeholder="Enter New Password">
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				    				<button type="button" class="btn btn-secondary changepswbtn">Change Password</button>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup switchnotification">
				    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountnotification">
				    					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 emailnotification">
				      						<label for="emailnotifications">Email Notifications:</label>
				      					</div>
				      					<div class="col-md-6 col-xs-6 toggleswitch">
				      						<label class="switch">
												<input type="checkbox" class="togglecheck" checked>
												<div class="slider round"></div>
											</label>
				      					</div>
				      				</div>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group accountgroup">
				      				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountradiobtn">
				      					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
											<label class="custom-control custom-radio">
								  				<input id="radio1" name="radio" type="radio" class="custom-control-input" checked>
								  				<span class="custom-control-indicator"></span>
								  				<span class="custom-control-description">Daily</span>
											</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
											<label class="custom-control custom-radio event-btn">
								  				<input id="radio2" name="radio" type="radio" class="custom-control-input">
								  				<span class="custom-control-indicator"></span>
								 				<span class="custom-control-description">Weekly</span>
											</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
											<label class="custom-control custom-radio event-btn">
								  				<input id="radio2" name="radio" type="radio" class="custom-control-input">
								  				<span class="custom-control-indicator"></span>
								 				<span class="custom-control-description">Monthly</span>
											</label>
										</div>
									</div>
				    			</div>
				    			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-group profilegroup accountgroup accountsettingbtndiv">
				    				<button type="button" class="btn btn-secondary changepswbtn accntsavebtn">Save All</button>
				    			</div>
							 </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('add-js')
<script type="text/javascript">
	$(document).ready(function() {
     $('.accntcancelbtn').hide();
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.personicon').attr('src', e.target.result);
                $('.accntbrwsebtn').hide();
                $('.accntcancelbtn').show();
            }
    		reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".brwsefile").on('change', function(){
        readURL(this);
    });
    
    $(".accntbrwsebtn").on('click', function() {
       $(".brwsefile").click();
    });
});

	$(".accntcancelbtn").click(function(){
		 $('.personicon').attr('src', "images/personicon.png");
            $('.accntcancelbtn').hide();
            $('.accntbrwsebtn').show();
		  
		});

</script>
@endsection
