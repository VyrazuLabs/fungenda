<!--start most favourite-->
<div class="col-md-3 rightsidediv">
	@if(count(MostFavorite::mostFavorite()) != 0)
		<div class="customdetailright">
			<p class="right-heading">Most Favourited:</p>
			<hr class="rightdevide">
			@foreach(MostFavorite::mostFavorite() as $key => $data)
			@if($data['business_image'])
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
				
					<a href="shared-location-new.php"><img src="{{ url('/images/business/'.$data['image'][0]) }}" class="img-responsive" height="96" width="91"></a>
			
				{{-- http://via.placeholder.com/96x91 --}}
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="shared-location-new.php">{{ $data['business_title'] }}</a></p>
				
					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i>{{ $key }} FAVORITES
						</span>
					</p>
				</div>
			</div>
			<hr class="rightdevide">
			@endif
			@if($data['event_image'])
			<div class="col-md-12 col-xs-12 righttextimg">
				<div class="col-md-6 col-xs-6 rightimg">
				
					<a href="shared-location-new.php"><img src="{{ url('/images/event/'.$data['image'][0]) }}" class="img-responsive" height="96" width="91"></a>
			
				{{-- http://via.placeholder.com/96x91 --}}
				</div>
				<div class="col-md-6 col-xs-6 text-center righttext">
					<p class="text-left right-head"><a href="shared-location-new.php">{{ $data['event_title'] }}</a></p>
				
					<p class="text-left right-text">
						<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i>{{ $key }} FAVORITES
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
	<div class="customdetailrightsecond">
	@if(count(RecentlyViewed::recentlyViewed()) != 0)
		<p class="right-heading">Recently Viewed:</p>
		<hr class="rightdevide">
		@foreach(RecentlyViewed::recentlyViewed() as $key => $data)
		@if($data['type'] == 1)
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="{{ url('/images/business/'.$data['image'][0]) }}" class="img-responsive" height="96" width="91"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">{{ $data['name'] }}</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $data['fav_count'] }} FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		@endif
		@if($data['type'] == 2)
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="{{ url('/images/event/'.$data['image'][0]) }}" class="img-responsive" height="96" width="91"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">{{ $data['name'] }}</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $data['fav_count'] }} FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		@endif
		@endforeach
	@endif
	</div>
	<!--end recent viewed-->
	<!--start recent update-->
	<div class="customdetailrightsecond">
	@if(count(RecentlyUpdated::recentlyUpdated()) != 0)
		<p class="right-heading">Recently Updated:</p>
		<hr class="rightdevide">
		@foreach(RecentlyUpdated::recentlyUpdated() as $key => $data)
		@if($data['event_image'])
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="{{ url('/images/event/'.$data['image'][0]) }}" class="img-responsive" height="96" width="91"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">{{ $data['event_title'] }}</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $data['fav_count'] }} FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		@endif
		@if($data['business_image'])
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="{{ url('/images/business/'.$data['image'][0]) }}" class="img-responsive" height="96" width="91"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">{{ $data['business_title'] }}</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> {{ $data['fav_count'] }} FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		@endif
		@endforeach
	@endif
	</div>
</div>
<!--end recent updated