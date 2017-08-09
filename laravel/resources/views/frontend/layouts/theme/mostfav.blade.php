<!--start most favourite-->
<div class="col-md-3 rightsidediv">
	<div class="customdetailright">
		<p class="right-heading">Most Favourited:</p>
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
	<!--end most favourite-->
	<!--start recent viewed-->
	<div class="customdetailrightsecond">
		<p class="right-heading">Recently Viewed:</p>
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="http://via.placeholder.com/96x91" class="img-responsive"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">Hawaii West</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="http://via.placeholder.com/96x91" class="img-responsive"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">Hawaii West</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="http://via.placeholder.com/96x91" class="img-responsive"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">Hawaii West</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
					</span>
				</p>
			</div>
		</div>
	</div>
	<!--end recent viewed-->
	<!--start recent update-->
	<div class="customdetailrightsecond">
		<p class="right-heading">Recently Updated:</p>
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="http://via.placeholder.com/96x91" class="img-responsive"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">Hawaii West</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="http://via.placeholder.com/96x91" class="img-responsive"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">Hawaii West</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
					</span>
				</p>
			</div>
		</div>
		<hr class="rightdevide">
		<div class="col-md-12 col-xs-12 righttextimg">
			<div class="col-md-6 col-xs-6 rightimg">
				<a href="shared-location-new.php"><img src="http://via.placeholder.com/96x91" class="img-responsive"></a>
			</div>
			<div class="col-md-6 col-xs-6 text-center righttext">
				<p class="text-left right-head"><a href="shared-location-new.php">Hawaii West</a></p>
				<p class="text-left right-text">
					<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
					</span>
				</p>
			</div>
		</div>
	</div>
</div>
<!--end recent updated