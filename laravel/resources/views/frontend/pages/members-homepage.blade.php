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
											<li>
												<a href="{{ route('frontend_more_business',['q'=>$business[0]['business_id']]) }}">{{ $business[0]['business_title'] }}</a>
												@if(Auth::check() && Auth::user()->user_id == $business[0]->created_by)
												<a href="{{ route('edit_business',$business[0]['business_id']) }}">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
												<a href="JavaScript:Void(0)" onclick="deleteFunctionBusiness(this)" data-id = "{{ $business[0]['business_id'] }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												@endif
											</li>
										@endforeach
									@endif

									@if(count($all_events) > 0)
										@foreach($all_events as $event)
											<li>
												<a href="{{ route('frontend_more_event',['q'=>$event[0]['event_id']]) }}">{{ $event[0]['event_title'] }}</a>
												@if(Auth::check() && Auth::user()->user_id == $event[0]->created_by)
												<a href="{{ route('edit_event',$event[0]['event_id']) }}">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>

													<a href="JavaScript:Void(0)" onclick="deleteFunction(this)" data-id = "{{ $event[0]['event_id'] }}">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
												@endif
											</li>
										@endforeach
									@endif

									@if(count($all_share_location) > 0)
										@foreach($all_share_location as $share_location)

											<li>
												<a href="{{ route('frontend_more_shared_location',[$share_location[0]['shared_location_id']]) }}">{{ $share_location[0]['given_name'] }}</a>
												@if(Auth::check() && Auth::user()->user_id == $share_location[0]['user_id'])
												<a href="{{ route('edit_shared_location',$share_location[0]['shared_location_id']) }}">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>

												<a onclick="deleteFunctionSharedLocation(this)" target="#" data-id = "{{ $share_location[0]['shared_location_id']}}">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
												@endif
											</li>
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
										<li>
											<a href="{{ route('frontend_more_business',['q'=>$business['business_id']]) }}">{{ $business['business_title'] }}</a>
											<a href="{{ route('edit_business',$business['business_id']) }}">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											 <a href="JavaScript:Void(0)" onclick="deleteFunctionBusiness(this)" data-id = "{{ $business['business_id'] }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</li>
									@endforeach
								</ul>
								@endif
								@if(count($myCreatedEvents) > 0)
								<li>Events:</li>
								<ul class="clsublist">
									@foreach($myCreatedEvents as $event)
										<li>
											<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a>
											<a href="{{ route('edit_event',$event['event_id']) }}">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a href="JavaScript:Void(0)" onclick="deleteFunction(this)" data-id = "{{ $event['event_id'] }}">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
										</li>
									@endforeach
								</ul>
								@endif
								@if(count($mySharedLocation) > 0)
								<li>Locations:</li>
								<ul class="clsublist">
									@foreach($mySharedLocation as $share_location)
										<li>
											<a href="{{ route('frontend_more_shared_location',[$share_location['shared_location_id']]) }}">{{ $share_location['given_name'] }}</a>

											<a href="{{ route('edit_shared_location',$share_location['shared_location_id']) }}">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>

											<a onclick="deleteFunctionSharedLocation(this)" target="#" data-id = "{{ $share_location['shared_location_id']}}">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
										</li>
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

@section('add-js')
<script>
	function deleteFunctionSharedLocation(location) {
	    var id = $(location).attr('data-id');
	    // alert(id);
	    swal({
	      title: 'Are you sure?',
	      text: "Are you really want to delete!",
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Yes, delete it!'
	    }).then(function () {
	      window.location.href = "{{ url('/share-your-location/member/delete') }}"+"/"+id;
	    })
	}
  function deleteFunction(event) {
    var id = $(event).attr('data-id');
    swal({
      title: 'Are you sure?',
      text: "Are you really want to delete!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        url: "{{ route('user_event_delete') }}",
        type: 'post',
        data: {data: id},
        success: function(data){
          if(data.status == 1){
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then(function(){
              location.reload();
            })
          }
        }
      })
    })
  }

  function deleteFunctionBusiness(event) {
    var id = $(event).attr('data-id');
    // console.log(id);
    swal({
      title: 'Are you sure?',
      text: "Are you really want to delete!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        url: "{{ route('user_business_delete') }}",
        type: 'post',
        data: {data: id},
        success: function(data){
          console.log(data);
          if(data.status == 1){
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then(function(){
              location.reload();
            })
          }
        }
      })
    })
  }
</script>
@endsection
