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
		{{ Form::open(['method'=>'post','files'=>'true','url'=>'/search']) }}
			<div class="cl-lg-12 col-md-12 col-xs-12 radio-btn">
				<label class="custom-control custom-radio">
	  				<input value="1" id="radio1" name="radio" type="radio" class="custom-control-input">
	  				<span class="custom-control-indicator"></span>
	  				<span class="custom-control-description">Businesses</span>
				</label>
				<label class="custom-control custom-radio event-btn">
	  				<input value="2" id="radio2" name="radio" type="radio" class="custom-control-input" checked>
	  				<span class="custom-control-indicator"></span>
	 				<span class="custom-control-description">Events</span>
				</label>
			</div>
			<div class="col-lg-12 col-sm-12 col-xs-12 second-query">
	    			<div class="form-group indexformdiv">
	    				<label for="Location">Enter a Location or <a href="#">Set Location</a></label>
	      				<input type="text" id="venue" name="location" class="form-control boxinput location" placeholder="Address or Zip Code">
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
	      				<div class="searchdiv">
		      				<select multiple="multiple" class="tagdropdown form-control search-tag categorydropdown boxinput" name="tags[]">
		      				</select>
		      			</div>
					</div>
					<div class="form-group indexformdiv">
						<label for="FromDate">From Date</label>
	      				<input type="text" id="fromdate" name="fromdate" class="form-control boxinput datecalender datecalen" placeholder="Select From Date">
	      				<i class="fa fa-calendar hometime" aria-hidden="true"></i>
	    				{{-- <span class="glyphicon glyphicon-calendar hometime"></span> --}}
	    			</div>
					<div class="form-group indexformdiv">
						<label for="ToDate">To Date</label>
      					<input type="text" id="todate" name="todate" class="form-control boxinput datecalender" placeholder="Select To Date">
      					<i class="fa fa-calendar hometime" aria-hidden="true"></i>
    					{{-- <span class="glyphicon glyphicon-calendar hometime"></span> --}}
					</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes">
					<div class="form-group checkboxlist">
				    	<input value="1" type="checkbox" class="checkbox-list" id="kidfriendly" name="checkbox1" checked />
				    	<span></span>
			    		<label for="kidfriendly">Kid Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<input value="2" type="checkbox" id="petfriendly" class="checkbox-list" name="checkbox2" />
			    		<span></span>
			    		<label for="petfriendly">Pet Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<input value="3" type="checkbox" class="checkbox-list" id="hasdiscounts" name="checkbox3" />
			    		<span></span>
			    		<label for="hasdiscounts">Has Discounts</label>
			    	</div>
	    		<button type="submit" class="btn btn-secondary top-search">Search</button>
	    	{{ Form::close() }}
	    	</div>
   		</div>
	</div>
</div>
<!--end search nearby-->
<!--start business div-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 maindiv">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 business">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 custombox">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 left-div">
					<div class="col-lg-12 col-md-12 col-xs-12 leftcardshadow">
						<div class="customdetail">
							@if( count($all_business) > 0 )
								<div class="businessmain businessevent">
									<h3 class="business-text">Businesses:</h3>
									@foreach($all_business as $business)
									<div class="col-lg-12 col-md-12 col-xs-12 devide">
										<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">

												@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business['image'][0]) == 1)

													<img src="{{ url('images/business/'.$business['image'][0]) }}" class="img-responsive thumb-img placeholder">

												@else

													<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

												@endif
											</a>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
											<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a></h4>
											
										@if( count($business['tags']) > 0 )
											<h5 class="colors">Listed in 
											@foreach($business['tags'] as $value)
												@php
													$unserialize_array = unserialize($value['tags_id']);
												@endphp
												@foreach($unserialize_array as $tag)
													<a href="#">{{ TagName::getTagName($tag) }},</a>
												@endforeach
											@endforeach
											</h5>
										@endif

											<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
											<p class="read">
												<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More |</a>
												<a target="_blank" href="{{ $business['business_website'] }}">Website</a>
												@if(Auth::check() && Auth::user()->user_id == $business->created_by)
													<a href="{{ route('edit_business',['q'=> $business['business_id']]) }}">| Edit</a>
												@endif
											</p>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
										<div class="fav-btn-container">
											@if(!Favourite::check($business['business_id'], 1))
												<button type="button" data-id="{{ $business['business_id'] }}" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											@else
												<button type="button" data-id="{{ $business['business_id'] }}" class="btn favourite rvm_fav_business"><i class="fa fa-heart"  aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											@endif
										</div>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $business['fav_count'] }}</span> FAVORITES</span></p>

										<div class="icon">

										@if($business['business_fb_link'])
												<a class="btn btn-social-icon btn-facebook facebook" href="{{ $business['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>
										@endif


												<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $business['business_email'] }}"><span class="fa fa-envelope"></span></a>

											@if($business['business_twitter_link'])

												<a class="btn btn-social-icon btn-twitter twitter" href="{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

											@endif

											</div>
										</div>
									</div>
									@endforeach
									<div class="col-lg-12 col-md-12 col-xs-12 text-center">
										
									</div>
								</div>
							@endif
							<!--end business div-->
							<!--start event div-->
							@if( count($all_events) > 0 )
								<div class="eventmain businessevent">
									<h3 class="business-text">Events:</h3>
									@foreach($all_events as $event)
									<div class="col-lg-12 col-md-12 col-xs-12 devide">
										<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">

												@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event['image'][0]) == 1)
													<img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img placeholder">
												@else
													<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

												@endif
											</a>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
											<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></h4>

											@if( count($event['tags']) > 0 )
												<h5 class="colors">Listed in 
												@foreach($event['tags'] as $value)
													@php
														$unserialize_array = unserialize($value['tags_id']);
													@endphp
													@foreach($unserialize_array as $tag)
														<a href="#">{{ TagName::getTagName($tag) }},</a>
													@endforeach
												@endforeach
												</h5>
											@endif

											<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
											<p class="read">
												<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More </a>
												<a target="_blank" href="{{ $event['event_website'] }}">| Website</a>
												@if(Auth::check() && Auth::user()->user_id == $event->created_by)
													<a href="{{ route('edit_event',['q'=> $event['event_id']]) }}">| Edit</a>
												@endif
											</p>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
											<div class="fav-btn-container">
												@if(!Favourite::check($event['event_id'], 2))
													<button type="button" data-id="{{ $event['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
												@else
													<button type="button"  data-id="{{ $event['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favourites</span></i></button>
												@endif												
											</div>
											

											<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event['fav_count'] }}</span> FAVORITES</span></p>
											<div class="icon">

											@if($event['event_fb_link'])

												<a class="btn btn-social-icon btn-facebook facebook" href="{{ $event['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>

											@endif

												<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $event['event_email'] }}"><span class="fa fa-envelope"></span></a>

											@if($event['event_twitter_link'])

												<a class="btn btn-social-icon btn-twitter twitter" href="{{ $event['event_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

											@endif

											</div>
										</div>
									</div>
									@endforeach
									<div class="col-lg-12 col-md-12 col-xs-12 text-center">
										
									</div>
									<div class="col-lg-12 col-md-12 col-xs-12 text-center">
										{{ $all_events->links() }}
									</div>
								</div>
							@endif

							@if( count($all_events) == 0 && count($all_business) == 0 )
								<h4 class="nothing-found">Nothing found</h4>
							@endif
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
@section('add-js')
<script type="text/javascript">
	 $(".search-tag").select2({
	 	tags: true
	 });
</script>
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