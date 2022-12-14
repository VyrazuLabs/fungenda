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
				{!! Form::open(['url' => '/profile/save', 'method' => 'post', 'files'=>'true']) !!}
				
			 	{{ Form::model($user,[]) }}
					<div class="profileimgdiv">
					@if(!empty($user['file']))
						<img src="{{ url('images').'/'.'user'.'/'.$user['file'] }}" class="img-responsive personicon">
					@else
			 			<img src="{{ url('images/personicon.png') }}" class="img-responsive personicon">
			 		@endif
			 		</div>
			 		<div class="profilebrowsebtndiv">
			 			<button type="button" class="btn btn-secondary profilebrowsebtn">Browse</button>

			 			{{ Form::file('file', ['class'=>'brwsefile','accept'=>'image*']) }}

			 			<button type="button" class="btn btn-secondary profilecancelbtn">Cancel</button>
			 		</div>
			 	</div>
		 		<div class="text-left profileform">

			 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					{{ Form::label('first_name','First Name') }}
	      					<span class="require-star"></span>

	      					{{ Form::text('first_name',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your First Name"]) }}

	      					@if ($errors->has('first_name'))
                                <span class="help-block">
                                    <span class="signup-error">{{ $errors->first('first_name') }}</span>
                                </span>
                            @endif

	    				</div>
			 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					{{ Form::label('last_name','Last Name') }}
	      					<span class="require-star"></span>
	      					
	      					{{ Form::text('last_name',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your Last Name"]) }}

	      					@if ($errors->has('last_name'))
                                <span class="help-block">
                                    <span class="signup-error">{{ $errors->first('last_name') }}</span>
                                </span>
                            @endif

	    				</div>
	    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					{{ Form::label('email','Email Address') }}
	      					<span class="require-star"></span>
	      					
	      					{{ Form::text('email',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your Email Address", 'readonly']) }}

	      					@if ($errors->has('email'))
                                <span class="help-block">
                                    <span class="signup-error">{{ $errors->first('email') }}</span>
                                </span>
                            @endif

	    				</div>
	    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					{{ Form::label('phone_number','Phone Number') }}
	      					
	      					{{ Form::text('phone_number',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Enter Your Phone No."]) }}

	      					@if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <span class="signup-error">{{ $errors->first('phone_number') }}</span>
                                </span>
                            @endif

	    				</div>
	    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
	      					{{ Form::label('address','Address') }}
	      					<span class="require-star"></span>

	      					{{ Form::textarea('address', null, ['size' => '64x7','placeholder'=>'Enter Address','class'=>'form-control profileinput','id'=>'profileaddress']) }}

	      					@if ($errors->has('address'))
                                <span class="help-block">
                                    <span class="signup-error">{{ $errors->first('address') }}</span>
                                </span>
                            @endif

	    				</div>
	    				<div class="text-center profilesavebtn">
	    					{{ Form::submit('Save',['class'=>'btn btn-secondary saveprofile']) }}
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
