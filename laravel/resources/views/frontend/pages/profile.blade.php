@extends('frontend.layouts.main.master')
@section('content')
<div class="col-md-12">
	<div class="container text-center">
		<div class="col-md-12 profilediv">
			<p class="text-center profile">My Profile</p>
		</div>
		<div class="col-md-8 profileimgdiv">
			<div class="profilecard">
				<div class="picbtn">
					<div class="profileimgdiv">
			 			<img src="images/personicon.png" class="img-responsive personicon">
			 		</div>
			 		<div class="profilebrowsebtndiv">
			 			<button type="button" class="btn btn-secondary profilebrowsebtn">Browse</button>
			 		</div>
			 	</div>
		 		<div class="text-left profileform">
			 		<form>
			 			<div class="col-md-10 form-group profilegroup">
	      					<label for="disabledTextInput">Name</label>
	      					<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Name">
	    				</div>
	    				<div class="col-md-10 form-group profilegroup">
	      					<label for="disabledTextInput">Email</label>
	      					<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Email">
	    				</div>
	    				<div class="col-md-10 form-group profilegroup">
	      					<label for="disabledTextInput">Phone No.</label>
	      					<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Phone No.">
	    				</div>
	    				<div class="col-md-10 form-group profilegroup">
	      					<label for="disabledTextInput">Address</label>
	      					<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Address">
	    				</div>
	    				<div class="text-center profilesavebtn">
	    					<button type="button" class="btn btn-secondary profilebrowsebtn saveprofile">Save</button>
	    				</div>
				 	</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
