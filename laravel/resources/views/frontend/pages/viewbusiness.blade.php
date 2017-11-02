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
							<div class="businessmain businessevent">
								<h3 class="business-text">Businesses:</h3>
								@foreach($all_business as $business)
								<div class="col-md-12 devide">
									<div class="col-md-3 divimgs">
									@if(!empty($business['image'][0]))
										@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$business['image'][0]) == 1)

											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}"><img src="{{ url('/images/business/'.$business['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

										@else

											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}"><img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>

										@endif
									@else
										<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}"><img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder"></a>
									@endif
									</div>
									<div class="col-md-6 textdetails">
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
											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">Read More |</a>
											<a target="_blank" href="//{{ $business['business_website'] }}">Website</a>
											@if(Auth::check() && Auth::user()->user_id == $business->created_by)
												<a href="{{ route('edit_business',['q'=> $business['business_id']]) }}">| Edit</a>
											@endif
										</p>
									</div>
									<div class="col-md-3 text-center socialicon">
									<div class="fav-btn-container">
									@if(!Favourite::check($business['business_id'], 1))

										<button type="button" data-id="{{ $business['business_id'] }}" class="btn favourite add_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>

									@else
										
										<button type="button" data-id="{{ $business['business_id'] }}" class="btn favourite rvm_fav_business"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>

									@endif
									</div>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count">{{ $business['fav_count'] }}</span> {{ $business['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}</span></p>
										<div class="icon">

										@if($business['business_fb_link'] != 'http://')

											<a class="btn btn-social-icon btn-facebook facebook" href="//{{ $business['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>

										@endif

											<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $business['business_email'] }}"><span class="fa fa-envelope"></span></a>

										@if($business['business_twitter_link'] != 'http://')

											<a class="btn btn-social-icon btn-twitter twitter" href="//{{ $business['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

										@endif

										</div>
									</div>
								</div>
								@endforeach
								<!-- <div class="col-md-12 text-center">
									<button type="button" class="btn view">View All</button>
								</div> -->
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									{{ $all_business->links() }}
								</div>
							</div>
							<!--end business div-->
						</div>
					</div>
				</div>
				@include('frontend.layouts.theme.right-sidebar')	
			</div>
		</div>
	</div>
</div>
@endsection