@extends('frontend.layouts.main.master')
@section('content')
<!--shared location heading with button start-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 sharedfirstdiv">
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12  shared sharepublic">
				@if(Auth::User()) 
					<p class="sharemaintext sharepublic-text">My Public Locations</p>
				@else
					<p class="sharemaintext sharepublic-text">Public Locations</p>
				@endif
			</div>
			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 sharedbtndiv">
				<a href="{{ url('/share-your-location') }}"><button type="button" id="privately_saved" class="btn privatelocation">Add your locations</button></a>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 sharedbtndiv">
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
							@if($type == 'private')
								<input type="hidden" value="private" id="private">
								@foreach($ar as $key=>$share_location_array)
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
										<h2 class="shareheadca">{{ $share_location_array['state_name'] }}</h2>
										@foreach($share_location_array['cities'] as $share_location)
											<ul class="cllist">

												<li class="city_name">{{ 
												$share_location['city_name'] }}</li>
												@foreach($share_location['locations'] as $key => $location)
												<ul class="clsublist">
													<li>
														<a href="{{ url('more_shared_location').'/'.$key }}">
															{{ $location }}
														</a>
													</li>
												</ul>
												@endforeach	
											</ul>
										@endforeach
									</div>
								@endforeach
							@else
							@if(!empty($ar))
							<input type="hidden" value="public" id="private">
								@foreach($ar as $key=>$share_location_array)
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">
										<h2 class="shareheadca">{{ $share_location_array['state_name'] }}</h2>
										@foreach($share_location_array['cities'] as $share_location)
											<ul class="cllist">

												<li class="city_name">{{ 
												$share_location['city_name'] }}</li>
												@foreach($share_location['locations'] as $key => $location)
												<ul class="clsublist">
													<li>
														<a href="{{ url('more_shared_location').'/'.$key }}">
															{{ $location }}
														</a>
													</li>
												</ul>
												@endforeach	
											</ul>
										@endforeach
									</div>
								@endforeach
							@else
								<div class="eventmain businessevent">
									<center><img style="margin-top: 56px; margin-bottom: 30px;" src="{{ url('/images/error/Image_from_Skype1.png') }}" height="100" width="100"></center><br>
									<center><h4>Nothing Found...</h4></center>
									<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
								</div>
							@endif
							@endif
						</div>
					</div>
				</div>
				@include('frontend.layouts.theme.right-sidebar')
			</div>
		</div>
		<span id="pub_url" style="display: none;">{{ url('/more_shared_location') }}</span>
	</div>
</div>
@endsection
@section('add-js')
	<script type="text/javascript">
		$(document).ready(function() {
			var city_append = '',
			state = '',
			location ='';
			$('#searchfor').on('keyup',function(){
				var pub_url = $('#pub_url').html();
				state = '';
				city_append = '';
				location = '';
				var search_hidden = $('#private').val();
				// alert(search_hidden);
				var search_key = $(this).val();
				$.ajax({
					headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
					url: "{{ url('/location/search/searchfor') }}",
					type: 'post',
					data: {'data': search_key,
							'search_hidden': search_hidden
						  },
					success: function(data){
						state = '';
						city_append = '';
						location = '';
						$('#apend').html('');
						console.log(data);
							$('#main').hide();
							$( ".rvm" ).remove();
						$.each(data,function(key,value){
							city_append = '';
							$.each(value.cities,function(key,city){
								location = '';
								$.each(city.locations,function(id,location_name){
									location += '<ul class="clsublist">'+
												'<li>'+
													'<a href="'+pub_url+'/'+id+'">'+
													location_name+
													'</a>'+
												'</li>'
												+'</ul>';
								});
								city_append += '<ul class="cllist">'+
											'<li class="city_name">'+
											city.city_name +
											'</li>'+
											location
										+'</ul>';
							});

							state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
								+'<h2 class="shareheadca">'+
										value.state_name + 
										'</h2>' 
										+city_append
									+'</div>';
							
						});
						$('#apend').append(state);
					}
				})
			});	
			
			$('#state').on('keyup',function(){
				var pub_url = $('#pub_url').html();
				state = '';
				city_append = '';
				location = '';
				$('#apend').html('');
				var search_key = $(this).val();
				var search_hidden = $('#private').val();
				$.ajax({
					headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
					url: "{{ url('/location/search/state') }}",
					type: 'post',
					data: {'data': search_key, 'search_hidden': search_hidden},
					success: function(data){
						state = '';
						city_append = '';
						location = '';
						$('#apend').html('');
						console.log(data);
							$('#main').hide();
							$( ".rvm" ).remove();
						$.each(data,function(key,value){
							city_append = '';
							$.each(value.cities,function(key,city){
								location = '';
								$.each(city.locations,function(id,location_name){
									location += '<ul class="clsublist">'+
												'<li>'+
													'<a href="'+pub_url+'/'+id+'">'+
													location_name+
													'</a>'+
												'</li>'
												+'</ul>';
								});
								city_append += '<ul class="cllist">'+
											'<li class="city_name">'+
											city.city_name +
											'</li>'+
											location
										+'</ul>';
							});

							state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
								+'<h2 class="shareheadca">'+
										value.state_name + 
										'</h2>' 
										+city_append
									+'</div>';
							
						});
						$('#apend').append(state);
					}
				})
			});

			$('#city').on('keyup',function(){
				var pub_url = $('#pub_url').html();
				state = '';
				city_append = '';
				location = '';
				var search_key = $(this).val();
				var search_hidden = $('#private').val();
				$.ajax({
					headers: {'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
					url: "{{ url('/location/search/city') }}",
					type: 'post',
					data: {'data': search_key, 'search_hidden': search_hidden},
					success: function(data){
						state = '';
						city_append = '';
						location = '';
						$('#apend').html('');
						console.log(data);
							$('#main').hide();
							$( ".rvm" ).remove();
						$.each(data,function(key,value){
							city_append = '';
							$.each(value.cities,function(key,city){
								location = '';
								$.each(city.locations,function(id,location_name){
									location += '<ul class="clsublist">'+
												'<li>'+
													'<a href="'+pub_url+'/'+id+'">'+
													location_name+
													'</a>'+
												'</li>'
												+'</ul>';
								});
								city_append += '<ul class="cllist">'+
											'<li class="city_name">'+
											city.city_name +
											'</li>'+
											location
										+'</ul>';
							});

							state += '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 divca">'
								+'<h2 class="shareheadca">'+
										value.state_name + 
										'</h2>' 
										+city_append
									+'</div>';
							
						});
						$('#apend').append(state);
					}
				})
			});
		});
	</script>
@endsection