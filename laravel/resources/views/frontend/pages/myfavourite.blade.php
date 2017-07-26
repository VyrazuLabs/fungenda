@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<p class="search-nearby myfav">My Favourites:</p>
	</div>
</div>
<!--end search nearby-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myfavdiv">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 business">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 custombox">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 left-div">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow favouritesearch">
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
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 searchboxbtn">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbox">
								<div class="searchboxfavourite">
									<input type="text" id="favsearch" name="search" class="form-control searchboxinput" placeholder="Search term i.e 'Yoga' ">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbtn">
								<button type="button" class="btn btn-secondary top-search">Submit</button>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow">	
						<div class="customdetail">
							<div class="businessmain businessevent">
								<h3 class="business-text">Businesses:</h3>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide devidethree hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide devidethree hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
									<button type="button" class="btn view loadmore-btn">Load More <i class="fa fa-angle-down loaddropdown" aria-hidden="true"></i></button>
									<button type="button" class="btn view showless-btn">Show Less <i class="fa fa-angle-up loaddropdown" aria-hidden="true"></i></button>
								</div>
							</div>
							<!--end business div-->
							<!--start event div-->
							<div class="eventmain businessevent">
								<h3 class="business-text">Events:</h3>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide devidethree hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide devidethree hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide devidethree hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide devidethree hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12divimgs">
										<a href="{{ route('frontend_more_event') }}"><img src="images/left3.png" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event') }}">Hawaai West</a></h4>
										<h5 class="colors">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event') }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<button type="button" class="btn favourite"><span class="favourite-btn"> Remove from Favourites</span></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
									<button type="button" class="btn view loadmore-btn">Load More <i class="fa fa-angle-down loaddropdown" aria-hidden="true"></i></button>
									<button type="button" class="btn view showless-btn">Show Less <i class="fa fa-angle-up loaddropdown" aria-hidden="true"></i></button>
								</div>
							</<div></div>>
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
@section('add-js')
<script type="text/javascript">
/*for load more*/
$(document).ready(function () {
    $('.showless-btn').hide();
    var right_length=3;

    // $('.businessmain').on('load',function() 
        right_li_length = $('.businessevent').find('.devide').length;
        console.log(right_li_length);
        if (right_li_length <= 3) {
            $('.businessevent').find('.devide').show().removeClass('hidelist').addClass('showlist');
            $(this).find('.loadmore-btn').hide();
        } else {
            $('.businessevent').find('.devide:lt('+right_length+')').show().removeClass('hidelist').addClass('showlist');
        }
    // });
    $('.loadmore-btn').click(function () {
        right_size_li = $(this).parent().parent().find(".devide").length;
        right_length= $(this).parent().parent().find(".showlist").length;
        right_length= (right_length+3 <= right_size_li) ? right_length+3 : right_size_li;
        $(this).parent().parent().find('.devide:lt('+right_length+')').slideDown(
        	).removeClass('hidelist').addClass('showlist');
         $(this).parent().find('.showless-btn').slideDown('fast');
        if(right_length == right_size_li){
            $(this).slideUp('fast');
    	};
	});

    $('.showless-btn').click(function () {
        right_length=(right_length - 6 < 0) ? 3 : right_length - 3;
        console.log(right_length);
        $(this).parent().parent().find('.devide').not(':lt('+right_length+')').slideUp('fast').removeClass('showlist').addClass('hidelist');
        $(this).parent().parent().find('.loadmore-btn').slideDown('fast');
         $(this).show();
        if(right_length == 3){
            $(this).slideUp('fast');
        }
	});

});
 /*for load more*/
</script>
@endsection