
<!--start footer-->
<div class="col-lg-12 col-md-12 col-xs-12 footer">
	<div class="container footcontain">
		<div class="col-lg-12 col-md-12 col-xs-12 sidefooter">
			<div class="col-lg-12 col-md-12 col-xs-12 footer-details">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left-footer-content">
					<h3 class="recent-list">Recent Listing</h3>
					<ul class="footer-list">
						<li><a href="{{ route('frontend_more_event') }}">Hawali West</a></li>
						<li><a href="{{ route('frontend_more_event') }}">P..F chang's</a></li>
						<li><a href="{{ route('frontend_more_event') }}">2 Alcatraz Tours</a></li>
						<li><a href="{{ route('frontend_more_event') }}">Dave's Test Event 2</a></li>
						<li><a href="{{ route('frontend_more_event') }}">Dave's Test Business 2</a></li>
					</ul>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<h3 class="share">Share eFungenda</h3>
					<div class="footer-icon">
						<a class="btn btn-social-icon btn-facebook footersocialicongroup foot-facebook"><span class="fa fa-facebook"></span></a>
						<a class="btn btn-social-icon btn-twitter footersocialicongroup foot-twitter"><span class="fa fa-twitter"></span></a>
						<a class="btn btn-social-icon btn-linkedin footersocialicongroup foot-linkedin"><span class="fa fa-linkedin"></span></a>
						<a class="btn btn-social-icon btn-google-plus footersocialicongroup foot-google-plus"><span class="fa fa-google-plus"></span></a>
						<a class="btn btn-social-icon btn-pinterest footersocialicongroup foot-pinterest"><span class="fa fa-pinterest"></span></a>
						<a class="btn btn-social-icon btn-envelope footersocialicongroup foot-envelop"><span class="fa fa-envelope"></span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p class="text-center last-text"><a href="#">Copyright &#9400; 2017 eFUNgenda.<span class="terms">Terms & Conditions | Privacy Policy</span></a></p>
			</div>
		</div>
	</div>
</div>
<!--end footer-->
<!--sign in page design-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sign-in">
			<div class="modal-header crossbtn">
				<div class="col-lg-12 col-md-12 col-xs-12">
					<button type="button" class="close" data-dismiss="modal"><img src="{{ url('images/cross.png') }}"></button>
				</div>
			</div>
			<div class="modal-body col-lg-12 col-md-12 col-xs-12 signindiv">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<img src="{{ url('images/sign-in.png') }}" class="img-responsive signinimage">
					<span class="signintextimg">
						<p class="text-center account signupacnt"><a href="#">Don't Have an Account?</a></p><p class="text-center account signupacnt"><a href="#">Sign Up Now!</a></p>
					</span>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-form-div signinformdiv">
					<p class="text-center head"><span style="color:#252525">SIGN</span><span class="in"> IN</span></p>
					{{-- working --}}
				    <form class="boxes">
				    		{{ csrf_field() }}
					    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
			  				<label for="fname" class="sign-label">ENTER EMAIL</label>
							<input type="text" id="enter-mail" class="form-control signincontrol" name="email">
							<span id="error-email"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">	
							<label for="lname" class="sign-label">PASSWORD</label>
							<input type="password" id="enter-pw" class="form-control signincontrol" name="password">
							<span id="error-password"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">	
							<input type="checkbox" id="rememberme" class="signincheckbox" name="cc">
							<span></span>
							<label for="rememberme" class="remember">Remember me</label>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
							<button type="button" id="btn-sub" class="btn sign-login">Login</button>
						</div>
					</form>
					<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinfoot">
						<p class="text-center forget-pw"><a href="#">FORGOT YOUR PASSWORD</a></p>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!--sign in page design end-->
