@extends('frontend.layouts.main.master')
@section('content')
<!--start business div-->
<div class="col-md-12 maindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 leftcardshadow">
						<div class="customdetail">
							<!--start event div-->
							<div class="eventmain businessevent">
								<h3 class="business-text">Events:</h3>
								@foreach($all_events as $event)
								<div class="col-md-12 devide">
									<div class="col-md-3 divimgs">

									@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$event['image'][0]) == 1)

										<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

									@else

										<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>

									@endif
									</div>
									<div class="col-md-6 textdetails">
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
										<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More</a></p>
									</div>
									<div class="col-md-3 text-center socialicon">
										
										<button type="button" data-id="{{ $event['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
										
										
										<button type="button"  data-id="{{ $event['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $event['fav_count'] }} FAVORITES</span></p>
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
								<!-- <div class="col-md-12 text-center">
									<button type="button" class="btn view">View All</button>
								</div> -->
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									{{ $all_events->links() }}
								</div>
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