 <!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>Login</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="{{ url('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="{{ url('/bower_components/font-awesome/css/font-awesome.min.css')}}">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="{{ url('/bower_components/Ionicons/css/ionicons.min.css')}}">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="{{url('/dist/css/AdminLTE.min.css')}}">
	  <!-- iCheck -->
	  <link rel="stylesheet" href="{{url('/plugins/iCheck/square/blue.css')}}">
	  <link rel="stylesheet" type="text/css" href="{{ url('/css/pnotify.custom.min.css') }}">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

	  <!-- Google Font -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	  <style type="text/css">
	  	.forgotpw{
	  		color: #666;
	  	}
	  	.loginremember{
	  		padding-bottom: 24px;
	  	}
	  	.admin-login-box{
	  		padding: 4em 2.5em;
	  	}
	  	.signup-error{
		    color: red;
		}
	  </style>
</head>
<!--login admin start-->
<body class="hold-transition login-page">
		<div class="login-box">
		  <div class="login-logo">
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body admin-login-box">
		      <div class="row loginremember">
		      	<h1 class="text-center">Not valid link</h1>
		      </div>
		      <div class="row loginremember">
		      	<a class="text-center" href="{{ url('/admin/login') }}"><b>back</b></a>
		      </div>
		  </div>
		</div>

<!-- jQuery 3 -->
<script src="{{url('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('/plugins/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/js/pnotify.custom.min.js') }}"></script>
<script>
</script>
</body>
<!--login admin end-->
</html>
