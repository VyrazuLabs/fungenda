<!--start most favourite-->
<div class="col-md-3 rightsidediv">
	@if(count(MostFavorite::mostFavorite()) != 0)
		<div class="customdetailright">
			<p class="right-heading">Most Favorite:</p>
			<hr class="rightdevide">
			@foreach(MostFavorite::mostFavorite() as $key => $data)
			@if($data['business_id'])
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
					<a href="{{ route('frontend_more_business',['q'=>$data['business_id']]) }}">
						@if(!empty($data['business_discount']))
						<div class="ribbon-wrapper-green sidebar-ribbon">
							<div class="img-discount-badge sidebar-img-discount-badge">
								Discounts
							</div>
						</div>
						@endif
						@if(!empty($data['business_main_image']))
							@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)

								<img src="{{ url('/images/business/'.$data['image'][0]) }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
							@else
								<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
							@endif
						@else
							<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
						@endif
					</a>
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="{{ route('frontend_more_business',['q'=>$data['business_id']]) }}">{{ $data['business_title'] }}</a></p>

					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $key }} {{ $key>1 ? 'FAVORITES' : 'FAVORITE' }}
						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			@endif
			@if($data['event_id'])
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">

					<a href="{{ route('frontend_more_event',['q'=>$data['event_id']]) }}">
						@if(!empty($data['event_discount']))
						<div class="ribbon-wrapper-green sidebar-ribbon">
							<div class="img-discount-badge sidebar-img-discount-badge">
								Discounts
							</div>
						</div>
						@endif
						@if(!empty($data['event_main_image']))
							@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)

								<img src="{{ url('/images/event/'.$data['image'][0]) }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
							@else
								<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
							@endif
						@else
							<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
						@endif
					</a>

				{{-- http://via.placeholder.com/96x91 --}}
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="{{ route('frontend_more_event',['q'=>$data['event_id']]) }}">{{ $data['event_title'] }}</a></p>

					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $key }} {{ $key>1 ? 'FAVORITES' : 'FAVORITE' }}
						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			@endif
			@endforeach
		</div>
	@endif
	<!--end most favourite-->
	<!--start recent viewed-->
	
	<!--end recent viewed-->
	<!--start recent update-->
	@if(count(RecentlyUpdated::recentlyUpdated()) != 0)
		<div class="customdetailrightsecond">
			<p class="right-heading">Recently Updated:</p>
			<hr class="rightdevide">
			@foreach(RecentlyUpdated::recentlyUpdated() as $key => $data)
			@if(isset($data['event_id']))
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
					<a href="{{ route('frontend_more_event',['q'=>$data['event_id']]) }}">
					@if(!empty($data['event_discount']))
					<div class="ribbon-wrapper-green sidebar-ribbon">
						<div class="img-discount-badge sidebar-img-discount-badge">
							Discounts
						</div>
					</div>
					@endif
					@if(!empty($data['event_main_image']))
						@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)

							<img src="{{ url('/images/event/'.$data['image'][0]) }}" class="img-responsive image_modified sidebar-image" height="96" width="91"></a>
						@else
							<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
						@endif
					@else
						<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
					@endif
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="{{ route('frontend_more_event',['q'=>$data['event_id']]) }}">{{ $data['event_title'] }}</a></p>
					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $data['fav_count'] }} {{ $data['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}
						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			@endif
			@if(isset($data['business_id']))
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
					<a href="{{ route('frontend_more_business',['q'=>$data['business_id']]) }}">
					@if(!empty($data['business_discount']))
					<div class="ribbon-wrapper-green sidebar-ribbon">
						<div class="img-discount-badge sidebar-img-discount-badge">
							Discounts
						</div>
					</div>
					@endif
					@if(!empty($data['business_main_image']))
						@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)

							<img src="{{ url('/images/business/'.$data['image'][0]) }}" class="img-responsive image_modified sidebar-image" height="96" width="91"></a>
						@else
							<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
						@endif
					@else
						<img src="{{ url('/images/placeholder.svg') }}" class="img-responsive image_modified sidebar-image" height="96" width="91">
					@endif
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="{{ route('frontend_more_business',['q'=>$data['business_id']]) }}">{{ $data['business_title'] }}</a></p>
					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $data['fav_count'] }} {{ $data['fav_count']>1 ? 'FAVORITES' : 'FAVORITE' }}
						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			@endif
			@endforeach
		</div>
	@endif

</div>
<!--end recent updated -->
