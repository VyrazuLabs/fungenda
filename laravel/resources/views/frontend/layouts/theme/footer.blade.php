
<!--start footer-->
<div class="col-md-12 footer">
	<div class="container">
		<div class="col-md-12">
			<div class="col-md-12 footer-details">
				<div class="col-md-4 left-footer-content">
					<h3 class="recent-list">Recent Listing</h3>
					<ul class="footer-list">
						<li><a href="#">Hawali West</a></li>
						<li><a href="#">P..F chang's</a></li>
						<li><a href="#">2 Alcatraz Tours</a></li>
						<li><a href="#">Dave's Test Event 2</a></li>
						<li><a href="#">Dave's Test Business 2</a></li>
					</ul>
				</div>
				<div class="col-md-8">
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
			<div class="col-md-12">
				<p class="text-center last-text"><a href="#">Copyright &#9400; 2017 eFUNgenda.<span class="terms">Terms & Conditions | Privacy Policy</span></a></p>
			</div>
		</div>
	</div>
</div>
<!--end footer-->
<!--profile head design start-->

<!--profile head design end-->

<!--sign in page design-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      	<div class="col-md-12 sign-in">
			<div class="col-md-12">
				<div class="modal-header crossbtn">
					<button type="button" class="close" data-dismiss="modal"><img src="images/cross.png"></button>
				</div>
			</div>
			<div class="col-md-6">
		        <div class="modal-body">
		          	<img src="images/sign-in.png" class="img-responsive signinimage">
		          	<p class="text-center account"><a href="#">Don't Have an Account? Sign Up Now!</a></p>
		        </div>
		    </div>
		    <div class="col-md-6 second-form-div">
		        <p class="text-center head"><span style="color:#252525">SIGN</span><span class="in"> IN</span></p>
		        	<form class="boxes">
  						<label for="fname" class="sign-label">ENTER EMAIL</label>
						<input type="text" id="enter-mail" name="fname">
					</form>
					<form class="boxes">
							<label for="lname" class="sign-label">PASSWORD</label>
							<input type="text" id="enter-pw" name="lname">
					</form>
					<form>
						<input type="checkbox" id="rememberme" name="cc">
						<span></span>
						<label for="c1" class="remember">Remember me</label>
					</form>
		        	<button type="button" class="btn sign-login">Login</button>
		        <p class="text-center forget-pw"><a href="#">FORGOT YOUR PASSWORD</a></p>
		    </div>
		</div>
    </div>
</div>

<!--sign in page design end-->
<!--sign up page design-->
  	<div class="modal fade" id="myModal-1" role="dialog">
    	<div class="modal-dialog modal-md">
      		<div class="col-md-12 sign-in">
				<div class="col-md-12">
					<div class="modal-header crossbtn">
						<button type="button" class="close" data-dismiss="modal"><img src="images/cross.png"></button>
					</div>
				</div>
				<div class="col-md-6">
		        	<div class="modal-body">
		          		<img src="images/sign-up.png" class="img-responsive img-signup">
		          		<p class="text-center account"><a href="#">Already Signed UP?Click here to Login!</a></p>
		        	</div>
		        </div>
		        <div class="col-md-6 second-form-div">
		        	<p class="text-center head"><span style="color:#252525">SIGN</span><span style="color:#ed202e"> UP</span></p>
		        	<form class="boxes">
  						<label for="fname" class="sign-label">EMAIL ADDRESS</label>
						<input type="text" id="enter-mail" name="fname">
					</form>
					<form class="boxes">
						<label for="lname" class="sign-label">PASSWORD</label>
						<input type="text" id="enter-pw" name="lname">
					</form>
					<form class="boxes">
						<label for="lname" class="sign-label">CONFIRM PASSWORD</label>
						<input type="text" id="enter-pw" name="lname">
					</form>
					<form class="boxes">
						<input type="checkbox" id="iagree" name="cc" />
						<span></span>
    					<label for="c1" class="remember" >I agree with all <a href="#">Terms & Conditions</a></label>
					</form>
		        	<button type="button" class="btn sign-sign-up">Sign Up</button>
		        </div>
		    </div>
    	</div>
  	</div>

<!--sign up page design end-->

<script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ url('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ url('js/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ url('js/custom.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlnFMM7LYrLdByQPJopWVNXq0mJRtqb38&callback=myMap"></script>
<script type="text/javascript">
	// $('#fromdate').datepicker();
	$('.datecalender').datepicker({
	    format: 'mm/dd/yyyy',
	    startDate: '-3d',
	    autoclose: true
	});
</script>
@yield('add-js')
</body>
</html>