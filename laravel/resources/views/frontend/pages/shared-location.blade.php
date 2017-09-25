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
				<a href="{{ url('/location/privately_saved') }}"><button type="button" id="privately_saved" class="btn privatelocation">View my privately saved locations</button></a>
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
							@if(!empty($all_all_share_location_user_last))
								@foreach($all_all_share_location_user_last as $key=>$share_location_array)
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
										<h2 class="shareheadca">{{ $key }}</h2>
										@foreach($share_location_array as $share_location)
											<ul class="cllist">
												<li class="city_name">{{ $share_location['city_name'] }}</li>
												<ul class="clsublist">
													<li>
														<a href="{{ url('more_shared_location').'/'.$share_location['shared_location_id'] }}">
															{{ $share_location['location_name'] }}
														</a>
													</li>
												</ul>	
											</ul>
										@endforeach
									</div>
								@endforeach
							@else
							@if(!empty($all_all_share_location_last))
								@foreach($all_all_share_location_last as $key=>$share_location_array)
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
										<h2 class="shareheadca">{{ $key }}</h2>
										@foreach($share_location_array as $share_location)
											<ul class="cllist">
												<li class="city_name">{{ $share_location['city_name'] }}</li>
												<ul class="clsublist">
													<li>
														<a href="{{ url('more_shared_location').'/'.$share_location['shared_location_id'] }}">
															{{ $share_location['location_name'] }}
														</a>
													</li>
												</ul>	
											</ul>
										@endforeach
									</div>
								@endforeach
							@else
								<h1 class="text-center">Nothing to display</h1>
							@endif
							@endif
						</div>
					</div>
				</div>
				@include('frontend.layouts.theme.right-sidebar')
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
						console.log(data);
							$('#main').hide();
							$( ".rvm" ).remove();
						$.each(data,function(key,value){
							console.log(value);
							var event_data = '<div class="rvm col-lg-5 col-md-5 col-sm-12 col-xs-12 divca"> <h2 class="rvm shareheadca">'+value.state+'</h2> <ul class="cllist rvm"> <li class="city_name">'+value.city+'</li> <ul class="rvm clsublist"> <li> <a href="more_shared_location/'+value.shared_location_id+'">'+value.location_name+'</a>';
							$('#apend').append(event_data);
						});
					}
				})
			});	

			$('#state').on('keyup',function(){
				var search_key = $(this).val();
				$.ajax({
					headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
					url: "{{ url('/location/search/state') }}",
					type: 'post',
					data: {'data': search_key},
					success: function(data){
						console.log(data);
							$('#main').hide();
							$( ".rvm" ).remove();
						$.each(data,function(key,value){
							console.log(value);
							var event_data = '<div class="rvm col-lg-5 col-md-5 col-sm-12 col-xs-12 divca"> <h2 class="rvm shareheadca">'+value.state+'</h2> <ul class="cllist rvm"> <li class="city_name">'+value.city+'</li> <ul class="rvm clsublist"> <li> <a href="more_shared_location/'+value.shared_location_id+'">'+value.location_name+'</a>';
							$('#apend').append(event_data);
						});
					}
				})
			});

			$('#city').on('keyup',function(){
				var search_key = $(this).val();
				$.ajax({
					headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
					url: "{{ url('/location/search/city') }}",
					type: 'post',
					data: {'data': search_key},
					success: function(data){
						console.log(data);
							$('#main').hide();
							$( ".rvm" ).remove();
						$.each(data,function(key,value){
							console.log(value);
							var event_data = '<div class="rvm col-lg-5 col-md-5 col-sm-12 col-xs-12 divca"> <h2 class="rvm shareheadca">'+value.state+'</h2> <ul class="cllist rvm"> <li class="city_name">'+value.city+'</li> <ul class="rvm clsublist"> <li> <a href="more_shared_location/'+value.shared_location_id+'">'+value.location_name+'</a>';
							$('#apend').append(event_data);
						});
					}
				})
			});

		});
	</script>
@endsection