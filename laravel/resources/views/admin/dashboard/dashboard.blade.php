@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('add-css')
  <link rel="stylesheet" href="{{ url('/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-beer" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Events</span>
              <span class="info-box-number">{{ count($all_events) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Business</span>
              <span class="info-box-number">{{ count($all_business) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Registered Users</span>
              <span class="info-box-number">{{ count($all_users) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <div class="col-md-6">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Updated</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box"> 
              	@if(count(RecentlyUpdated::recentlyUpdated()) != 0)
	              	@foreach(RecentlyUpdated::recentlyUpdated() as $key => $data)
	              	@if($data['event_image'])
	                <li class="item">
	                @if(!empty($data['image'][0])) 
	                  	@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)
	                  	  <div class="product-img">
		                    <img src="{{ url('/images/event/'.$data['image'][0]) }}" alt="Product Image">
		                  </div>
	                  	@else	
		                  <div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                  	@endif
	                @else
	                	<div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                @endif
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{ $data['event_title'] }}
	                      <span class="label label-success pull-right">{{ $data['event_venue'] }}</span></a>
	                    <span class="product-description">
	                          {{ $data['event_website'] }}
	                        </span>
	                  </div>
	                </li>
	                @endif
	                @if($data['business_image'])
	                <li class="item">
	                @if(!empty($data['image'][0]))  
	                  	@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)
	                  	  <div class="product-img">
		                    <img src="{{ url('/images/business/'.$data['image'][0]) }}" alt="Product Image">
		                  </div>
	                  	@else	
		                  <div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                  	@endif
	                @else
	                	<div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                @endif
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{ $data['business_title'] }}
	                      <span class="label label-success pull-right">{{ $data['business_venue'] }}</span></a>
	                    <span class="product-description">
	                          {{ $data['business_website'] }}
	                        </span>
	                  </div>
	                </li>
	                @endif
	                @endforeach
                @endif
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Viewed</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box"> 
              	@if(count(RecentlyViewed::recentlyViewed()) != 0)
	              	@foreach(RecentlyViewed::recentlyViewed() as $key => $data)
	              	@if($data['type'] == 2)
	                <li class="item">
	                @if(!empty($data['image'][0])) 
	                  	@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)
	                  	  <div class="product-img">
		                    <img src="{{ url('/images/event/'.$data['image'][0]) }}" alt="Product Image">
		                  </div>
	                  	@else	
		                  <div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                  	@endif
	                @else
	                	<div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                @endif
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{ $data['name'] }}
	                      <span class="label label-success pull-right">{{ $data['location'] }}</span></a>
	                    <span class="product-description">
	                          {{ $data['website'] }}
	                        </span>
	                  </div>
	                </li>
	                @endif
	                @if($data['type'] == 1)
	                <li class="item"> 
	                @if(!empty($data['image'][0]))
	                  	@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)
	                  	  <div class="product-img">
		                    <img src="{{ url('/images/business/'.$data['image'][0]) }}" alt="Product Image">
		                  </div>
	                  	@else	
		                  <div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                  	@endif
	                @else
	                	<div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                @endif
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{ $data['name'] }}
	                      <span class="label label-success pull-right">{{ $data['location'] }}</span></a>
	                    <span class="product-description">
	                          {{ $data['website'] }}
	                        </span>
	                  </div>
	                </li>
	                @endif
	                @endforeach
                @endif
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Most Favorite</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box"> 
              	@if(count(MostFavorite::mostFavorite()) != 0)
	              	@foreach(MostFavorite::mostFavorite() as $key => $data)
	              	@if($data['event_image'])
	                <li class="item">
	                @if(!empty($data['image'][0])) 
	                  	@if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$data['image'][0]) == 1)
	                  	  <div class="product-img">
		                    <img src="{{ url('/images/event/'.$data['image'][0]) }}" alt="Product Image">
		                  </div>
	                  	@else	
		                  <div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                  	@endif
	                @else
	                	<div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                @endif
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{ $data['event_title'] }}
	                      <span class="label label-success pull-right">{{ $data['event_venue'] }}</span></a>
	                    <span class="product-description">
	                          {{ $data['event_website'] }}
	                        </span>
	                  </div>
	                </li>
	                @endif
	                @if($data['business_image'])
	                <li class="item">   
	                @if(!empty($data['image'][0])) 

	                  	@if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$data['image'][0]) == 1)
	                  	  <div class="product-img">
		                    <img src="{{ url('/images/business/'.$data['image'][0]) }}" alt="Product Image">
		                  </div>
	                  	@else	
		                  <div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                  	@endif
	                @else
	                	<div class="product-img">
		                    <img src="{{ url('/images/placeholder.svg') }}" alt="Product Image">
		                  </div>
	                @endif
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{ $data['business_title'] }}
	                      <span class="label label-success pull-right">{{ $data['business_venue'] }}</span></a>
	                    <span class="product-description">
	                          {{ $data['business_website'] }}
	                        </span>
	                  </div>
	                </li>
	                @endif
	                @endforeach
                @endif
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
@endsection

<!-- ./wrapper -->
@section('add-js')

@endsection

