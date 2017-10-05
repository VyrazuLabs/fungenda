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
						<label class="custom-control custom-radio">
			  				<input id="radio1" value="1" name="radio" type="radio" class="custom-control-input">
			  				<span class="custom-control-indicator"></span>
			  				<span class="custom-control-description">Businesses</span>
						</label>
						<label class="custom-control custom-radio event-btn">
			  				<input id="radio2" value="2" name="radio" type="radio" class="custom-control-input" checked>
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">Events</span>
						</label>
						<label class="custom-control custom-radio event-btn">
			  				<input id="radio2" value="3" name="radio" type="radio" class="custom-control-input">
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
						@if(isset($all_search_business))
							<div class="businessmain businessevent">
								<h3 class="business-text">Businesses:</h3>
								@foreach($all_search_business as $business)
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">

									@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business[0]['image'][0]) == 1)

										<a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}"><img src="{{ url('images/business/'.$business[0]['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

									@else

										<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

									@endif
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">{{ $business[0]['business_title'] }}</a></h4>
										@if(count($business[0]['tags']) > 0 )
										<h5 class="colors">Listed in 
										@foreach($business[0]['tags'] as $value)
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
										<p class="read"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">Read More</a></p>
									</div>
									<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">

										<button type="button" data-id="{{ $business[0]['business_id'] }}" class="btn favourite rvm_fav_business"><span class="favourite-btn"> Remove from Favorites</span></button>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $business[0]['fav_count'] }} FAVORITES</span></p>
										<div class="icon">

										@if($business[0]['business_fb_link'])

											<a class="btn btn-social-icon btn-facebook facebook" href="{{ $business[0]['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>

										@endif

											<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $business[0]['business_email'] }}"><span class="fa fa-envelope"></span></a>

										@if($business[0]['business_twitter_link'])

											<a class="btn btn-social-icon btn-twitter twitter" href="{{ $business[0]['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

										@endif

										</div>
									</div>
								</div>
								@endforeach
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
									
								</div>
							</div>
						@endif
						@if(isset($all_search_events))
							<div class="eventmain businessevent">
								<h3 class="business-text">Events:</h3>

								@foreach($all_search_events as $event)
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">

									@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event[0]['image'][0]) == 1)

										<a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}"><img src="{{ url('/images/event/'.$event[0]['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

									@else

										<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

									@endif

									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">{{ $event[0]['event_title'] }}</a></h4>
										@if( count($event[0]['tags']) > 0 )
											<h5 class="colors">Listed in 
											@foreach($event[0]['tags'] as $value)
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
										<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">

										<button type="button"  data-id="{{ $event[0]['event_id'] }}" class="btn favourite rvm_fav_event"><span class="favourite-btn"> Remove from Favorites</span></button>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $event[0]['fav_count'] }} FAVORITES</span></p>
										<div class="icon">

										@if($event[0]['event_fb_link'])

											<a class="btn btn-social-icon btn-facebook facebook" href="{{ $event[0]['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>

										@endif

											<a class="btn btn-social-icon btn-envelope email" " href="mailto:{{ $event[0]['event_email'] }}"><span class="fa fa-envelope"></span></a>

										@if($event[0]['event_twitter_link'])

											<a class="btn btn-social-icon btn-twitter twitter" href="{{ $event[0]['event_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

										@endif

										</div>
									</div>
								</div>
								@endforeach
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
									
								</div>
							</div>
						@endif
					@else
						@if(count($all_businesses) > 0)
							<div class="businessmain businessevent">
								<h3 class="business-text">Businesses:</h3>
								@foreach($all_businesses as $business)
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">

									@if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business[0]['image'][0]) == 1)

										<a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}"><img src="{{ url('images/business/'.$business[0]['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

									@else

										<img src="{{ url('images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

									@endif
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">{{ $business[0]['business_title'] }}</a></h4>
										@if(count($business[0]['tags']) > 0 )
										<h5 class="colors">Listed in 
										@foreach($business[0]['tags'] as $value)
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
										<p class="read"><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">Read More</a></p>
									</div>
									<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">

										<button type="button" data-id="{{ $business[0]['business_id'] }}" class="btn favourite rvm_fav_business"><span class="favourite-btn"> Remove from Favorites</span></button>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $business[0]['fav_count'] }} FAVORITES</span></p>
										<div class="icon">

										@if($business[0]['business_fb_link'])

											<a class="btn btn-social-icon btn-facebook facebook" href="{{ $business[0]['business_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>

										@endif

											<a class="btn btn-social-icon btn-envelope email" href="mailto:{{ $business[0]['business_email'] }}"><span class="fa fa-envelope"></span></a>

										@if($business[0]['business_twitter_link'])

											<a class="btn btn-social-icon btn-twitter twitter" href="{{ $business[0]['business_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

										@endif

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

									@if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event[0]['image'][0]) == 1)

										<a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}"><img src="{{ url('/images/event/'.$event[0]['image'][0]) }}" class="img-responsive thumb-img placeholder"></a>

									@else

										<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive thumb-img placeholder">

									@endif

									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">{{ $event[0]['event_title'] }}</a></h4>
										@if( count($event[0]['tags']) > 0 )
											<h5 class="colors">Listed in 
											@foreach($event[0]['tags'] as $value)
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
										<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">Read More</a></p>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">

										<button type="button"  data-id="{{ $event[0]['event_id'] }}" class="btn favourite rvm_fav_event"><span class="favourite-btn"> Remove from Favorites</span></button>

										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $event[0]['fav_count'] }} FAVORITES</span></p>
										<div class="icon">

										@if($event[0]['event_fb_link'])

											<a class="btn btn-social-icon btn-facebook facebook" href="{{ $event[0]['event_fb_link'] }}" target="_blank"><span class="fa fa-facebook"></span></a>

										@endif

											<a class="btn btn-social-icon btn-envelope email" " href="mailto:{{ $event[0]['event_email'] }}"><span class="fa fa-envelope"></span></a>

										@if($event[0]['event_twitter_link'])

											<a class="btn btn-social-icon btn-twitter twitter" href="{{ $event[0]['event_twitter_link'] }}" target="_blank"><span class="fa fa-twitter"></span></a>

										@endif

										</div>
									</div>
								</div>
								@endforeach
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
									
								</div>
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
	 	placeholder: "Search term i.e 'Yoga'",
	 	tags: true
	 });
</script>
@endsection