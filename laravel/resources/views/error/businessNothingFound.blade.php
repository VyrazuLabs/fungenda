@extends('frontend.layouts.main.master')
@section('content')
<!--start business div-->
<div class="col-md-12 maindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 leftcardshadow">
						<div class="customdetail">
							<!--start event div-->
							<div class="eventmain businessevent">
								<h3 class="business-text">Business:</h3>
								<center><img style="margin-top: 56px; margin-bottom: 30px;" src="{{ url('/images/error/Image_from_Skype1.png') }}" height="100" width="100"></center><br>
								<center><h4>Nothing Found...</h4></center>
								<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
							</div>
						</div>
					</div>
				</div>
				<!--end event div-->
				@include('frontend.layouts.theme.right-sidebar')	
			</div>
		</div>
	</div>
</div>
@endsection