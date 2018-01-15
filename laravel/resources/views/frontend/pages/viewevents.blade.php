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
									@if(!empty($event['image'][0]))
										@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$event['image'][0]) == 1)

											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

										@else

											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>

										@endif
									@else
										<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>
									@endif
									</div>
									<div class="col-md-6 textdetails">
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
											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More</a>
											@if(!empty($event['event_website']))
											<a target="_blank" href="//{{ $event['event_website'] }}">| Website</a>
											@endif
											@if(Auth::check() && Auth::user()->user_id == $event->created_by)
												<a href="{{ route('edit_event',['q'=> $event['event_id']]) }}">| Edit</a>
											@endif
										</p>

									</div>
									<div class="col-md-3 text-center socialicon">

									<div class="fav-btn-container">	
									@if(!Favourite::check($event['event_id'], 2))	
										<button type="button" data-id="{{ $event['event_id'] }}" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
									@else	
									
										<button type="button"  data-id="{{ $event['event_id'] }}" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
									@endif
									</div>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $event['fav_count'] }}</span> {{ $event['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>
										<div class="icon">

										<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

										<a href="mailto:{{ $event['event_email'] }}?subject=Click the link&body={{ url('/moreevent?q=').$event['event_email'] }}" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

										<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=SRK%E2%80%99s%20Next%20Movie%20Is%20Called%20%E2%80%98Zero%E2%80%99%20&amp;%20Its%20First%20Teaser%20Just%20Dropped&amp;url={{ url('/moreevent?q=').$event['event_id'] }}','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

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