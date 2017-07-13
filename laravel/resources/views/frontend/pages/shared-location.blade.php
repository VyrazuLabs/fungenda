@extends('frontend.layouts.main.master')
@section('content')
<!--shared location heading with button start-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 sharedfirstdiv">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  shared">
				<p class="sharemaintext">Shared Public Locations</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sharedbtndiv">
				<button type="button" class="btn privatelocation">View my privately saved locations</button>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		</div>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharedmaindiv">
	<div class="container">
		<div class="shareddiv">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharepubliclocation">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 shareshadowdiv">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="searchterm">Search Term</label>
		      				<input type="text" id="searchterm" class="form-control shareinput" placeholder="Search Term i.e 'yoga' ">
	    				</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="city">City</label>
		      				<input type="text" id="city" class="form-control shareinput" placeholder="Type name of the city">
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="state">State</label>
		      				<input type="text" id="state" class="form-control shareinput" placeholder="Type name of the state">
						</div>
						<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca">CA</h2>
							<ul class="cllist">
								<li>Palo Alto</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Water Slides</a></li>
								</ul>
								<li>Tahoe City</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Camping by Lake</a></li>
								</ul>
								<li>San Francisco</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Test public Location 8/9/16</a></li>
								</ul>
								<li>Los Angeles</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Test Private</a></li>
								</ul>
								<li>San Francisco</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Halloween Store Test 8/9/16</a></li>
									<li><a href="{{ route('frontend_more_event') }}">Halloween Store</a></li>
									<li><a href="{{ route('frontend_more_event') }}">Rite Aid</a></li>
								</ul>
								<li>Los Gatos</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Halloween House</a></li>
									<li><a href="{{ route('frontend_more_event') }}">Spectrum Eye Physicians</a></li>
								</ul class="clsublist">
							</ul>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 fldiv">
							<h2 class="shareheadca shareheadfl">FL</h2>
							<ul class="cllist">
								<li>Boka Raton</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Sugar Sand Park</a></li>
								</ul>
								<li>Lake Buena Vista</li>
								<ul class="clsublist">
									<li><a href="{{ route('frontend_more_event') }}">Walt Disney World</a></li>
								</ul>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shareshadowdivright">
					<div class="sharedrightdiv">
						<p class="text-center locationfirstpara">You do not have a location set, so we are showing ALL Businesses and Events. To set a location,<a href="index.php"> perform a search.</a></p>
					</div>
					<h4 class="text-center mostfavouritetext">Most Favourited</h4>
					<div class="customdetailright sharedetail">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right1.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right2.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right3.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
					<h4 class="text-center mostfavouritetext">Recently Viewed</h4>
					<div class="customdetailright sharedetail">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right1.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right2.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right3.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
					<h4 class="text-center mostfavouritetext">Recently Updated</h4>
					<div class="customdetailright">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right1.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection