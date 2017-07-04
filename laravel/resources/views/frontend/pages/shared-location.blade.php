@extends('frontend.layouts.main.master')
@section('content')
<!--shared location heading with button start-->
<div class="col-md-12">
	<div class="container">
		<div class="col-md-9 sharedfirstdiv">
			<div class="col-md-6 shared">
				<p class="sharemaintext">Shared Public Locations</p>
			</div>
			<div class="col-md-6 col-xs-12 sharedbtndiv">
				<button type="button" class="btn privatelocation">View my privately saved locations</button>
			</div>
		</div>
		<div class="col-md-3">
		</div>
	</div>
</div>
<div class="col-md-12 sharedmaindiv">
	<div class="container">
		<div class="shareddiv">
			<div class="col-md-12">
				<div class="col-md-9 shareshadowdiv">
					<div class="col-md-12">
						<div class="col-md-4 form-group sharegroup">
							<label for="disabledTextInput">Search Term</label>
		      				<input type="text" id="disabledTextInput" class="form-control shareinput" placeholder="Search Term i.e 'yoga' ">
	    				</div>
						<div class="col-md-4 form-group sharegroup">
							<label for="disabledTextInput">City</label>
		      				<input type="text" id="disabledTextInput" class="form-control shareinput" placeholder="Type name of the city">
						</div>
						<div class="col-md-4 form-group sharegroup">
							<label for="disabledTextInput">State</label>
		      				<input type="text" id="disabledTextInput" class="form-control shareinput" placeholder="Type name of the state">
						</div>
						<div class="col-md-5 divca">
							<h2 class="shareheadca">CA</h2>
							<ul class="cllist">
								<li>Palo Alto</li>
								<ul class="clsublist">
									<li><a href="#">Water Slides</a></li>
								</ul>
								<li>Tahoe City</li>
								<ul class="clsublist">
									<li><a href="#">Camping by Lake</a></li>
								</ul>
								<li>San Francisco</li>
								<ul class="clsublist">
									<li><a href="#">Test public Location 8/9/16</a></li>
								</ul>
								<li>Los Angeles</li>
								<ul class="clsublist">
									<li><a href="#">Test Private</a></li>
								</ul>
								<li>San Francisco</li>
								<ul class="clsublist">
									<li><a href="#">Halloween Store Test 8/9/16</a></li>
									<li><a href="#">Halloween Store</a></li>
									<li><a href="#">Rite Aid</a></li>
								</ul>
								<li>Los Gatos</li>
								<ul class="clsublist">
									<li><a href="#">Halloween House</a></li>
									<li><a href="#">Spectrum Eye Physicians</a></li>
								</ul class="clsublist">
							</ul>
						</div>
						<div class="col-md-7 fldiv">
							<h2 class="shareheadca shareheadfl">FL</h2>
							<ul class="cllist">
								<li>Boka Raton</li>
								<ul class="clsublist">
									<li><a href="#">Sugar Sand Park</a></li>
								</ul>
								<li>Lake Buena Vista</li>
								<ul class="clsublist">
									<li><a href="#">Walt Disney World</a></li>
								</ul>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3 shareshadowdivright">
					<div class="sharedrightdiv">
						<p class="text-center locationfirstpara">You do not have a location set, so we are showing ALL Businesses and Events. To set a location,<a href="#"> perform a search.</a></p>
					</div>
					<h4 class="text-center mostfavouritetext">Most Favourited</h4>
					<div class="customdetailright sharedetail">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right1.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right2.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right3.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
					<h4 class="text-center mostfavouritetext">Recently Viewed</h4>
					<div class="customdetailright sharedetail">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right1.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right2.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right3.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
					<h4 class="text-center mostfavouritetext">Recently Updated</h4>
					<div class="customdetailright">
						<div class="col-md-12 col-xs-12 righttextimg">
							<div class="col-md-6 col-xs-6 rightimg">
								<img src="images/right1.png" class="img-responsive">
							</div>
							<div class="col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head">Hawaii West</p>
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