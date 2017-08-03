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
							<!--start event div-->
							<div class="eventmain businessevent">
								<h3 class="business-text">Events:</h3>
								@foreach($all_events as $event)
								<div class="col-md-12 devide">
									<div class="col-md-3 divimgs">
										<a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}"><img src="{{ url('/images/event/'.$event['image'][0]) }}" class="img-responsive thumb-img"></a>
									</div>
									<div class="col-md-6 textdetails">
										<h4 class="head"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">{{ $event['event_title'] }}</a></h4>
										<h5 class="colors">Listed in <a href="{{ route('frontend_category',['q'=> $event['category_id']]) }}">{{ $event->getCategory()->first()->name }}</a></h5>
										<p class="left-sub-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
										<p class="read"><a href="{{ route('frontend_more_event',['q'=>$event['event_id']]) }}">Read More</a></p>
									</div>
									<div class="col-md-3 text-center socialicon">
										<button type="button" class="btn favourite"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favourites</span></i></button>
										<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> 7 FAVORITES</span></p>
										<div class="icon">
											<a class="btn btn-social-icon btn-facebook facebook"><span class="fa fa-facebook"></span></a>
											<a class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>
											<a class="btn btn-social-icon btn-twitter twitter"><span class="fa fa-twitter"></span></a>
										</div>
									</div>
								</div>
								@endforeach
								<!-- <div class="col-md-12 text-center">
									<button type="button" class="btn view">View All</button>
								</div> -->
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
									{{ $all_events->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end event div-->
				@include('frontend.layouts.theme.mostfav')	
			</div>
		</div>
	</div>
</div>
@endsection