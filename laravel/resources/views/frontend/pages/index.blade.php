@extends('frontend.layouts.main.master')
@section('content')
<!--start search nearby-->
<div class="col-lg-12 col-md-12 col-xs-12">
	<div class="container">
		<p class="search-nearby">Search Nearby:</p>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-xs-12">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 query-div">
			<div class="cl-lg-12 col-md-12 col-xs-12 radio-btn">
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
			<div class="col-lg-12 col-sm-12 col-xs-12 second-query">
	    		<form>
	    			<div class="form-group indexformdiv">
	    				<label for="Location">Enter a Location or <a href="#">Set Location</a></label>
	      				<input type="text" id="zipcode" name="location" class="form-control boxinput location" placeholder="Address or Zip Code">
					</div>
					<div class="form-group indexformdiv">
						<label for="Radius">Radius</label>
      					<div class="radselect">
	      					<select class="form-control custom-select formdropdown boxinput" id="radius" name="radius">
								<option selected>Radius</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
						</div>
					</div>
					<div class="form-group indexformdiv">
						<label for="search">Search Term</label>
	      				<input type="text" id="search" name="search" class="form-control boxinput searchdiv" placeholder="Search Term i.e 'yoga' ">
					</div>
					<div class="form-group indexformdiv">
						<label for="FromDate">From Date</label>
	      				<input type="text" id="fromdate" name="fromdate" class="form-control boxinput datecalender datecalen" placeholder="Select From Date">
	    				<i class="material-icons hometime">date_range</i>
	    			</div>
					<div class="form-group indexformdiv">
						<label for="ToDate">To Date</label>
      					<input type="text" id="todate" name="todate" class="form-control boxinput datecalender" placeholder="Select To Date">
    					<i class="material-icons hometime">date_range</i></span>
					</div>
				</form>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes">
				<form>
					<div class="form-group checkboxlist">
				    	<input type="checkbox" class="checkbox-list" id="kidfriendly" name="checkbox1" checked />
				    	<span></span>
			    		<label for="kidfriendly">Kid Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<input type="checkbox" id="petfriendly" class="checkbox-list" name="checkbox2" />
			    		<span></span>
			    		<label for="petfriendly">Pet Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<input type="checkbox" class="checkbox-list" id="hasdiscounts" name="checkbox3" />
			    		<span></span>
			    		<label for="hasdiscounts">Has Discounts</label>
			    	</div>
			    </form>
	    		<button type="button" class="btn btn-secondary top-search">Search</button>
	    	</div>
   		</div>
	</div>
</div>
<!--end search nearby-->
<!--start business div-->
<div class="col-md-12 col-xs-12 maindiv">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 business">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 custombox">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 left-div">
					<div class="col-lg-12 col-md-12 col-xs-12 leftcardshadow">
						<div class="customdetail">
							<div class="businessmain businessevent">
								<h3 class="business-text">Businesses:</h3>
								@foreach($all_business as $business)
								<div class="col-lg-12 col-md-12 col-xs-12 devide">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}"><img src="{{ url('images/business/'.$business['image'][0]) }}" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a></h4>
										<h5 class="colors">Listed in <a href="{{ route('frontend_category',['q'=> $business['category_id']]) }} ">{{ $business->getCategory()->first()->name }}</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										
										<button type="button" data-id="{{ $business['business_id'] }}" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
										
										<button type="button" data-id="{{ $business['business_id'] }}" class="btn favourite rvm_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
										
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								@endforeach
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									<button type="button" class="btn view">View All</button>
								</div>
							</div>
							<!--end business div-->
							<!--start event div-->
							<div class="eventmain businessevent">
								<h3 class="business-text">Events:</h3>
								@foreach($all_events as $event)
								<div class="col-lg-12 col-md-12 col-xs-12 devide">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></h4>
										<h5 class="colors">Listed in <a href="{{ route('frontend_category',['q'=> $event['category_id']]) }}">{{ $event->getCategory()->first()->name }}</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
									
										<button type="button" data-id="{{ $event['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
										
										
										<button type="button"  data-id="{{ $event['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
										
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								@endforeach
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									<button type="button" class="btn view">View All</button>
								</div>
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									{{ $all_events->links() }}
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
	$('.datecalender').datetimepicker({
	    format: 'L'
	});
	$(".datecalender").on("dp.show", function (e) {
        $(this).parent().addClass('dates');
    });
	$(".datecalender").on("dp.hide", function (e) {
        $(this).parent().removeClass('dates');
    });

</script>
@endsection