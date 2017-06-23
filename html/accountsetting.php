<?php include('includes/header.php'); ?>
<section>
<div class="col-md-12">
	<div class="container text-center">
		<div class="col-md-12 profilediv">
			<p class="text-center profile">Account Settings</p>
		</div>
		<div class="col-md-8 profileimgdiv">
			<div class="profilecard accountcard">
				<div class="col-md-12 accountpicform">
					<div class="col-md-4 accountpersondiv">
						<div class="picbtn accountpicbtn">
							<div class="profileimgdiv">
						 		<img src="images/personicon.png" class="img-responsive personicon">
						 	</div>
						 	<div class="profilebrowsebtndiv">
						 		<button type="button" class="btn btn-secondary profilebrowsebtn">Browse</button>
						 	</div>
						</div>
					</div>
					<div class="col-md-8 accountsettingdiv">
					 	<div class="text-center accountformform">
						 	<form>
						 		<div class="col-md-10 col-xs-10 form-group accountgroup">
				      				<label for="disabledTextInput">Email</label>
				      				<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Name">
				    			</div>
				    			<div class="col-md-10 col-xs-10 form-group accountgroup">
				      				<label for="disabledTextInput">Old Password</label>
				      				<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Email">
				    			</div>
				    			<div class="col-md-10 col-xs-10 form-group accountgroup">
				      				<label for="disabledTextInput">New Password</label>
				      				<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Phone No.">
				    			</div>
				    			<div class="col-md-10 col-xs-10 form-group accountgroup">
				      				<label for="disabledTextInput">Confirm New Password</label>
				      				<input type="text" id="disabledTextInput" name="location" class="form-control profileinput" placeholder="Enter Address">
				    			</div>
				    			<div class="col-md-10 col-sm-10 col-xs-12 form-group accountgroup">
				    				<button type="button" class="btn btn-secondary changepswbtn">Change Password</button>
				    			</div>
				    			<div class="col-md-10 col-xs-10 form-group accountgroup">
				    				<label for="disabledTextInput">Location</label>
				    				<div class="col-md-12 accountdropdowngroup">
					      				<div class="col-md-4 col-sm-4 col-xs-4 accountdropddwnclass">
							      			<div class="dropdown">
												<button class="btn btn-secondary dropdown-toggle accountdropdwn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<a href="#">City        <i class="fa fa-angle-down" aria-hidden="true"></i></a>
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li><a class="dropdown-item" href="#">Kolkata</a></li>
													<li><a class="dropdown-item" href="#">Kolkata</a></li>
													<Li><a class="dropdown-item" href="#">Kolkata</a></Li>
												</div>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 accountdropddwnclass">
											<div class="dropdown">
												<button class="btn btn-secondary dropdown-toggle accountdropdwn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<a href="#">
												State        <i class="fa fa-angle-down" aria-hidden="true"></i></a>
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li><a class="dropdown-item" href="#">West Bengal</a></li>
													<li><a class="dropdown-item" href="#">West Bengal</a></li>
													<Li><a class="dropdown-item" href="#">West Bengal</a></Li>
												</div>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-10 accountdropddwnclass">
											<div class="dropdown">
												<button class="btn btn-secondary dropdown-toggle accountdropdwn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												 	<a href="#">Country <i class="fa fa-angle-down" aria-hidden="true"></i></a>
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li><a class="dropdown-item" href="#">India</a></li>
													<li><a class="dropdown-item" href="#">India</a></li>
													<Li><a class="dropdown-item" href="#">India</a></Li>
												</div>
											</div>
										</div>
									</div>
				    			</div>
				    			<div class="col-md-10 col-xs-10 form-group accountgroup switchnotification">
				    				<div class="col-md-12 accountnotification">
				    					<div class="col-md-6 col-xs-6 emailnotification">
				      						<label for="disabledTextInput">Email Notifications:</label>
				      					</div>
				      					<div class="col-md-6 col-xs-6 toggleswitch">
				      						<label class="switch">
												<input type="checkbox" checked>
												<div class="slider round"></div>
											</label>
				      					</div>
				      				</div>
				    			</div>
				    			<div class="col-md-10 col-xs-10 form-group accountgroup">
				      				<div class="col-md-12 accountradiobtn">
				      					<div class="col-md-4 accountradiobtngroup">
											<label class="custom-control custom-radio">
								  				<input id="radio1" name="radio" type="radio" class="custom-control-input" checked>
								  				<span class="custom-control-indicator"></span>
								  				<span class="custom-control-description">Daily</span>
											</label>
										</div>
										<div class="col-md-4 accountradiobtngroup">
											<label class="custom-control custom-radio event-btn">
								  				<input id="radio2" name="radio" type="radio" class="custom-control-input">
								  				<span class="custom-control-indicator"></span>
								 				<span class="custom-control-description">Weekly</span>
											</label>
										</div>
										<div class="col-md-4 accountradiobtngroup">
											<label class="custom-control custom-radio event-btn">
								  				<input id="radio2" name="radio" type="radio" class="custom-control-input">
								  				<span class="custom-control-indicator"></span>
								 				<span class="custom-control-description">Monthly</span>
											</label>
										</div>
									</div>
				    			</div>
				    			<div class="col-md-10 col-sm-10 col-xs-12 form-group profilegroup accountgroup accountsettingbtndiv">
				    				<button type="button" class="btn btn-secondary changepswbtn accntsavebtn">Save All</button>
				    			</div>
							 </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php include('includes/footer.php'); ?>
