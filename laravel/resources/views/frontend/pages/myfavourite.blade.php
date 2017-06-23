@extends('frontend.layouts.main.master')
@section('content')
<div class="col-md-12">
	<div class="container">
		<p class="search-nearby">My Favourites:</p>
	</div>
</div>
<!--end search nearby-->
<div class="col-md-12 maindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 col-sm-12 col-xs-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 leftcardshadow favouritesearch">
						<label class="custom-control custom-radio">
			  				<input id="radio1" name="radio" type="radio" class="custom-control-input">
			  				<span class="custom-control-indicator"></span>
			  				<span class="custom-control-description">Businesses</span>
						</label>
						<label class="custom-control custom-radio event-btn">
			  				<input id="radio2" name="radio" type="radio" class="custom-control-input" checked>
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">Events</span>
						</label>
						<label class="custom-control custom-radio event-btn">
			  				<input id="radio2" name="radio" type="radio" class="custom-control-input">
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">All</span>
						</label>
						<div class="col-md-12 searchboxbtn">
							<div class="col-md-6 searchbox">
								<div class="searchboxfavourite">
									<input type="text" id="disabledTextInput" name="search" class="form-control searchboxinput" placeholder="Search term i.e 'Yoga' ">
								</div>
							</div>
							<div class="col-md-6 searchbtn">
								<button type="button" class="btn btn-secondary top-search">Submit</button>
							</div>
						</div>
					</div>
					<div class="col-md-12 leftcardshadow">	
						<div class="customdetail">
							<h3 class="business-text">Businesses:</h3>
							<div class="col-md-12 devide">
								<div class="col-md-3 divimgs">
									<img src="images/left3.png" class="img-responsive thumb-img">
								</div>
								<div class="col-md-6 textdetails">
									<h4 class="head">Hawaai West</h4>
									<h5 class="colors">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
									<p class="read"><a href="#">Read More</a></p>
								</div>
								<div class="col-md-3 text-center socialicon">
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 devide">
								<div class="col-md-3 divimgs">
									<img src="images/left3.png" class="img-responsive thumb-img">
								</div>
								<div class="col-md-6 textdetails">
									<h4 class="head">Hawaai West</h4>
									<h5 class="colors">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
									<p class="read"><a href="#">Read More</a></p>
								</div>
								<div class="col-md-3 text-center socialicon">
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 devidethree">
								<div class="col-md-3 divimgs">
									<img src="images/left3.png" class="img-responsive thumb-img">
								</div>
								<div class="col-md-6 textdetails">
									<h4 class="head">Hawaai West</h4>
									<h5 class="colors">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
									<p class="read"><a href="#">Read More</a></p>
								</div>
								<div class="col-md-3 text-center socialicon">
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button type="button" class="btn view">Load More <i class="fa fa-angle-down loaddropdown" aria-hidden="true"></i></button>
							</div>
							<!--end business div-->
							<!--start event div-->
							<h3 class="business-text">Events:</h3>
							<div class="col-md-12 devide">
								<div class="col-md-3 divimgs">
									<img src="images/left3.png" class="img-responsive thumb-img">
								</div>
								<div class="col-md-6 textdetails">
									<h4 class="head">Hawaai West</h4>
									<h5 class="colors">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
									<p class="read"><a href="#">Read More</a></p>
								</div>
								<div class="col-md-3 text-center socialicon">
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 devide">
								<div class="col-md-3 divimgs">
									<img src="images/left3.png" class="img-responsive thumb-img">
								</div>
								<div class="col-md-6 textdetails">
									<h4 class="head">Hawaai West</h4>
									<h5 class="colors">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
									<p class="read"><a href="#">Read More</a></p>
								</div>
								<div class="col-md-3 text-center socialicon">
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 devidethree">
								<div class="col-md-3 divimgs">
									<img src="images/left3.png" class="img-responsive thumb-img">
								</div>
								<div class="col-md-6 textdetails">
									<h4 class="head">Hawaai West</h4>
									<h5 class="colors">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
									<p class="read"><a href="#">Read More</a></p>
								</div>
								<div class="col-md-3 text-center socialicon">
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button type="button" class="btn view">Load More <i class="fa fa-angle-down loaddropdown" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--end event div-->
		
				@include('frontend.layouts.theme.mostfav')	
		
@endsection