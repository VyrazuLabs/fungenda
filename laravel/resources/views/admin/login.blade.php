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
		    <a href="#"><b>Login</b></a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body admin-login-box">
		    {{ Form::open(['method'=>'post','route'=>'checkLogin']) }}
		    	<div class="form-group has-feedback">
		    	{{Form::label('useremail','Email')}}
		    	{{ Form::email('useremail',null,['class'=>'form-control createcategory-input','id'=>'userid','placeholder'=>'Enter Your Username']) }}
		    	@if ($errors->has('useremail'))
                    <span id="eventnameerror" class="help-block">
                        <span class="signup-error">{{ $errors->first('useremail') }}</span>
                    </span>
                @endif
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
				{{Form::label('password','Password')}}
				{{ Form::password('password',['class'=>'form-control createcategory-input','id'=>'password','placeholder'=>'Enter Your Password']) }}
				@if ($errors->has('password'))
                    <span id="eventpasserror" class="help-block">
                        <span class="signup-error">{{ $errors->first('password') }}</span>
                    </span>
                @endif
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row loginremember">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              <input type="checkbox"> &nbsp;&nbsp;Remember Me
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
		        </div>
		        <!-- /.col -->
		      </div>
		    {{ Form::close() }}
		    <!-- /.social-auth-links -->
			<a href="{{ route('admin_forget_password') }}" id="forgotPw" class="forgotpw">I forgot my password</a><br>
		  </div>
		  <!-- /.login-box-body -->
		</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{url('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('/plugins/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/js/pnotify.custom.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  @if( session('error') )
    new PNotify({
      title: 'Error',
      text: 'Credential not matched',
      type: 'error',
      buttons: {
          sticker: false
      }
  	});
  @endif
  	@if( session('success') )
    new PNotify({
      title: 'Success',
      text: 'Password has been changed',
      type: 'success',
      buttons: {
          sticker: false
      }
  	});
  @endif

  $('#userid').on('keypress',function(){
  	$('#eventnameerror').html('');
  })

  $('#password').on('keypress',function(){
  	$('#eventpasserror').html('');
  })

  });
</script>
</body>
<!--login admin end-->
</html>
