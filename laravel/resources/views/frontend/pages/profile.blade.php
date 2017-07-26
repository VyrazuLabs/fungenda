@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilediv">
			<p class="text-center profile">My Profile</p>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard">
				<div class="picbtn">
					<div class="profileimgdiv">
			 			<img src="images/personicon.png" class="img-responsive personicon">
			 		</div>
			 		<div class="profilebrowsebtndiv">
			 			<button type="button" class="btn btn-secondary profilebrowsebtn">Browse</button>
			 			<input type="file" accept="image*" class="brwsefile">
			 			<button type="button" class="btn btn-secondary profilecancelbtn">Cancel</button>
			 		</div>
			 	</div>
		 		<div class="text-left profileform">
			 		<form>
			 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					<label for="profilename">User Name</label>
	      					<input type="text" id="profilename" name="profilename" class="form-control profileinput" placeholder="Enter Name">
	    				</div>
			 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					<label for="profilename">Your Name</label>
	      					<input type="text" id="profilename" name="profilename" class="form-control profileinput" placeholder="Enter Name">
	    				</div>
	    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					<label for="profileemail">Email</label>
	      					<input type="text" id="profileemail" name="profileemail" class="form-control profileinput" placeholder="Enter Email">
	    				</div>
	    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					<label for="profilephoneno">Phone No.</label>
	      					<input type="text" id="profilephoneno" name="profilephoneno" class="form-control profileinput" placeholder="Enter Phone No.">
	    				</div>
	    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					<label for="profileaddress">Address</label>
	      					<input type="text" id="profileaddress" name="profileaddress" class="form-control profileinput" placeholder="Enter Address">
	    				</div>
	    				<div class="text-center profilesavebtn">
	    					<button type="button" class="btn btn-secondary saveprofile">Save</button>
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
	$(document).ready(function() {
     $('.profilecancelbtn').hide();
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.personicon').attr('src', e.target.result);
                $('.profilebrowsebtn').hide();
                $('.profilecancelbtn').show();
            }
    		reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".brwsefile").on('change', function(){
        readURL(this);
    });
    
    $(".profilebrowsebtn").on('click', function() {
       $(".brwsefile").click();
    });
});

	$(".profilecancelbtn").click(function(){
		 $('.personicon').attr('src', "images/personicon.png");
            $('.profilecancelbtn').hide();
            $('.profilebrowsebtn').show();
		  
		});

</script>
@endsection
