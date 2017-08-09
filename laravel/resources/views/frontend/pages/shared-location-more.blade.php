@extends('frontend.layouts.main.master')
@section('content')
<div class="col-md-12 sharedlocationmaindiv">
	<div class="container">
		<div class="col-md-12 business eventmoresection">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 col-xs-12 leftcardshadow">
						<div class="col-md-5 col-xs-12 customleftsharediv">
							<div class="col-md-12 col-xs-12">
								<div class="sharenewtextbtndiv">
									<p class="customleftsharedivhead">Hawaai West</p>
									<h5 class="colors customleftsharedivsubtext">Listed in <a href="#">Bar(s),Dining.</a></h5>
									<button type="button" class="btn favourite customsharedbtn"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
									<div class="shareattendingdiv">
										<button type="button" class="btn favourite attendbtn"><span class="favourite-btn"> I am Attending</span></button>
									</div>
								</div>
								<p class="whoattending">Description</p>
								<p class="attendingmail decriptiondetail">
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
									Lorem Ipsum ht is a long established act that a reader will be distracted 
									by the readable content of a page when looking at its layout.The point 
									of using Lorem Ipsum is that it
								</p>
								<!-- <div class="attendtime">
									<p class="startattendtime">Start Time: 9am</p>
									<p>Start Time: 5pm</p>
								</div> -->
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress">900 Stanford Shopping Center,Bldg W. Palo Alto,California</p>
								<!-- <p class="sharedcontactinfo">Hours:</p>
								<p class="attendtimedate">24th May 16:00 - 18.00 Hrs</p> -->
								<p class="bartag">Tags:
									<span class="barname">
										<a href="#">Bar</a>, 
										<a href="#">dive bar</a>, 
										<a href="#">juke box</a>, 
										<a href="#">pool tables</a>,
										<a href="#">tiki bar</a>
									</span>
								</p>
								<div class="shareattendicon">
									<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
									<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
									<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
								</div>
							</div>
						</div>
						<div class="col-md-7 col-xs-12 sharelocationcarousel">
							<div id="sync1" class="owl-carousel owl-theme">
								<div class="item">
									<img src="images/event_more_carasl.jpg">
								</div>
								<div class="item">
									<img src="images/event_more_carasl.jpg">
								</div>
								<div class="item">
									<img src="images/event_more_carasl.jpg">
								</div>
							</div>
							<div id="sync2" class="owl-carousel owl-theme">
								<div class="item">
									<img src="images/right1.png">
								</div>
								<div class="item">
									<img src="images/right2.png">
								</div>
								<div class="item">
									<img src="images/right3.png">
								</div>
								<div class="item">
									<img src="images/event_more_carasl.jpg">
								</div>
								<div class="item">
									<img src="images/right2.png">
								</div>
								<div class="item">
									<img src="images/right3.png">
								</div>
  							</div>
  							<div class="googlemaping">
  								<div id="map" class="googlemap"></div>
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