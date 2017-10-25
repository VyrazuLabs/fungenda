@extends('admin.layouts.master')

@section('title', 'Show Profile')

@section('add-css')
  <link rel="stylesheet" href="{{url('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url('/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Profile
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
        @if(!empty($user_details['user_image']))
        
          <img class="profile-user-img profile-pic-admin img-responsive img-circle" src="{{ url('/images/user'.'/'.$user_details['user_image']) }}" alt="User profile picture">
        @else
          <img src="{{ url('/images/user/personicon.png') }}" class="profile-user-img profile-pic-admin img-responsive img-circle" alt="User profile picture">
        @endif
          <h3 class="profile-username text-center">{{ $user_details['first_name'] }} {{ $user_details['last_name'] }}</h3>

          <a href="{{ route('edit_profile_page',['id'=>$user_details['user_id']]) }}" class="btn btn-primary btn-block"><b>EDIT</b></a>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
    	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong>Email</strong>

          <p class="text-muted">
            {{ $user_details['email'] }}
          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

          @if(!empty($user_details['address']))
            <p class="text-muted">{{ $user_details['address'] }}</p>
          @else
            <p class="text-muted">Address not updated yet</p>
          @endif
          <hr>

          <strong><i class="fa fa-pencil margin-r-5"></i> Phone number</strong>

            @if(!empty($user_details['phone_number']))
              <p class="text-muted">{{ $user_details['phone_number'] }}</p>
            @else
              <p class="text-muted">Phone number not updated yet</p>
            @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
    <!-- /.col -->
  <!-- /.row -->
</section>

@endsection

<!-- ./wrapper -->
@section('add-js')

@endsection

