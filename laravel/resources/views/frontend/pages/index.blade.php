@section('meta_tag')
	<meta property="og:description" content="Efungenda"/>
	<meta property="og:image" content="{{ url('/images/logo.png') }}" />
@endsection
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
	  				{{ Form::radio('radio','1',null,['id'=>'radio1', 'class'=>'custom-control-input']) }}
	  				<span class="custom-control-indicator"></span>
	  				<span class="custom-control-description">Businesses</span>
				</label>
				<label class="custom-control custom-radio event-btn">
	  				{{ Form::radio('radio','2',true,['id'=>'radio2', 'class'=>'custom-control-input']) }}
	  				<span class="custom-control-indicator"></span>
	 				<span class="custom-control-description">Events</span>
				</label>
				@else
				<label class="custom-control custom-radio">
	  				{{ Form::radio('radio','1',true,['id'=>'radio1', 'class'=>'custom-control-input']) }}
	  				<span class="custom-control-indicator"></span>
	  				<span class="custom-control-description">Businesses</span>
				</label>
				<label class="custom-control custom-radio event-btn">
	  				{{ Form::radio('radio','2',null,['id'=>'radio2', 'class'=>'custom-control-input']) }}
	  				<span class="custom-control-indicator"></span>
	 				<span class="custom-control-description">Events</span>
				</label>
				@endif
			</div>
			<div class="col-lg-12 col-sm-12 col-xs-12 second-query">
	    			<div class="form-group indexformdiv homelocation-div">
	    				<label for="Location">Enter a Location or (
	    					<a href="javascript:void(0)" onclick="getLocation()">Set Location</a> )</label>
	      			   {{ Form::text('location',null,['id'=>'venue','class'=>'form-control boxinput location','placeholder'=>'Address or Zip Code']) }}
					</div>
					<div class="form-group indexformdiv home-select-div">
						<label for="Radius">Radius</label>
      					<!-- <div class="radselect"> -->
							{{ Form::select('radius',[40000=>'Any Radius',1=>'1 Mile Radius', 5=>'5 Mile Radius', 10=>'10 Mile Radius', 20=>'20 Mile Radius', 30=>'30 Mile Radius', 40=>'40 Mile Radius', 50=>'50 Mile Radius', 60=>'60 Mile Radius'], null,['class'=>'form-control custom-select boxinput', 'id'=>'radius'] ) }}
							<!-- <input type="text" id="radius" name="radius" class="form-control custom-select boxinput" placeholder="Enter a radius"> -->
						<!-- </div> -->
					</div>
					<div class="form-group indexformdiv">
						<label for="search">Search Terms</label>
	      				<div class="searchdiv">
  							{{ Form::select('tags[]',[],null,[ 'multiple'=>'multiple','class'=>'tagdropdown form-control search-tag categorydropdown boxinput' ]) }}
		      			</div>
					</div>
					<div class="form-group indexformdiv" id="fromDateDiv">
						<label for="FromDate">From Date</label>
						<span class="notranslate">
	      				{{ Form::text('fromdate',null,['id'=>'fromdate','class'=>'form-control boxinput datecalender datecalen','placeholder'=>'Select From Date']) }}
	      				</span>
	      				<i class="fa fa-calendar hometime" aria-hidden="true"></i>
	    				{{-- <span class="glyphicon glyphicon-calendar hometime"></span> --}}
	    			</div>
					<div class="form-group indexformdiv" id="toDateDiv">
						<label for="ToDate">To Date</label>
						<span class="notranslate">
      					{{ Form::text('todate',null,['id'=>'todate','class'=>'form-control boxinput datecalender','placeholder'=>'Select To Date']) }}
      					</span>
      					<i class="fa fa-calendar hometime" aria-hidden="true"></i>
    					{{-- <span class="glyphicon glyphicon-calendar hometime"></span> --}}
					</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes">
					<div class="form-group checkboxlist">
				    	{{ Form::checkbox('checkbox1',1,null, ['class' => 'checkbox-list','id'=>'kidfriendly']) }}
				    	<span></span>
			    		<label for="kidfriendly">Kid Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		{{ Form::checkbox('checkbox2',2,null, ['class' => 'checkbox-list','id'=>'petfriendly']) }}
			    		<span></span>
			    		<label for="petfriendly">Pet Friendly</label>
			    	</div>
			    	<div class="form-group checkboxlist">
			    		<!-- <input value="1,2" type="checkbox" class="checkbox-list" id="hasdiscounts" name="checkbox3" /> -->
			    		{{ Form::checkbox('checkbox3','1,2',null, ['class' => 'checkbox-list','id'=>'hasdiscounts']) }}
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
										<center><h2 class="nothingfound">Nothing Found</h2></center>
										@if(Auth::user())
											<center><a class="btn btn-secondary top-search" href="{{ url('/create-business') }}">Feel Free to add</a></center>
										@else
											<center><a class="btn btn-secondary top-search" href="#" data-toggle="modal" data-target="#myModal">Feel Free to sign in and add</a></center>
										@endif
									@else
										<div class="businessmain businessevent">
											<h3 class="business-text">Businesses:</h3>
											@foreach($all_search_business as $business)
											<div class="col-lg-12 col-md-12 col-xs-12 devide">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
													<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">
														@if(!empty($business['discount_rate']))
															<div class="ribbon-wrapper-green">
																<div class="img-discount-badge">
																	Discounts
																</div>
															</div>
														@endif
														@if(!empty($business['business_main_image']))
															@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business['business_main_image']) == 1)

																<img src="{{ url('images/business/'.$business['business_main_image']) }}" class="img-responsive thumb-img placeholder">

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


													<h5 class="colors">Listed in
													<a href="{{ route('frontend_category',['q'=> $business['category_id']]) }}">{{ $business->getCategory()->first()->name }}</a>
													</h5>
													<!-- @if( count($business['tags']) > 0 ) -->
													<!-- @foreach($business['tags'] as $value)
														@php
															$unserialize_array = unserialize($value['tags_id']);
														@endphp
														@foreach($unserialize_array as $tag)
															@php
																$counter++;
															@endphp
															<span class="listed_in_index">{{ TagName::getTagName($tag) }}{{ $counter != count($unserialize_array) ? ',' : '' }}</span>
														@endforeach
													@endforeach -->

												<!-- @endif -->

													<p class="left-sub-text">
														@if(!empty($business['business_description']))
															@if(mb_strlen($business['business_description']) > 150)
                                            					@php echo substr($business['business_description'],0,150); @endphp ...
                                        					@else
                                        						{{ $business['business_description'] }}
                                        					@endif
														@else
															No description
														@endif
													</p>
													<p class="read">
														<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More </a>
														{{-- @if(!empty($business['business_website']))

														<a target="_blank" href="//{{ $business['business_website'] }}">| Website</a>
														@endif --}}
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

														<a href="mailto:?subject=Click the link&body={{ url('/morebusiness?q=').$business['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

														<!-- <a class="btn btn-social-icon btn-twitter twitter" href="//{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a> -->

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url={{ url('/morebusiness?q=').$business['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

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
										<center><h2 class="nothingfound">Nothing Found</h2></center>
										@if(Auth::user())
											<center><a class="btn btn-secondary top-search" href="{{ url('/create-event') }}">Feel Free to add</a></center>
										@else
											<center><a class="btn btn-secondary top-search" href="#" data-toggle="modal" data-target="#myModal">Feel Free to sign in and add</a></center>
										@endif
									@else
										<div class="eventmain businessevent">
											<h3 class="business-text">Events:</h3>
											@foreach($all_search_events as $event)
												@if($event['show_event_status'] == 1)
													<div class="col-lg-12 col-md-12 col-xs-12 devide">
														<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
															<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">
																@if(!empty($event['discount_rate']))
																	<div class="ribbon-wrapper-green">
																		<div class="img-discount-badge">
																			Discounts
																		</div>
																	</div>
																@endif
																@if(!empty($event['event_main_image']))
																	@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event['event_main_image']) == 1)
																		<img src="{{ url('/images/event/'.$event['event_main_image']) }}" class="img-responsive thumb-img placeholder">
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

																<h5 class="colors">Listed in
																<a href="{{ route('frontend_category',['q'=> $event['category_id']]) }}">{{ $event->getCategory()->first()->name }}</a>
																</h5>
																<!-- @if( count($event['tags']) > 0 ) -->
																<!-- @foreach($event['tags'] as $value)
																	@php
																		$unserialize_array = unserialize($value['tags_id']);
																	@endphp
																	@foreach($unserialize_array as $tag)
																	@php
																		$counter++;
																	@endphp
																		<span class="listed_in_index">{{ TagName::getTagName($tag) }}{{ $counter != count($unserialize_array) ? ',' : '' }}</span>
																	@endforeach
																@endforeach -->

															<!-- @endif -->

															<p class="left-sub-text">
																@if(!empty($event['event_description']))
																	@if(mb_strlen($event['event_description']) > 150)
		                                            				@php echo substr($event['event_description'],0,150); @endphp ...
		                                        					@else
		                                        					{{ $event['event_description'] }}
		                                        					@endif
																@else
																	No description
																@endif
															</p>
															<p class="read">
																<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More </a>
																{{-- @if($event['event_website'])
																<a target="_blank" href="//{{ $event['event_website'] }}">| Website</a>
																@endif --}}
																@if(Auth::check() && Auth::user()->user_id == $event->created_by)
																	<a href="{{ route('edit_event',['q'=> $event['event_id']]) }}">| Edit</a>
																@endif
															</p>
														</div>
														<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
															<div class="fav-btn-container">
																@if(!Favourite::check($event['event_id'], 2))
																	<button type="button" data-id="{{ $event['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
																@else
																	<button type="button"  data-id="{{ $event['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
																@endif
															</div>


															<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event['fav_count'] }}</span> {{ $event['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>
															<div class="icon">


																<!-- <a class="btn btn-social-icon btn-facebook facebook" href="//{{ $event['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a> -->

																<!-- <div class="fb-share-button" data-href="{{ url('/moreevent?q=').$event['event_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

																<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

																<a href="mailto:?subject=Click the link&body={{ url('/moreevent?q=').$event['event_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

																<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

															</div>
														</div>
													</div>
												@endif
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
														@if(!empty($business['discount_rate']))
														<div class="ribbon-wrapper-green">
															<div class="img-discount-badge">
																Discounts
															</div>
														</div>
														@endif
														@if(!empty($business['business_main_image']))
															@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business['business_main_image']) == 1)

																<img src="{{ url('images/business/'.$business['business_main_image']) }}" class="img-responsive thumb-img placeholder">

															@else

																<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

															@endif
														@else
															<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
														@endif
													</a>

												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">
													@if(mb_strlen($business['business_title']) > 50)
                                            			@php echo substr($business['business_title'],0,50); @endphp ...
                                        			@else
                                            			{{$business['business_title']}}
                                        			@endif</a></h4>

												@php
													$counter = 0;
												@endphp


												<h5 class="colors">Listed in
													<a href="{{ route('frontend_category',['q'=> $business['category_id']]) }}">{{ $business->getCategory()->first()->name }}</a>
												</h5>

												<!-- @if( count($business['tags']) > 0 ) -->
													<!-- <h5 class="colors">Listed in
													<a href="{{ route('frontend_category',['q'=> $business['category_id']]) }}">{{ $business->getCategory()->first()->name }}</a> -->
													<!-- @foreach($business['tags'] as $value)
														@php
															$unserialize_array = unserialize($value['tags_id']);
														@endphp
														@foreach($unserialize_array as $tag)
															@php
																$counter++;
															@endphp
															<span class="listed_in_index">{{ TagName::getTagName($tag) }}{{ $counter != count($unserialize_array) ? ',' : '' }}</span>
														@endforeach
													@endforeach -->
													<!-- </h5> -->
												<!-- @endif -->

													<p class="left-sub-text">
														@if(!empty($business['business_description']))
															@if(mb_strlen($business['business_description']) > 150)
                                            					@php echo substr($business['business_description'],0,150); @endphp ...
                                        					@else
                                        						{{ $business['business_description'] }}
                                        					@endif
														@else
															No description
														@endif
													</p>
													<p class="read">
														<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More </a>
														{{-- @if(!empty($business['business_website']))
														<a target="_blank" href="//{{ $business['business_website'] }}">| Website</a>
														@endif --}}
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

														<a href="mailto:?subject=Click the link&body={{ url('/morebusiness?q=').$business['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>


														<!-- <a class="btn btn-social-icon btn-twitter twitter" href="//{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a> -->

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url={{ url('/morebusiness?q=').$business['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

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

							<div class="eventmain businessevent">
								@if(isset($all_events))
									@if( count($all_events) > 0 )
										<h3 class="business-text">Events:</h3>
										@foreach($all_events as $event)
											<div class="col-lg-12 col-md-12 col-xs-12 devide">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
													<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">
														@if(!empty($event['discount_rate']))
														<div class="ribbon-wrapper-green">
															<div class="img-discount-badge">
																Discounts
															</div>
														</div>
														@endif
														@if(!empty($event['event_main_image']))
															@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event['event_main_image']) == 1)
																<img src="{{ url('/images/event/'.$event['event_main_image']) }}" class="img-responsive thumb-img placeholder">
															@else
																<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

															@endif
														@else
															<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
														@endif
													</a>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">
													@if(mb_strlen($event['event_title']) > 50)
                                            			@php echo substr($event['event_title'],0,50); @endphp ...
                                        			@else
                                            			{{$event['event_title']}}
                                        			@endif
                                        			</a></h4>
													@php
														$counter = 0;
													@endphp


														<h5 class="colors">Listed in
														<a href="{{ route('frontend_category',['q'=> $event['category_id']]) }}">{{ $event->getCategory()->first()->name }}</a>
														</h5>

														<!-- @if( count($event['tags']) > 0 ) -->

														<!-- @foreach($event['tags'] as $value)
															@php

																$unserialize_array = unserialize($value['tags_id']);
															@endphp
															@foreach($unserialize_array as $tag)
																@php
																	$counter++;
																@endphp
																<span class="listed_in_index">{{ TagName::getTagName($tag) }}{{ $counter != count($unserialize_array) ? ',' : '' }}</span>
															@endforeach
														@endforeach -->

													<!-- @endif -->

													<p class="left-sub-text">
														@if(!empty($event['event_description']))
															@if(mb_strlen($event['event_description']) > 150)
                                            					@php echo substr($event['event_description'],0,150); @endphp ...
                                        					@else
                                        						{{ $event['event_description'] }}
                                        					@endif
														@else
															No description
														@endif

													</p>
													<p class="read">
														<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More </a>
														{{-- @if($event['event_website'])
														<a target="_blank" href="//{{ $event['event_website'] }}">| Website</a>
														@endif --}}
														@if(Auth::check() && Auth::user()->user_id == $event->created_by)
															<a href="{{ route('edit_event',['q'=> $event['event_id']]) }}">| Edit</a>
														@endif
													</p>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
													<div class="fav-btn-container">
														@if(!Favourite::check($event['event_id'], 2))
															<button type="button" data-id="{{ $event['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
														@else
															<button type="button"  data-id="{{ $event['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
														@endif
													</div>


													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event['fav_count'] }}</span> {{ $event['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>
													<div class="icon">

														<!-- <a class="btn btn-social-icon btn-facebook facebook" href="//{{ $event['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a> -->

														<!-- <div class="fb-share-button" data-href="{{ url('/moreevent?q=').$event['event_id'] }}" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div> -->

														<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

														<a href="mailto:?subject=Click the link&body={{ url('/moreevent?q=').$event['event_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

														<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
										@endforeach
										<div class="col-lg-12 col-md-12 col-xs-12 text-center">

										</div>
									@endif
								@endif

								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									@if(count($all_events) > count($all_business))
										<?php echo $all_events->setPath(route('fronted_home'))->render(); ?>
									@else
										<?php echo $all_business->setPath(route('fronted_home'))->render(); ?>
									@endif
								</div>
							</div>


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
	 	placeholder: "More terms like Yoga and Bicycle etc…",
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

    	$('#fromDateDiv').hide();
		$('#toDateDiv').hide();

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
		    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+long+'&sensor=false&key=AIzaSyDYv6KkTFndfHgNMvA4oPDxhiMMN3iKbhU',
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

// var options = {
//     enableHighAccuracy: true,
//     timeout: 3000,
//     maximumAge: 0
// };

/* use timeout: 0 || undefined to set location in safari browser */
var options = {
    enableHighAccuracy: true,
    timeout: 0 || undefined,
    maximumAge: 60000
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

function initAutocomplete() {
	var indexMoveFrom = new google.maps.places.Autocomplete(
		(document.getElementById('venue')),
		{types: ['geocode']});
}

</script>
@if(Session::get('input'))
	@if(Session::get('input')['radio'] == 2)
		<script>
			$(document).ready(function() {
				$('#fromDateDiv').show();
				$('#toDateDiv').show();
			});
		</script>
	@else
		<script>
			$(document).ready(function() {
				$('#fromDateDiv').hide();
				$('#toDateDiv').hide();
			});
		</script>
	@endif
@endif

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHZpcyDU3JbFSCUDIEN59Apxj4EqDomI&libraries=places&callback=initAutocomplete"
         async defer></script>

@endsection
