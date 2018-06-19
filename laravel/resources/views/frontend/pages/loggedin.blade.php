@extends('frontend.layouts.main.master')
@section('content')
<!--start search nearby-->
<div class="col-md-12">
	<div class="container">
		<p class="search-nearby">Search Nearby:</p>
	</div>
</div>
<div class="col-md-12">
	<div class="container">
		<div class="col-md-12 query-div">
			<div class="col-md-12 radio-btn">
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
			</div>
			<div class="col-md-12 second-query">
				<form>
	      			<div class="col-md-12 homeform">
	         			<div class="col-md-3 form-group locationset">
	      					<label for="disabledTextInput">Enter a Location or <a href="#">Set Location</a></label>
	      					<input type="text" id="disabledTextInput" name="location" class="form-control boxinput" placeholder="Address or Zip Code">
	    				</div>
	    				<div class="col-md-1 form-group radius">
	      					<label for="disabledTextInput">Radius</label>
	      					<select class="custom-select formdropdown" id="radius" name="radius">
								<option selected>Radius</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
	    				</div>
	    				<div class="col-md-4 form-group formsearch">
	      					<label for="disabledTextInput">Search Term</label>
	      					<input type="text" id="disabledTextInput" name="search" class="form-control boxinput" placeholder="Search Term i.e 'yoga' ">
	    				</div>
	    				<div class="col-md-2 form-group fromdate">
	      					<label for="disabledTextInput">From Date</label>
	      					<input type="text" id="disabledTextInput" name="formdate" class="form-control boxinput datecalender" placeholder="Select From Date">
	    					<i class="material-icons">date_range</i>
	    				</div>
	    				<div class="col-md-2 form-group fromdate">
	      					<label for="disabledTextInput">To Date</label>
	      					<input type="text" id="disabledTextInput" name="todate" class="form-control boxinput datecalender" placeholder="Select To Date">
	    					<i class="material-icons">date_range</i>
	    				</div>
	    			</div>
	    		</form>
	    	</div>
			<div class="col-md-12 checkboxes">
				<form>
					<div class="form-group checkboxlist">
				    	<input type="checkbox" class="checkbox-list" id="kidfriendly" name="checkbox1" checked />
				    	<span></span>
			    		<label for="c1" class="checkbox-list"  >Kid Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<input type="checkbox" id="petfriendly" name="checkbox2" />
			    		<span></span>
			    		<label for="c2">Pet Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<input type="checkbox" class="checkbox-list" id="hasdiscounts" name="checkbox3" />
			    		<span></span>
			    		<label for="c3">Has Discounts</label>
			    	</div>
			    </form>
	    		<button type="button" class="btn btn-secondary top-search">Search</button>
	    	</div>
   		</div>
	</div>
</div>
<!--end search nearby-->
<!--start business div-->
<div class="col-md-12">
	<div class="container">
		<p class="search-nearby">Offers/Discounts:</p>
	</div>
</div>
<div class="col-md-12">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button type="button" class="btn view">View All</button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button type="button" class="btn view">View All</button>
							</div>
						</div>
					</div>
					<div class="col-md-12 offertextdiv">
						<p class="search-nearby">My Favorites:</p>
					</div>
					<div class="leftcardshadow">
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button type="button" class="btn view">View All</button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
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
									<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
									<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
									<div class="icon">
										<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
										<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
										<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button type="button" class="btn view">View All</button>
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
