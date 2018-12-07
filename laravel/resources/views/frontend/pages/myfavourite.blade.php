@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<p class="search-nearby myfav">My Favorites:</p>
	</div>
</div>
<!--end search nearby-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myfavdiv">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 business">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 custombox">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 left-div">
					{{ Form::open(['method'=>'post', 'url'=>'/my-favourite/search']) }}
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow favouritesearch">
						<label class="custom-control custom-radio event-btn">
							@if(Session::get('radio') == 2)
			  					<input id="radio2" value="2" name="radio" type="radio" class="custom-control-input" checked>
			  				@else
			  					<input id="radio2" value="2" name="radio" type="radio" class="custom-control-input">
			  				@endif
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">Events</span>
						</label>
						<label class="custom-control custom-radio">
							@if(Session::get('radio') == 1)
			  					<input id="radio1" value="1" name="radio" type="radio" class="custom-control-input" checked>
			  				@else
			  					<input id="radio1" value="1" name="radio" type="radio" class="custom-control-input">
			  				@endif
			  				<span class="custom-control-indicator"></span>
			  				<span class="custom-control-description">Businesses</span>
						</label>
						<!-- <label class="custom-control custom-radio event-btn">
							@if(Session::get('radio') == 4)
			  					<input id="radio4" value="4" name="radio" type="radio" class="custom-control-input" checked>
			  				@else
			  					<input id="radio4" value="4" name="radio" type="radio" class="custom-control-input">
			  				@endif
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">Shared location</span>
						</label> -->
						<label class="custom-control custom-radio event-btn">
							@if(Session::get('radio') == 3)
			  					<input id="radio2" value="3" name="radio" type="radio" class="custom-control-input" checked>
			  				@else
			  					<input id="radio2" value="3" name="radio" type="radio" class="custom-control-input">
			  				@endif
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">All</span>
						</label>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 searchboxbtn">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbox">
								<div class="searchboxfavourite">
									<select multiple="multiple" class="form-control searchboxinput search-tag" name="tags[]">
		      						</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbtn">
								<button type="submit" class="btn btn-secondary top-search">Submit</button>
							</div>
						</div>
					</div>
					{{ Form::close() }}
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow">
						<div class="customdetail">
							@if(isset($all_search_business) || isset($all_search_events))
								@if(empty($all_search_business) && empty($all_search_events))
									<div class="eventmain businessevent">
										<center><img style="margin-top: 56px; margin-bottom: 30px;" src="{{ url('/images/error/Image_from_Skype1.png') }}" height="100" width="100"></center><br>
										<center><h4>Nothing Found...</h4></center>
										<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
									</div>
								@else


									@if(isset($all_search_business))
										<div class="businessmain businessevent">
											<h3 class="business-text">Businesses:</h3>
											@if(empty($all_search_business))
												<h3 class="text-center">Nothing to show</h3>
											@else
											@foreach($all_search_business as $business)
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
												@if(!empty($business[0]['business_main_image']))
													@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$business[0]['business_main_image']) == 1)
													<a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">
														@if(!empty($business[0]['discount_rate']))
														<div class="ribbon-wrapper-green">
															<div class="img-discount-badge">
																Discounts
															</div>
														</div>
														@endif
														<img src="{{ url('/images/business/'.$business[0]['business_main_image']) }}" class="img-responsive thumb-img placeholder">
													</a>

												@else
													@if(!empty($business[0]['discount_rate']))
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													@endif

													<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">


												@endif
											@else
												@if(!empty($business[0]['discount_rate']))
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												@endif

												<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
											@endif
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">{{ $business[0]['business_title'] }}</a></h4>
													@if(count($business[0]['tags']) > 0 )
													<h5 class="colors">Listed in
													@php
														$counter=0;
													@endphp
													@foreach($business[0]['tags'] as $value)
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
													<p class="left-sub-text">
													@if(!empty($business[0]['business_description']))
														@if(mb_strlen($business[0]['business_description']) > 150)
                                        					@php echo substr($business[0]['business_description'],0,150); @endphp ...
                                    					@else
                                    						{{ $business[0]['business_description'] }}
                                    					@endif
													@else
														No description
													@endif
													</p>
													<p class="read"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">Read More</a></p>
												</div>
												<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
													<div>
													<button type="button" data-id="{{ $business[0]['business_id'] }}" class="btn favourite rvm_fav_business"><span class="favourite-btn"> Remove Favorites</span></button>
													</div>

													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $business[0]['fav_count'] }}</span> FAVORITES</span></p>
													<div class="icon">

													<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/morebusiness?q=').$business[0]['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

													<a href="mailto:?subject=Click the link&body={{ url('/morebusiness?q=').$business[0]['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

													<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url={{ url('/morebusiness?q=').$business[0]['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											@endforeach
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

											</div>
											@endif
										</div>
									@endif
									@if(isset($all_search_events))
										<div class="eventmain businessevent">
											<h3 class="business-text">Events:</h3>
											@if(empty($all_search_events))
												<h3 class="text-center">Nothing to show</h3>
											@else
											@foreach($all_search_events as $event)
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">


											@if(!empty($event[0]['event_main_image']))
												@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$event[0]['event_main_image']) == 1)

													<a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">
														@if(!empty($event[0]['discount_rate']))
														<div class="ribbon-wrapper-green">
															<div class="img-discount-badge">
																Discounts
															</div>
														</div>
														@endif
														<img src="{{ url('/images/event/'.$event[0]['event_main_image']) }}" class="img-responsive thumb-img placeholder">
													</a>

												@else
													@if(!empty($event[0]['discount_rate']))
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													@endif
													<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

												@endif
											@else
												@if(!empty($event[0]['discount_rate']))
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												@endif
												<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
											@endif
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">{{ $event[0]['event_title'] }}</a></h4>
													@if( count($event[0]['tags']) > 0 )
														<h5 class="colors">Listed in
														@php
															$counter = 0;
														@endphp
														@foreach($event[0]['tags'] as $value)
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
													<p class="left-sub-text">
													@if(!empty($event[0]['event_description']))
														@if(mb_strlen($event[0]['event_description']) > 150)
                                        					@php echo substr($event[0]['event_description'],0,150); @endphp ...
                                    					@else
                                    						{{ $event[0]['event_description'] }}
                                    					@endif
													@else
														No description
													@endif
													</p>
													<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">Read More</a></p>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
													<div>
													<button type="button"  data-id="{{ $event[0]['event_id'] }}" class="btn favourite rvm_fav_event"><span class="favourite-btn"> Remove Favorites</span></button>
													</div>
													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i><span class="fav-count"> {{ $event[0]['fav_count'] }}</span> FAVORITES</span></p>
													<div class="icon">

													<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event[0]['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

													<a href="mailto:?subject=Click the link&body={{ url('/moreevent?q=').$event[0]['event_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

													<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url={{ url('/moreevent?q=').$event[0]['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											@endforeach
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

											</div>
											@endif
										</div>
									@endif
								@endif
							@else
								@if(count($all_businesses) > 0)
									<div class="businessmain businessevent">
										<h3 class="business-text">Businesses:</h3>
										@foreach($all_businesses as $business)
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">

										@if(!empty($business[0]['business_main_image']))
											@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$business[0]['business_main_image']) == 1)

												<a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">
													@if(!empty($business[0]['discount_rate']))
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													@endif
													<img src="{{ url('/images/business/'.$business[0]['business_main_image']) }}" class="img-responsive thumb-img placeholder">
												</a>

											@else
												@if(!empty($business[0]['discount_rate']))
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												@endif
												<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

											@endif
										@else
											@if(!empty($business[0]['discount_rate']))
											<div class="ribbon-wrapper-green">
												<div class="img-discount-badge">
													Discounts
												</div>
											</div>
											@endif
											<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
										@endif
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
												<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">{{ $business[0]['business_title'] }}</a></h4>
												@if(count($business[0]['tags']) > 0 )
												@php
													$counter = 0;
												@endphp
												<h5 class="colors">Listed in
												@foreach($business[0]['tags'] as $value)
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
												<p class="left-sub-text">
													@if(!empty($business[0]['business_description']))
														@if(mb_strlen($business[0]['business_description']) > 150)
                                        					@php echo substr($business[0]['business_description'],0,150); @endphp ...
                                    					@else
                                    						{{ $business[0]['business_description'] }}
                                    					@endif
													@else
														No description
													@endif
												</p>
												<p class="read"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">Read More</a></p>
											</div>
											<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
												<div>
												<button type="button" data-id="{{ $business[0]['business_id'] }}" class="btn favourite rvm_fav_business"><span class="favourite-btn"> Remove Favorites</span></button>
												</div>
												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $business[0]['fav_count'] }}</span> FAVORITES</span></p>
												<div class="icon">

												<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/morebusiness?q=').$business[0]['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

													<a href="mailto:?subject=Click the link&body={{ url('/morebusiness?q=').$business[0]['business_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

													<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url={{ url('/morebusiness?q=').$business[0]['business_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

												</div>
											</div>
										</div>
										@endforeach
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

										</div>
									</div>
								@endif
									<!--end business div-->
									<!--start event div-->
								@if(count($all_events) > 0)
									<div class="eventmain businessevent">
										<h3 class="business-text">Events:</h3>

										@foreach($all_events as $event)
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
											@if(!empty($event[0]['event_main_image']))
												@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$event[0]['event_main_image']) == 1)


												<a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">
													@if(!empty($event[0]['discount_rate']))
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													@endif
													<img src="{{ url('/images/event/'.$event[0]['event_main_image']) }}" class="img-responsive thumb-img placeholder">
												</a>

											@else
												@if(!empty($event[0]['discount_rate']))
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												@endif
												<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

											@endif
										@else
											@if(!empty($event[0]['discount_rate']))
											<div class="ribbon-wrapper-green">
												<div class="img-discount-badge">
													Discounts
												</div>
											</div>
											@endif
											<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
										@endif
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
												<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">{{ $event[0]['event_title'] }}</a></h4>
												@if( count($event[0]['tags']) > 0 )
													@php
														$counter = 0;
													@endphp
													<h5 class="colors">Listed in
													@foreach($event[0]['tags'] as $value)
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
												<p class="left-sub-text">
													@if(!empty($event[0]['event_description']))
														@if(mb_strlen($event[0]['event_description']) > 150)
                                        					@php echo substr($event[0]['event_description'],0,150); @endphp ...
                                    					@else
                                    						{{ $event[0]['event_description'] }}
                                    					@endif
													@else
														No description
													@endif
												</p>
												<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">Read More</a></p>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
												<div>
												<button type="button"  data-id="{{ $event[0]['event_id'] }}" class="btn favourite rvm_fav_event"><span class="favourite-btn"> Remove Favorites</span></button>
												</div>
												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event[0]['fav_count'] }}</span> FAVORITES</span></p>
												<div class="icon">

												<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event[0]['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

												<a href="mailto:?subject=Click the link&body={{ url('/moreevent?q=').$event[0]['event_id'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

												<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url={{ url('/moreevent?q=').$event[0]['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

												</div>
											</div>
										</div>
										@endforeach
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

										</div>
									</div>
								@endif

								@if(count($all_share_location) > 0)
									<div class="eventmain businessevent">
										<h3 class="business-text">Shared location:</h3>

										@foreach($all_share_location as $share_location)
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										@if(!empty($share_location[0]['image'][0]))
											@if(file_exists(public_path().'/'.'images'.'/'.'share_location/'.$share_location[0]['image'][0]) == 1)

											<a href="{{ route('frontend_more_shared_location',[$share_location[0]['shared_location_id']]) }}"><img src="{{ url('/images/share_location/'.$share_location[0]['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>
											@else

												<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

											@endif
										@else
											<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">
										@endif
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">

												<h4 class="head"><a href="{{ route('frontend_more_shared_location',[$share_location[0]['shared_location_id']]) }}">{{ $share_location[0]['given_name'] }}</a></h4>

												<p class="left-sub-text">
												@if(!empty($share_location[0]['description']))
													{{ $share_location[0]['description'] }}
												@else
													No description
												@endif
												</p>

												<p class="read"><a href="{{ route('frontend_more_shared_location',[$share_location[0]['shared_location_id']]) }}">Read More</a></p>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">

												<button type="button"  data-id="{{ $share_location[0]['shared_location_id'] }}" class="btn btn favourite" id="shared_location_rvm_fav_btn"><span class="favourite-btn"> Remove Favorites</span></button>

												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $share_location[0]['fav_count'] }} FAVORITES</span></p>
												<div class="icon">

												</div>
											</div>
										</div>
										@endforeach
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

										</div>
									</div>
								@endif

								@if(count($all_businesses) == 0 && count($all_events) == 0 && count($all_share_location) == 0)
									<div class="eventmain businessevent">
										<center><img style="margin-top: 56px; margin-bottom: 30px;" src="{{ url('/images/error/Image_from_Skype1.png') }}" height="100" width="100"></center><br>
										<center><h4>Nothing Found...</h4></center>
										<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
									</div>
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
<script type="text/javascript">
	 $(".search-tag").select2({
	 	placeholder: "More terms like Yoga and Bicycle etc…",
	 	tags: true
	 });
</script>
@endsection