<!--sign up page design-->
<div class="modal fade" id="signupmodal" role="dialog">
	<div class="modal-dialog modal-md">
  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sign-in">
			<div class="modal-header crossbtn">
				<div class="col-lg-12 col-md-12 col-xs-12">
					<button type="button" class="close" data-dismiss="modal"><img src="{{ url('images/cross.png') }}"></button>
				</div>
			</div>
	    	<div class="modal-body col-lg-12 col-md-12 col-xs-12 signindiv">
	        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		          	<img src="{{ url('images/sign-up.png') }}" class="img-responsive img-signup">
		          	<span class="signintextimg">
		          		<p class="text-center account loginacnt"><a href="#">Already Signed UP?Click here</a></p><p class="text-center account loginacnt"><a href="#">to Login Now!</a></p>
		          	</span>
	        	</div>
	       		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-form-div signinformdiv">
	        		<p class="text-center head"><span style="color:#252525">SIGN</span><span style="color:#ed202e"> UP</span></p>
	        		{{-- working --}}
	        		<form class="boxes">
	        			{{ csrf_field() }}
	        			<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
  							<label for="first_name" class="sign-label">First Name</label>
							<input type="text" id="first_name" class="form-control signincontrol" name="first_name">
							 <span id="error-first-name"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
  							<label for="last_name" class="sign-label">Last Name</label>
							<input type="text" id="last_name" class="form-control signincontrol" name="last_name">
							<span id="error-last-name"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
  							<label for="email" class="sign-label">EMAIL ADDRESS</label>
							<input type="text" id="email" class="form-control signincontrol" name="email">
							<span id="error-email-id"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
							<label for="password" class="sign-label">PASSWORD</label>
							<input type="password" id="password" class="form-control signincontrol" name="password">
							<span id="error-password-reg"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">
							<label for="confirm_password" class="sign-label">CONFIRM PASSWORD</label>
							<input type="password" id="confirm_password" class="form-control signincontrol" name="confirm_password">
							<span id="error-confirm-password-reg"></span>
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 col-xs-12 signinmailpw">
							<input type="checkbox" id="iagree" class="signincheckbox" name="iagree" />
							<span></span>
	    					<label for="iagree" class="remember" >I agree with all <a href="#">Terms & Conditions</a></label>
	    					@if ($errors->has('iagree'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('iagree') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinmailpw">	
							<button type="button" id="sign-up-btn" class="btn sign-login sign-up">Sign Up</button>
						</div>
					</form>
				</div>
	        </div>
	    </div>
	</div>
</div>
<!--sign up page design end-->
<!--start forget password-->
<div class="modal fade" id="forgetmyModal" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sign-in">
			<div class="modal-header crossbtn">
				<div class="col-lg-12 col-md-12 col-xs-12">
					<button type="button" class="close" data-dismiss="modal"><img src="{{ url('images/cross.png') }}"></button>
				</div>
			</div>
			<div class="modal-body col-lg-12 col-md-12 col-xs-12 forgotdiv">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 forgetimagediv">
					<img src="{{ url('images/key.png') }}" class="img-responsive forgetimage">
					<p class="text-center forget"><a href="#">Please enter your Registered Email a link will be send to reset your password </a></p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 forget-form-div">
					<p class="text-left forgethead"><span style="color:#252525">FORGOT</span><span class="in"> PASSWORD?</span></p>
				    <form class="boxes">
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forgetmail">
			  				<label for="fname" class="sign-label">ENTER EMAIL</label>
							<input type="text" id="enter-mail" class="form-control signincontrol" name="fname">
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forgetmail">
							<button type="button" class="btn sign-login sendlink">Send Link</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 signinfoot"></div>
		</div>
    </div>
</div>
<!--end forget password-->
<script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ url('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ url('js/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ url('js/moment.min.js') }}"></script>
<script src="{{ url('js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ url('js/custom.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlnFMM7LYrLdByQPJopWVNXq0mJRtqb38"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
<script type="text/javascript">
// 	// $('#fromdate').datepicker();
// 	$('.datecalender').datetimepicker({
// 	    format: 'L'
// 	});
// 	$(".datecalender").on("dp.show", function (e) {
//         $(this).parent().addClass('dates');
//     });
// 	$(".datecalender").on("dp.hide", function (e) {
//         $(this).parent().removeClass('dates');
//     });
</script>
 <script type="text/javascript">
// 	// $('#fromdate').datepicker();
// 	$('.eventstarttime').datetimepicker({
// 	    format: 'LT'
// 	});
// 	$(".eventstarttime").on("dp.show", function (e) {
//         $(this).parent().addClass('times');
//     });
// 	$(".eventstarttime").on("dp.hide", function (e) {
//         $(this).parent().removeClass('times');
//     });
// </script>
{{-- working --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('#btn-sub').click(function(){
			var email = $('#enter-mail').val();
			var password = $('#enter-pw').val();
			$.ajax({
				headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'},	
				type: 'post',
				url: "{{ url('/loginUser') }}",	
				data: {'email':email,
					   'password': password,
					  },
				success: function(data){
					console.log(data);
					if(data.status == 1){
						location.reload();
					}
					if(data.status == 2){
						swal(
							  'Oops...',
							  'Credential not matched',
							  'error'
							)
					}
					console.log(data.email[0]);
					if(data.email){
						if(data.email[0]){
							$('#error-email').html(data.email[0]);
						}
					}
					if(data.password){
						if(data.password[0]){
							$('#error-password').html(data.password[0]);
						}
					}
				}	
			});
		});

		$('#sign-up-btn').click(function(){
			var first_name = $('#first_name').val();
			var last_name = $('#last_name').val();
			var email = $('#email').val();
			var password = $('#password').val();
			var confirm_password = $('#confirm_password').val();
			var iagree = $('#iagree').val();
			$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ url('/user_registration') }}",
				data: { 'first_name': first_name,
						'last_name': last_name,
						'email': email,
						'password': password,
						'confirm_password': confirm_password,
						'iagree': iagree,
					  },
				success: function(data){
					console.log(data);
					if(data.status == 1){
						location.reload();
					}
					if(data.status == 2){
						swal(
							  'Oops...',
							  'Something Wrong',
							  'error'
							)
					}
					if(data.first_name){
						if(data.first_name[0]){
							$('#error-first-name').html(data.first_name[0]);
						}
					}
					if(data.last_name){
						if(data.last_name[0]){
							$('#error-last-name').html(data.last_name[0]);
						}
					}
					if(data.email){
						if(data.email[0]){
							$('#error-email-id').html(data.email[0]);
						}
					}
					if(data.password){
						if(data.password[0]){
							$('#error-password-reg').html(data.password[0]);
						}
					}
				}
			});
		});
		// Add to favorite section
		$('.add_fav_business').click(function(){
    		var fav_business_id = $(this).attr('data-id');
    		var specific = $(this);
    		$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ route('add_to_favourite_business') }}",
				data: { 'business_id': fav_business_id },
				success: function(data){
					console.log(data);
					if(data.status == 1){
						specific.hide();
						specific.next('.rvm_fav_business').show();
					}
					if(data.status == 2){
						$('#myModal').modal('show');
					}

				}
			});
    	});
    	// Remove from favorite section
    	$('.rvm_fav_business').click(function(){
    		var rvm_business_id = $(this).attr('data-id');
    		var specific = $(this);
    		$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ route('remove_to_favourite_business') }}",
				data: { 'business_id': rvm_business_id },
				success: function(data){
					console.log(data);
					if(data.status == 1){
						specific.hide();
						specific.prev('.add_fav_business').show();
					}
				}
			});
    	});

    	// Add to favorite section for event
		$('.add_fav_event').click(function(){
    		var fav_business_id = $(this).attr('data-id');
    		var specific = $(this);
    		$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ route('add_to_favourite_event') }}",
				data: { 'event_id': fav_business_id },
				success: function(data){
					console.log(data);
					if(data.status == 1){
						specific.hide();
						specific.next('.rvm_fav_event').show();
					}
					if(data.status == 2){
						$('#myModal').modal('show');
					}

				}
			});
    	});
    	// Remove from favorite section
    	$('.rvm_fav_event').click(function(){
    		var rvm_business_id = $(this).attr('data-id');
    		var specific = $(this);
    		$.ajax({
				headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
				type: 'post',
				url: "{{ route('remove_to_favourite_event') }}",
				data: { 'event_id': rvm_business_id },
				success: function(data){
					console.log(data);
					if(data.status == 1){
						specific.hide();
						specific.prev('.add_fav_event').show();
					}
				}
			});
    	});
	});
</script>
@yield('add-js')
</body>
</html>