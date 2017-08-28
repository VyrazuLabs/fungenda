@extends('admin.layouts.master')

@section('title', 'Edit Profile')
@section('add-meta')
@endsection

@section('add-css')
  
@endsection

@section('content')
<section class="content">
      <!-- general form elements -->
    <div class="row">
  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="box box-primary">
		          	<div class="box-header with-border">
					  <h3>
					   Edit Profile
					  </h3>
					</div>
					<div class="text-left createform">
						{{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> --}}
							<div class="container text-center">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
									<div class="profilecard">
										<div class="picbtn">
										{!! Form::open(['url' => '/profile/save', 'method' => 'post', 'files'=>'true']) !!}
										
									 	{{ Form::model($user,[]) }}
											<div class="profileimgdiv">
											@if(!empty($user['file']))
												<img src="{{ url('images').'/'.'user'.'/'.$user['file'] }}" class="img-responsive personicon">
											@else
									 			<img src="{{ url('/images/personicon.png') }}" class="img-responsive personicon">
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

							      					{{ Form::text('first_name',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your First Name"]) }}
							    				</div>
									 			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					{{ Form::label('last_name','Last Name') }}
							      					
							      					{{ Form::text('last_name',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your Last Name"]) }}
							    				</div>
							    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					{{ Form::label('email','Email Address') }}
							      					
							      					{{ Form::text('email',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Your Email Address", 'readonly']) }}
							    				</div>
							    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					{{ Form::label('phone_number','Phone Number') }}
							      					
							      					{{ Form::text('phone_number',null,['id'=>"profilename", 'class'=>"form-control profileinput", 'placeholder'=>"Enter Your Phone No."]) }}
							    				</div>
							    				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup">
							      					{{ Form::label('address','Address') }}

							      					{{ Form::textarea('address', null, ['size' => '64x7','placeholder'=>'Enter Address','class'=>'form-control profileinput','id'=>'profileaddress']) }}
							    				</div>
							    				<div class="text-center profilesavebtn">
							    					{{ Form::submit('Save',['class'=>'btn btn-secondary saveprofile']) }}
							    				</div>

							    			{!! Form::close() !!}
										</div>
									</div>
								</div>
							{{-- </div> --}}
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>
@endsection

<!-- ./wrapper -->
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
