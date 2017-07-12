@extends('frontend.layouts.main.master')
@section('content')
<div class="col-md-12 sharedlocationmaindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 col-xs-12 leftcardshadow shareditemdiv">
						<div class="col-md-6 col-sm-6 col-xs-12 customleftsharediv">
							<div class="col-md-12 col-xs-12">
								<div class="sharenewtextbtndiv">
									<p class="customleftsharedivhead">Hawaai West</p>
									<h5 class="colors customleftsharedivsubtext">Listed in <a href="diningcategory.php">Bar(s),Dining.</a></h5>
									
									<div class="shareattendingdiv">
										<button type="button" class="btn favourite eventcustomsharedbtn"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
										<button type="button" class="btn favourite eventattendbtn"><span class="favourite-btn"> I am Attending</span></button>
									</div>
								</div>
								<p class="whoattending">Who's Attending?</p>
								<p class="attendingmail">tammiebayen@gmail.com,trudy</p>
								<p class="attendingmail">allanturner@gmail.com,allan</p>
								<p class="attendingmail">samwilson@gmail.com,sam</p>
								<p class="attendingmail">samwilson@gmail.com,sam</p>
								<p class="attendingmail dropseemore"><a href="#">See More <i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
								<div class="attendtime">
									<p class="startattendtime">Start Time: 9am</p>
									<p>Start Time: 5pm</p>
								</div>
								<p class="sharedcontactinfo">Contact Info</p>
								<p class="attendaddress">900 Stanford Shopping Center,Bldg W. Palo Alto,California</p>
								<p class="sharedcontactinfo">Hours:</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">July 25,2017</a></span> @ 7:30pm</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">July 26,2017</a></span> @ 7:30pm</p>
								<p class="attendtimedate"><span class="eventdatetime"><a href="#">July 27,2017</a></span> @ 7:30pm</p>
								<p class="bartag eventmoretag">Tags:
									<span class="barname">
										<a href="#">Bar</a>, 
										<a href="#">dive bar</a>, 
										<a href="#">juke box</a>, 
										<a href="#">pool tables</a>,
										<a href="#">tiki bar</a>
									</span>
								</p>
								<div class="shareattendicon eventmoreshareicon">
									<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
									<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
									<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 sharelocationcarousel">
							<div class="col-md-12 owlcarouseldiv">
								<div id="sync1" class="owl-carousel owl-theme">
									<div class="item">
										<img src="http://via.placeholder.com/350x290">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/350x290">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/350x290">
									</div>
								</div>
								<div id="sync2" class="owl-carousel owl-theme">
									<div class="item">
										<img src="http://via.placeholder.com/96x91">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/96x91">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/96x91">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/96x91">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/96x91">
									</div>
									<div class="item">
										<img src="http://via.placeholder.com/96x91">
									</div>
								</div>	
							</div>
							<div class="col-md-12 col-xs-12 mapdiv">
	  							<div class="googlemaping">
	  								<div id="map" class="googlemap"></div>
	  							</div>
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

@section('add-js')
<script type="text/javascript">
/*for owl carousel*/
	$(document).ready(function() {

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  var slidesPerPage = 3; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: false,
    autoplay: true,
    dots: false,
    loop: true,
    // responsiveRefreshRate : 200,
  }).on('changed.owl.carousel', syncPosition);

  sync2
    .on('initialized.owl.carousel', function () {
      sync2.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
    items : slidesPerPage,
    dots: false,
    nav: true,
    smartSpeed: 200,
    slideSpeed : 500,
    loop:true,
    slideBy: slidesPerPage,
    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
     //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
    // responsiveRefreshRate : 100,
  }).on('changed.owl.carousel', syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();
    
    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  
  function syncPosition2(el) {
    if(syncedSecondary) {
      var number = el.item.index;
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
  });
});
/*end owl carousel*/
</script>
@endsection