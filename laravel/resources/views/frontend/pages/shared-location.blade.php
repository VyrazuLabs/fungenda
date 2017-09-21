@extends('frontend.layouts.main.master')
@section('content')
<!--shared location heading with button start-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 sharedfirstdiv">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  shared">
				<p class="sharemaintext">Shared Public Locations</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 sharedbtndiv">
				<button type="button" class="btn privatelocation">View my privately saved locations</button>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		</div>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharedmaindiv">
	<div class="container">
		<div class="shareddiv">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sharepubliclocation">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 shareshadowdiv">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="searchfor">Search For</label>
		      				<input type="text" id="searchfor" class="form-control shareinput" placeholder="Search Term i.e 'yoga' ">
	    				</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="city">City</label>
		      				<input type="text" id="city" class="form-control shareinput" placeholder="Type name of the city">
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group sharegroup">
							<label for="state">State</label>
		      				<input type="text" id="state" class="form-control shareinput" placeholder="Type name of the state">
						</div>
						<div id="apend"></div>
						<div id="main">
						@if(!empty($all_states))
						@foreach($all_states as $key => $all_state)
							<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
								<h2 class="shareheadca">{{ $key }}</h2>
								@foreach($all_state as $k => $state_keys)
									<ul class="cllist">
										@if(isset($state_keys['venue_name']))
										<li>{{ $state_keys['venue_name'] }}</li>
										@endif
										<ul class="clsublist">
											<li>
												@if(!empty($state_keys['all_events']))	
													@foreach($state_keys['all_events'] as $val)
													<a href="{{ route('frontend_more_event',['q'=>$val['event_id']]) }}">
														{{ $val['event_title'] }}
													</a>
													@endforeach	
												@endif
												@if(!empty($state_keys['all_business']))
													@foreach($state_keys['all_business'] as $val)
													<a href="{{ route('frontend_more_business',['q'=>$val['business_id']]) }}">
														{{ $val['business_title'] }}
													</a>
													@endforeach
												@endif
											</li>
										</ul>	
									</ul>
								@endforeach
							</div>
						@endforeach
						@else
							<h1 style="text-align: center;">Nothing to show</h1>
						@endif
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shareshadowdivright">
					<div class="sharedrightdiv">
						<p class="text-center locationfirstpara">You do not have a location set, so we are showing ALL Businesses and Events. To set a location,<a href="index.php"> perform a search.</a></p>
					</div>
					<h4 class="text-center mostfavouritetext">Most Favorited</h4>
					<div class="customdetailright sharedetail">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right1.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right2.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right3.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
					<h4 class="text-center mostfavouritetext">Recently Viewed</h4>
					<div class="customdetailright sharedetail">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right1.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right2.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
						<hr class="rightdevide">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right3.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
					<h4 class="text-center mostfavouritetext">Recently Updated</h4>
					<div class="customdetailright">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 righttextimg">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightimg">
								<a href="{{ route('frontend_more_event') }}"><img src="images/right1.png" class="img-responsive"></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center righttext">
								<p class="text-left right-head"><a href="{{ route('frontend_more_event') }}">Hawaii West</a></p>
								<p class="text-left right-text">
									<span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('add-js')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#searchfor').on('keyup',function(){
				var search_key = $(this).val();
				$.ajax({
					headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
					url: "{{ url('/location/search/searchfor') }}",
					type: 'post',
					data: {'data': search_key},
					success: function(data){
						// console.log(data);
						if(data.length != 0){
							$('#main').hide();
							$( ".rvm" ).remove();
						}
						$.each(data,function(key,value){
							$.each(value,function(ky,val){
								// console.log(val)
								if(val.hasOwnProperty("event_id")){
									// $( ".rvm" ).remove();
									var event_data = '<div class="rvm col-lg-5 col-md-5 col-sm-12 col-xs-12 divca"> <h2 class="rvm shareheadca">'+val.state+'</h2> <ul class="cllist rvm"> <li>'+val.city+'</li> <ul class="rvm clsublist"> <li> <a href="moreevent?q='+val.event_id+'">'+val.event_title+'</a>';
									$('#apend').append(event_data);
								}
								if(val.hasOwnProperty("business_id")){
									var business_data = '<div class="rvm col-lg-5 col-md-5 col-sm-12 col-xs-12 divca"> <h2 class="rvm shareheadca">'+val.state+'</h2> <ul class="rvm cllist"> <li>'+val.city+'</li> <ul class="rvm clsublist"> <li> <a href="morebusiness?q='+val.business_id+'">'+val.business_title+'</a>';
									$('#apend').append(business_data);
								}
								
							});
						});

						// $('#main').html(event_data_all);
					}
				})
			});	
		});
	</script>
@endsection