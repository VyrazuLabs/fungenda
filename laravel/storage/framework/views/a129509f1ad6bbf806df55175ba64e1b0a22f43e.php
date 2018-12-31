<!DOCTYPE html>
<html lang="en">
<head>
	<title>efungenda</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(url('/images/logo.png')); ?>">
	<meta charset="utf-8">
	<?php echo $__env->yieldContent('meta_tag'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo e(url('css/bootstrap/bootstrap.min.css')); ?>">
	<!-- <link rel="stylesheet" href="<?php echo e(url('css/owlcarousel/owl.carousel.min.css')); ?>"> -->
	<!-- <link rel="stylesheet" href="<?php echo e(url('css/owlcarousel/owl.theme.default.min.css')); ?>">  -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/font-awesome/font-awesome.min.css')); ?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Montserrat:400" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo e(url('css/bootstrap-datetimepicker.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo e(url('css/slick/slick.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(url('css/slick/slick-theme.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/select2.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/pnotify.custom.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(url('css/ladda.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/style.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/responsive.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/css-for-print/pdf-styles.css')); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="https://d33wubrfki0l68.cloudfront.net/css/ce0d3810ba62cdbf3ae167a6b1829daa41ece751/css/print.css"> -->

</head>
<body>
	<div class="col-lg-12 col-md-12 col-xs-12 head-banner">
		<div class="container headpart">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topheader">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 logodiv">
			 		<a href="<?php echo e(url('/share-your-location')); ?>" title="test" id="test"><img src="<?php echo e(url('/images/logo.png')); ?>" class="img-responsive logo" alt="banner image"></a>
			 	</div>
			 	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 text-right headprofileselect">
			 		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 headprofile">
				 		<!--design of sign up and sign-in-->
				 		<?php if(!Auth::user()): ?>
					 	<p>
					 		<a href="#" id="login_user" class="sign" data-toggle="modal" data-target="#myModal">LOGIN |</a>
					 		<a href="#" id="signup_user" class="sign" data-toggle="modal" data-target="#signupmodal">&nbsp;SIGNUP</a>
				 		</p>
				 		<?php endif; ?>
					 	<!--design of sign up and sign-in end-->
					 	<!--design of when sign in a profile start-->

				 		<div class="dropdown show">
				 		<?php if(Auth::user()): ?>
					 		<?php if(!empty(Auth::user()->getUserDetails()->first())): ?>
					 		  <?php if(Auth::user() && file_exists(public_path().'/'.'images'.'/'.'user/'.Auth::user()->getUserDetails->user_image)): ?>
							  	<a class="btn btn-secondary dropdown-toggle personalprofile" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    	<img src="<?php echo e(url('images').'/'.'user/'.Auth::user()->getUserDetails->user_image); ?>" class="img-responsive proficon profile-icon-round"> &nbsp;<?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
							    </a>
							  <?php endif; ?>
							  <?php if(Auth::user() && !file_exists(public_path().'/'.'images'.'/'.'user/'.Auth::user()->getUserDetails->user_image)): ?>
							  	<a class="btn btn-secondary dropdown-toggle personalprofile" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    	<img src="<?php echo e(url('/images/personicon.png')); ?>" class="img-responsive proficon"> &nbsp;<?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
							    </a>
							  <?php endif; ?>
							<?php else: ?>

								<a class="btn btn-secondary dropdown-toggle personalprofile" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    	<img src="<?php echo e(url('/images/personicon.png')); ?>" class="img-responsive proficon"> &nbsp;<?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
							    </a>
							<?php endif; ?>
						<?php endif; ?>
							<div class="dropdown-menu profiledropdown" aria-labelledby="dropdownMenuLink">
							    <li><a class="dropdown-item" href="<?php echo e(route('fronted_home')); ?>">HOME</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('frontend_create_event')); ?>">CREATE EVENT</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('frontend_create_business')); ?>">CREATE BUSINESS</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('frontend_my_faourite')); ?>">MY FAVORITES</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('frontend_profile_page')); ?>">PROFILE</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('frontend_acount_settings')); ?>">ACCOUNT SETTINGS</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('create_share_location')); ?>">SHARE YOUR LOCATION</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('members_home_page')); ?>">MEMBER HOME PAGE</a></li>
							    <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>">LOG OUT</a></li>
							</div>
						</div>
					<!--design of when sign in a profile end-->
				 		<div class="languagedropdown">
							<div id="google_translate_element" class="headlanguage-select"></div>
						</div>
					</div>
			 	</div>
			</div>
		</div>
	</div>
	<!--start navbar-->
	<div class="col-lg-12 col-md-12 col-xs-12 navigation-bar">
		<nav class="navbar navbar-default">
		  	<div class="container">
		    	<!-- Brand and toggle get grouped for better mobile display -->
		    	<div class="navbar-header">
		      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        		<span class="sr-only">Toggle navigation</span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		      		</button>
		    	</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
		    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      		<ul class="nav navbar-nav navbar-left">
				        <li class="highlight"><a href="<?php echo e(route('fronted_home')); ?>">HOME</a></li>
				        <li><a href="#">EVENTS</a>
					        <ul class="headernavmenulist">
								<li><a href= "<?php echo e(route('frontend_view_events')); ?>">View All Events</a></li>
							</ul>
						</li>
						<li><a href="#">BUSINESSES</a>
					        <ul class="headernavmenulist">
								<li><a href= "<?php echo e(route('frontend_view_business')); ?>">View All Businesses</a></li>
							</ul>
						</li>
						<li><a href="#">CATEGORIES</a>
					    <ul class="headernavmenulist">
				        <?php $__currentLoopData = Menu::getRootCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li><a href= "<?php echo e(route('frontend_category',['q'=>$category['category_id']])); ?>"><?php echo e($category['name']); ?></a>
										<?php if( count(Menu::getChildrens($category)) > 0 ): ?>
											<ul class="communitysub">
												<?php $__currentLoopData = Menu::getChildrens($category); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if($value->category_status == 1): ?>
													<li><a href="<?php echo e(route('frontend_category',['q'=>$value->category_id])); ?>"><?php echo e($value->name); ?></a></li>
													<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php endif; ?>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</li>
			        <li><a href="<?php echo e(route('frontend_shared_location')); ?>">SHARED LOCATIONS</a></li>
	        	</ul>
		    	</div><!-- /.navbar-collapse -->
		  	</div><!-- /.container-fluid -->
		</nav>
	</div>
	<!--end navbar-->
