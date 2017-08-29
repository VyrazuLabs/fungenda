@extends('frontend.layouts.main.master')
@section('content')
<!--start business div-->
<div class="col-md-12 customcommunitydiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 leftcardshadow">
						<div class="customdetail">						
							<h3 class="business-text">Listed in <strong>{{ $category_name[0] }}</strong></h3>
							@if( count($all_business) > 0 )
								<div class="businessmain businessevent">
									<h3 class="business-text">Businesses:</h3>
									@foreach($all_business as $business)
									<div class="col-md-12 devide">
										<div class="col-md-3 divimgs">

										@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business['business_image'][0]) == 1)

											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}"><img src="{{ url('/images/business/'.$business['business_image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

										@else

											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}"><img src="{{ url('/images/business/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>

										@endif

										</div>
										<div class="col-md-6 textdetails">
											<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a></h4>

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

											<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
											<p class="read"><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More</a></p>
										</div>
										<div class="col-md-3 text-center socialicon">
											<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $business['fav_count'] }} FAVORITES</span></p>
											<div class="icon">
												<a class="btn btn-social-icon btn-facebook facebook" href="{{ $business['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>
												<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $business['business_email'] }}"><span class="fa fa-envelope"></span></a>
												<a class="btn btn-social-icon btn-twitter twitter" href="{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>
											</div>
										</div>
									</div>
									@endforeach
									<div class="col-md-12 text-center">
										{{ $all_business->withPath(url('/category?q='.$category_id))}}
									</div>
								</div>
							@endif
							<!--end business div-->
							<!--start event div-->
							@if( count($all_events) > 0 )
								<div class="businessmain businessevent">
									<h3 class="business-text">Events:</h3>
									@foreach($all_events as $event)
									<div class="col-md-12 devide">
										<div class="col-md-3 divimgs">

										@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event['event_image'][0]) == 1)

											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/event/'.$event['event_image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

										@else

											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/event/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>

										@endif
										</div>
										<div class="col-md-6 textdetails">
											<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></h4>

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
											
											<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
											<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More</a></p>
										</div>
										<div class="col-md-3 text-center socialicon">
											<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $event['fav_count'] }} FAVORITES</span></p>
											<div class="icon">
												<a class="btn btn-social-icon btn-facebook facebook" href="{{ $event['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>
												<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $event['event_email'] }}"><span class="fa fa-envelope"></span></a>
												<a class="btn btn-social-icon btn-twitter twitter" href="{{ $event['event_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>
											</div>
										</div>
									</div>
									@endforeach
									<div class="col-md-12 text-center">
										{{ $all_events->withPath(url('/category?q='.$category_id))}}
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