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
								<h3 class="business-text">Events:</h3>
								<center><h4>Nothing Found...</h4></center>
								<center>Can't find it? Feel free to add it!</center>
							</div>
						</div>
					</div>
				</div>
				<!--end event div-->
				@include('frontend.layouts.theme.mostfav')	
			</div>
		</div>
	</div>
</div>
@endsection