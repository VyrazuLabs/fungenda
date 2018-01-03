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
		
		@if(Session::get('input'))
			{{ Form::model(Session::get('input')) }}
		@endif
			<div id="map"></div>
			<div class="cl-lg-12 col-md-12 col-xs-12 radio-btn">
				@if(Session::get('radio') == 2)
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
				@else
				<label class="custom-control custom-radio">
	  				<input value="1" id="radio1" name="radio" type="radio" class="custom-control-input" checked>
	  				<span class="custom-control-indicator"></span>
	  				<span class="custom-control-description">Businesses</span>
				</label>
				<label class="custom-control custom-radio event-btn">
	  				<input value="2" id="radio2" name="radio" type="radio" class="custom-control-input">
	  				<span class="custom-control-indicator"></span>
	 				<span class="custom-control-description">Events</span>
				</label>
				@endif	
			</div>
			<div class="col-lg-12 col-sm-12 col-xs-12 second-query">
	    			<div class="form-group indexformdiv homelocation-div">
	    				<label for="Location">Set <a href="javascript:void(0)" onclick="getLocation()">Location</a></label>
	      				<input type="text" id="venue" name="location" class="form-control boxinput location" placeholder="Address or Zip Code">
					</div>
					<div class="form-group indexformdiv home-select-div">
						<label for="Radius">Radius</label>
      					<!-- <div class="radselect"> -->
	      					<!-- <select class="form-control custom-select formdropdown boxinput" id="radius" name="radius">
								<option selected>Radius</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select> -->
							<input type="text" id="radius" name="radius" class="form-control custom-select formdropdown boxinput" placeholder="Enter a radius">
						<!-- </div> -->
					</div>
					<div class="form-group indexformdiv">
						<label for="search">Search Term</label>
	      				<div class="searchdiv">
		      				<select multiple="multiple" class="tagdropdown form-control search-tag categorydropdown boxinput" name="tags[]">
		      				</select>
		      			</div>
					</div>
					<div class="form-group indexformdiv" id="fromDateDiv">
						<label for="FromDate">From Date</label>
						<span class="notranslate">
	      				<input type="text" id="fromdate" name="fromdate" class="form-control boxinput datecalender datecalen" placeholder="Select From Date">
	      				</span>
	      				<i class="fa fa-calendar hometime" aria-hidden="true"></i>
	    				{{-- <span class="glyphicon glyphicon-calendar hometime"></span> --}}
	    			</div>
					<div class="form-group indexformdiv" id="toDateDiv">
						<label for="ToDate">To Date</label>
						<span class="notranslate">
      					<input type="text" id="todate" name="todate" class="form-control boxinput datecalender" placeholder="Select To Date">
      					</span>
      					<i class="fa fa-calendar hometime" aria-hidden="true"></i>
    					{{-- <span class="glyphicon glyphicon-calendar hometime"></span> --}}
					</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes">
					<div class="form-group checkboxlist">
				    	<input value="1" type="checkbox" class="checkbox-list" id="kidfriendly" name="checkbox1"/>
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
							
							@if(isset($all_search_business) || isset($all_search_events))
								@if(isset($all_search_business))
									@if(empty($all_search_business))
										<center><h2>No result found</h2></center>
									@else
										<div class="businessmain businessevent">
											<h3 class="business-text">Businesses:</h3>
											@foreach($all_search_business as $business)
											<div class="col-lg-12 col-md-12 col-xs-12 devide">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
													<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">
														@if(!empty($business['image'][0]))
															@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business['image'][0]) == 1)

																<img src="{{ url('images/business/'.$business['image'][0]) }}" class="img-responsive thumb-img placeholder">

															@else

																<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

															@endif
														@else
															<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
														@endif
													</a>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a></h4>
												@php
													$counter = 0;
												@endphp
													
												@if( count($business['tags']) > 0 )
													<h5 class="colors">Listed in 
													@foreach($business['tags'] as $value)
														@php
															$unserialize_array = unserialize($value['tags_id']);
														@endphp
														@foreach($unserialize_array as $tag)
															@php
																$counter++;
															@endphp
															<span class="listed_in_index">{{ TagName::getTagName($tag) }} {{ $counter != count($unserialize_array) ? ',' : '' }}</span>
														@endforeach
													@endforeach
													</h5>
												@endif

													<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
													<p class="read">
														<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More </a>
														@if(!empty($business['business_website']))
														<a target="_blank" href="//{{ $business['business_website'] }}">| Website</a>
														@endif
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

												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $business['fav_count'] }}</span> {{ $business['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>

												<div class="icon">

														<!-- <a class="btn btn-social-icon btn-facebook facebook" href="//{{ $business['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a> -->

														<!-- <div class="fb-share-button" data-href="{{ url('/morebusiness?q=').$business['business_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

														<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/morebusiness?q=').$business['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

														<a href="mailto:{{ $business['business_email'] }}?subject=Click the link&body={{ url('/morebusiness?q=').$business['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

														<!-- <a class="btn btn-social-icon btn-twitter twitter" href="//{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a> -->

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url={{ url('/morebusiness?q=').$business['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											@endforeach
											<div class="col-lg-12 col-md-12 col-xs-12 text-center">
												
											</div>
										</div>
									@endif
								@endif
								@if(isset($all_search_events))
									@if(empty($all_search_events))
										<center><h2>No result found</h2></center>
									@else
										<div class="eventmain businessevent">
											<h3 class="business-text">Events:</h3>
											@foreach($all_search_events as $event)
											<div class="col-lg-12 col-md-12 col-xs-12 devide">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
													<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">
														@if(!empty($event['image'][0]))
															@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event['image'][0]) == 1)
																<img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img placeholder">
															@else
																<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

															@endif
														@else
															<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
														@endif
													</a>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></h4>
													@php
														$counter = 0;
													@endphp							
													@if( count($event['tags']) > 0 )
														<h5 class="colors">Listed in 
														@foreach($event['tags'] as $value)
															@php
																$unserialize_array = unserialize($value['tags_id']);
															@endphp
															@foreach($unserialize_array as $tag)
															@php
																$counter++;
															@endphp
																<span class="listed_in_index">{{ TagName::getTagName($tag) }} {{ $counter != count($unserialize_array) ? ',' : '' }}</span>
															@endforeach
														@endforeach
														</h5>
													@endif

													<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
													<p class="read">
														<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More </a>
														@if($event['event_website'])
														<a target="_blank" href="//{{ $event['event_website'] }}">| Website</a>
														@endif
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
													

													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event['fav_count'] }}</span>{{ $event['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>
													<div class="icon">


														<!-- <a class="btn btn-social-icon btn-facebook facebook" href="//{{ $event['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a> -->

														<!-- <div class="fb-share-button" data-href="{{ url('/moreevent?q=').$event['event_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

														<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

														<a href="mailto:{{ $event['event_email'] }}?subject=Click the link&body={{ url('/moreevent?q=').$event['event_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

														<!-- <a class="btn btn-social-icon btn-twitter twitter" href="//{{ $event['event_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a> -->

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											@endforeach
											<div class="col-lg-12 col-md-12 col-xs-12 text-center">
												
											</div>
											<div class="col-lg-12 col-md-12 col-xs-12 text-center">
											</div>
										</div>
									@endif
								@endif
							@endif
							@if(!isset($all_search_business) && !isset($all_search_events))
								@if(isset($all_business))
									@if( count($all_business) > 0 )
										<div class="businessmain businessevent">
											<h3 class="business-text">Businesses:</h3>
											@foreach($all_business as $business)
											<div class="col-lg-12 col-md-12 col-xs-12 devide">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
													<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">
														
														@if(!empty($business['image'][0]))
															@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business['image'][0]) == 1)

																<img src="{{ url('images/business/'.$business['image'][0]) }}" class="img-responsive thumb-img placeholder">

															@else

																<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

															@endif
														@else
															<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
														@endif
													</a>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a></h4>
												@php
													$counter = 0;
												@endphp
													
												@if( count($business['tags']) > 0 )
													<h5 class="colors">Listed in 
													@foreach($business['tags'] as $value)
														@php
															$unserialize_array = unserialize($value['tags_id']);
														@endphp
														@foreach($unserialize_array as $tag)
															@php
																$counter++;
															@endphp
															<span class="listed_in_index">{{ TagName::getTagName($tag) }}{{ $counter != count($unserialize_array) ? ',' : '' }}</span>
														@endforeach
													@endforeach
													</h5>
												@endif

													<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
													<p class="read">
														<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More </a>
														@if(!empty($business['business_website']))
														<a target="_blank" href="//{{ $business['business_website'] }}">| Website</a>
														@endif
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

												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $business['fav_count'] }}</span> {{ $business['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>

												<div class="icon">

														<!-- <a class="btn btn-social-icon btn-facebook facebook" href="//{{ $business['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a> -->

														<!-- <div class="fb-share-button" data-href="{{ url('/morebusiness?q=').$business['business_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

														<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/morebusiness?q=').$business['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

														<a href="mailto:{{ $business['business_email'] }}?subject=Click the link&body={{ url('/morebusiness?q=').$business['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>


														<!-- <a class="btn btn-social-icon btn-twitter twitter" href="//{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a> -->

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url={{ url('/morebusiness?q=').$business['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											@endforeach
											<div class="col-lg-12 col-md-12 col-xs-12 text-center">
												
											</div>
										</div>
									@endif
								@endif
							<!--end business div-->
							<!--start event div-->
								@if(isset($all_events))
									@if( count($all_events) > 0 )
										<div class="eventmain businessevent">
											<h3 class="business-text">Events:</h3>
											@foreach($all_events as $event)
											<div class="col-lg-12 col-md-12 col-xs-12 devide">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
													<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">
														@if(!empty($event['image'][0]))
															@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event['image'][0]) == 1)
																<img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img placeholder">
															@else
																<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

															@endif
														@else
															<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
														@endif
													</a>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></h4>
													@php
														$counter = 0;
													@endphp

													@if( count($event['tags']) > 0 )
														<h5 class="colors">Listed in 
														@foreach($event['tags'] as $value)
															@php

																$unserialize_array = unserialize($value['tags_id']);
															@endphp
															@foreach($unserialize_array as $tag)
																@php
																	$counter++;	
																@endphp
																<span class="listed_in_index">{{ TagName::getTagName($tag) }} {{ $counter != count($unserialize_array) ? ',' : '' }}</span>
															@endforeach
														@endforeach
														</h5>
													@endif

													<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
													<p class="read">
														<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More </a>
														@if($event['event_website'])
														<a target="_blank" href="//{{ $event['event_website'] }}">| Website</a>
														@endif
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
													

													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event['fav_count'] }}</span> {{ $event['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>
													<div class="icon">

														<!-- <a class="btn btn-social-icon btn-facebook facebook" href="//{{ $event['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a> -->

														<!-- <div class="fb-share-button" data-href="{{ url('/moreevent?q=').$event['event_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

														<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

														<a href="mailto:{{ $event['event_email'] }}?subject=Click the link&body={{ url('/moreevent?q=').$event['event_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

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
								@endif
								
								@if(isset($all_events))
									@if( count($all_events) == 0 && count($all_business) == 0 )
										<div class="eventmain businessevent">
											<center><img style="margin-top: 56px; margin-bottom: 30px;" src="{{ url('/images/error/Image_from_Skype1.png') }}" height="100" width="100"></center><br>
											<center><h4>Nothing Found...</h4></center>
											<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
										</div>
									@endif
								@endif
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
<div id="fb-root"></div>

@endsection
@section('add-js')
<script type="text/javascript">
	 $(".search-tag").select2({
	 	placeholder: "Search term i.e 'Yoga'",
	 	tags: true
	 });
</script>
<script type="text/javascript">
	$('.datecalender').datetimepicker({
	    format: 'L',
	});
	$(".datecalender").on("dp.show", function (e) {
        $(this).parent().addClass('dates');
        $(this).addClass('notranslate');
    });
	$(".datecalender").on("dp.hide", function (e) {
        $(this).parent().removeClass('dates');
    });


    $(document).ready(function(){
    	$('#radio1').click(function(){
    		$('#fromDateDiv').hide();
    		$('#toDateDiv').hide();
    	});
    	$('#radio2').click(function(){
    		$('#fromDateDiv').show();
    		$('#toDateDiv').show();
    	});
    });
</script>
<script>
$('#radius').on('change',function(){
	var x = document.getElementById("demo");
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition);
	    } else { 
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }

	function showPosition (position) {
	    var latitude = position.coords.latitude;
	    var longitude = position.coords.longitude;
	    $.ajax({
	    	headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
	    	url: "{{ url('/set-session') }}",
	    	type: 'post',
	    	data: {
	    		'latitude': latitude,
	    		'longitude': longitude 
	    	},
	    	success: function(data){
	    		// console.log(data);
	    	}
	    })
	    
	}
});
</script>
<script>

var showPositions = function(positions) {
	console.log('success');
    var lat = positions.coords.latitude;
    var long = positions.coords.longitude;
    $.ajax({
		    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+long+'&sensor=false',
		    success: function(data){
		    	var address = data['results'][0]['formatted_address'];
		    	$('#venue').val(address);
		   },
		});
}

var errorCallback = function(error){
	console.log('error');
	console.log(error);
    var errorMessage = 'Unknown error';
    switch(error.code) {
      case 1:
        errorMessage = 'Permission denied';
        break;
      case 2:
        errorMessage = 'Position unavailable';
        break;
      case 3:
        errorMessage = 'Timeout';
        break;
    }
    alert(errorMessage);
};

var options = {
    enableHighAccuracy: true,
    timeout: 3000,
    maximumAge: 0
};

function getLocation() {
    if (navigator.geolocation) {
    	console.log(navigator.geolocation);
    	console.log('test');
        navigator.geolocation.getCurrentPosition(showPositions,errorCallback,options);
    } else { 
       console.log("Geolocation is not supported by this browser.");
    }
}

</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

@endsection