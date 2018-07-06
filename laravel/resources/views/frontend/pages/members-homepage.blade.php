@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 sharedfirstdiv">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0">
				<p class="sharemaintext member-homepage-heading">Member Homepage</p>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharedmaindiv">
	<div class="container">
		<div class="shareddiv">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharepubliclocation">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="col-lg-12 col-xs-12 shareshadowdiv member-homepage-shadow-div">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca member-homepage-subhead">Your Favorites</h2>
							<div class="member-homepage-subhead-line"></div>
							<ul class="cllist member-homepage-favorites-list">
								<li>Businesses, Events and Locations:</li>
								<ul class="clsublist">
									@if(count($all_businesses) > 0)
										@foreach($all_businesses as $business)
											<li><a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">{{ $business[0]['business_title'] }}</a></li>
										@endforeach
									@endif

									@if(count($all_events) > 0)
										@foreach($all_events as $event)
											<li><a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">{{ $event[0]['event_title'] }}</a></li>
										@endforeach
									@endif

									@if(count($all_share_location) > 0)
										@foreach($all_share_location as $share_location)
											<li><a href="{{ route('frontend_more_shared_location',[$share_location[0]['shared_location_id']]) }}">{{ $share_location[0]['given_name'] }}</a></li>
										@endforeach
									@endif
								</ul>
							</ul>
						</div>
					</div>
					<div class="col-lg-12 col-xs-12 shareshadowdiv member-homepage-shadow-div">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca member-homepage-subhead">Your Listings</h2>
							<div class="member-homepage-subhead-line"></div>
							<ul class="cllist member-homepage-favorites-list">
								@if(count($myCreatedBusiness) > 0)
								<li>Businesses</li>
								<ul class="clsublist">
									@foreach($myCreatedBusiness as $business)
										<li><a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a></li>
									@endforeach
								</ul>
								@endif
								@if(count($myCreatedEvents) > 0)
								<li>Events:</li>
								<ul class="clsublist">
									@foreach($myCreatedEvents as $event)
										<li><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></li>
									@endforeach
								</ul>
								@endif
								@if(count($mySharedLocation) > 0)
								<li>Locations:</li>
								<ul class="clsublist">
									@foreach($mySharedLocation as $share_location)
										<li><a href="{{ route('frontend_more_shared_location',[$share_location['shared_location_id']]) }}">{{ $share_location['given_name'] }}</a></li>
									@endforeach
								</ul>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-lg-12 col-xs-12 shareshadowdiv member-homepage-shadow-div">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 divca">
							<h2 class="shareheadca member-homepage-subhead">Categories</h2>
							<div class="member-homepage-subhead-line"></div>
							<ul class="cllist member-homepage-favorites-list">
								@if(count($all_category) > 0)
								<ul class="clsublist">
									@foreach($all_category as $category)
										<li><a href="{{ route('frontend_category',['q'=>$category['category_id']]) }}">{{ $category['name'] }}</a></li>
									@endforeach
								</ul>
								@endif
							</ul>
						</div>
					</div>
				</div>
				@include('frontend.layouts.theme.right-sidebar')
			</div>
		</div>
	</div>
</div>
@endsection
