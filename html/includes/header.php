<!DOCTYPE html>
<html lang="en">
<head>
	<title>efungenda homepage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owlcarousel/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Montserrat:400" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<body>
<div class="col-lg-12 col-md-12 col-xs-12 head-banner">
	<div class="container headpart">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topheader">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 logodiv">
		 		<img src="images/logo.png" class="img-responsive logo">
		 	</div>
		 	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 text-right headprofileselect">
		 		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 headprofile">
			 		<!--design of sign up and sign-in-->
				 	<!-- <p>
				 		<a href="#" class="sign" data-toggle="modal" data-target="#myModal">LOGIN |</a>
				 		<a href="#" class="sign" data-toggle="modal" data-target="#signupmodal">&nbsp;SIGNUP</a>
			 		</p> -->
				 	<!--design of sign up and sign-in end-->
				 	<!--design of when sign in a profile start-->	
			 		<div class="dropdown show">
					  	<a class="btn btn-secondary dropdown-toggle personalprofile" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    	<img src="images/account_icon.png" class="img-responsive proficon"> &nbsp;Johnathon Doe <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<div class="dropdown-menu profiledropdown" aria-labelledby="dropdownMenuLink">
						    <li><a class="dropdown-item" href="loggedin.php">HOME</a></li>
						    <li><a class="dropdown-item" href="createevent.php">CREATE EVENT</a></li>
						    <li><a class="dropdown-item" href="createbusiness.php">CREATE BUSINESS</a></li>
						    <li><a class="dropdown-item" href="myfavourite.php">MY FAVOURITES</a></li>
						    <li><a class="dropdown-item" href="offer-section.php">OFFER SECTION</a></li>
						    <li><a class="dropdown-item" href="profile.php">PROFILE</a></li>
						    <li><a class="dropdown-item" href="accountsetting.php">ACCOUNT SETTINGS</a></li>
						    <li><a class="dropdown-item" href="#">LOG OUT</a></li>
						</div>
					</div>
				<!--design of when sign in a profile end-->
			 		<div class="selectdropdown">
				 		<select class="top-dropdown">
							<option value="volvo">English</option>
							<option value="saab">English</option>
							<option value="mercedes">English</option>
						</select>
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
			        <li class="highlight"><a href="index.php">HOME</a></li>
			        <li><a href="#">EVENTS</a>
				        <ul class="headernavmenulist">
							<li><a href= "viewevents.php">View All Events</a></li>
						</ul>
					</li>
					<li><a href="#">BUSINESSES</a>
				        <ul class="headernavmenulist">
							<li><a href= "viewbusiness.php">View All Businesses</a></li>
						</ul>
					</li>
					<li><a href="#">CATEGORIES</a>
				        <ul class="headernavmenulist">
							<li><a href= "community-changed.php">Community</a></li>
							<li><a href= "diningcategory.php">Dining</a></li>
							<li><a href= "healthfitnesscategory.php">Health & Fitness</a></li>
							<li><a href= "sportscategory.php">Sports</a></li>
							<li><a href= "funsober.php">Fun 'n Sober</a></li>
						</ul>
					</li>
			        <li><a href="shared-location.php">SHARED LOCATIONS</a></li>
	        	</ul>
	    	</div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
</div>
<!--end navbar-->