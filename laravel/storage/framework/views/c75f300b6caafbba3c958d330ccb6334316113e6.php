<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">
			<?php if(isset($all_business)): ?>
              <p class="profile text-left">Edit Business:</p>
            <?php else: ?>
              <p class="profile text-left">Create Business:</p>
            <?php endif; ?>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard">
				<div class="text-center profileform">
					<?php if(session('city_id')): ?>
						<dir style="display: none;" id="city_id"><?php echo e(session("city_id")); ?></dir>
					<?php endif; ?>
					<?php if(empty($all_business)): ?>
                      <?php echo Form::open(['url' => '/save-business', 'method' => 'post', 'files'=>'true']); ?>

                    <?php endif; ?>
                    <?php if(!empty($all_business)): ?>
                      <?php echo e(Form::model($all_business,['method'=>'post', 'files'=>'true', 'url'=>'/business/update'])); ?>

                      <?php echo e(Form::hidden('business_id',null,[])); ?>

                    <?php endif; ?>

				 		<?php echo e(csrf_field()); ?>

				 		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				 			<?php echo e(Form::label('eventname','BUSINESS NAME')); ?>

				 			<span class="require-star"></span>
		      				<?php echo e(Form::text('name',null,['id'=>'eventname','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Name'])); ?>

		      				<?php if($errors->has('name')): ?>
                                <span id="eventnameerror" class="help-block">
                                    <span class="signup-error"><?php echo e($errors->first('name')); ?></span>
                                </span>
                            <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('category','CATEGORY')); ?>

		      				<span class="require-star"></span>
		      				<div class="categoryselect">
								<?php echo e(Form::select('category',$all_category1, null,['class'=>'form-control categorydropdown darkOption' ] )); ?>

								<?php if($errors->has('category')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('category')); ?></span>
                                    </span>
                                <?php endif; ?>
							</div>

		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('business_description','ENTER BRIEF DESCRIPTION OF THE BUSINESS')); ?>

		      				<?php echo e(Form::textarea('business_description', null, ['size' => '64x7','placeholder'=>'Enter Description of the business','class'=>'createeventtextarea','id'=>'business_description'])); ?>

		      				<?php if($errors->has('business_description')): ?>
                                <span class="help-block">
                                    <span id="eventcommenterror" class="signup-error"><?php echo e($errors->first('business_description')); ?></span>
                                </span>
                            <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                          <?php echo e(Form::label('tags','TAGS')); ?>

                          <div class="categoryselect">
                            <?php echo e(Form::select('tags[]',$all_tag, null,[ 'multiple'=>'multiple','class'=>'tagdropdown form-control add-tag categorydropdown' ])); ?>

                          </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
			      			<label for="image">MAIN IMAGE</label>
			      			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 eventmainimagediv">
			      				<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 p-0 eventmaintextboxdiv">
				      				<div id="uploadmainfile" class="upload-file-container" >
				      					<span id="uploadmainfile" class="businessselectfile"></span>
				      				</div>
								</div>
			      				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
									<button type="button" class="btn btn-secondary browsebtn">Browse</button>
			      					<?php echo e(Form::file('main_file[]', ['id'=>'mainfiles','class'=>'eventbrowsefile'])); ?>

			      					<output id="list"></output>
			      				</div>
			      				<?php if($errors->has('main_file')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('main_file')); ?></span>
                                    </span>
                                <?php endif; ?>
							</div>
						</div>
						<?php if(isset($business)): ?>
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
	                        <div class="edit-image-show-div">
	                         <?php if(!empty($business['business_main_image'])): ?>
	                          <span>
	                            <?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$business['business_main_image']) == 1): ?>
	                              <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/business'.'/'.$business['business_main_image'])); ?>">
	                            <?php else: ?>
	                              <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event/placeholder.svg')); ?>">
	                            <?php endif; ?>
	                            <a href= "<?php echo e(route('business_edit_main_image_delete',['business_id'=> $business['business_id'],'img_name'=>$business['business_main_image']])); ?>" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
	                          </span>
	                         <?php endif; ?>
	                        </div>
						</div>
						<?php endif; ?>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
			      			<label for="image">IMAGE</label>
			      			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventimagediv">
			      				<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 eventtextboxdiv">
				      				<div id="uploadfile" class="upload-file-container" >
				      					<span id="uploadfile" class="businessselectfile"></span>
				      				</div>
								</div>
			      				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			      					<button type="button" class="btn btn-secondary browsebtn">Browse</button>
			      					<?php echo e(Form::file('file[]', ['multiple' => 'multiple','id'=>'files','class'=>'eventbrowsefile'])); ?>

			      					<output id="list"></output>
								</div>
								<?php if($errors->has('file')): ?>
								<span class="help-block">
									<span class="signup-error"><?php echo e($errors->first('file')); ?></span>
								</span>
								<?php endif; ?>
							</div>
						</div>
						<?php if(isset($business)): ?>
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
			      			<?php $__currentLoopData = $business['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        <div class="edit-image-show-div">
	                         <?php if($image): ?>
	                          <span>
	                            <?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$image) == 1): ?>
	                              <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/business'.'/'.$image)); ?>">
	                            <?php else: ?>
	                              <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event/placeholder.svg')); ?>">
	                            <?php endif; ?>
	                                <a href= "<?php echo e(route('business_edit_image_delete',['business_id'=> $business->business_id,'img_name'=>$image])); ?>" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
	                          </span>
	                         <?php endif; ?>
	                        </div>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						<?php endif; ?>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				<?php echo e(Form::label('eventcost','BUSINESS COST')); ?>

				      				<!-- <span class="require-star"></span> -->
				      				<?php echo e(Form::text('costbusiness',null,['id'=>'eventcost','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Amount'])); ?>

				      				<?php if($errors->has('costbusiness')): ?>
                                    <span id="eventcosterror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('costbusiness')); ?></span>
                                    </span>
                                <?php endif; ?>
				      			</div>

				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
				      				<?php echo e(Form::label('discount','DISCOUNT(IF AVAILABLE)')); ?>

				      				<?php echo e(Form::text('businessdiscount',null,['id'=>'discount','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Discount'])); ?>

				      				<?php if($errors->has('businessdiscount')): ?>
	                                    <span class="help-block">
	                                        <span class="signup-error"><?php echo e($errors->first('businessdiscount')); ?></span>
	                                    </span>
	                                <?php endif; ?>
				      			</div>

			      			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup checkboxdivcreate">
						    <?php echo e(Form::label('createeventcheckbox','OTHERS')); ?>

						    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
						    		<?php if(isset($all_event['checkbox']) && $all_event['checkbox'] == '1,2'): ?>
										<div class="form-group checkboxlist createventcheckboxlst">
											<?php echo e(Form::checkbox('checkbox[]',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly'])); ?>

											<span></span>
									    <?php echo e(Form::label('kidfriendly','Kid Friendly')); ?>

										</div>
										<div class="form-group checkboxlist createventcheckboxlst">
											<?php echo e(Form::checkbox('checkbox[]',2,true, ['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

											<span></span>
									    <?php echo e(Form::label('petfriendly','Pet Friendly')); ?>

										</div>
					    			<?php else: ?>
									<div class="form-group checkboxlist createventcheckboxlst">
										<?php if(isset($all_business['checkbox'])): ?>
											<?php if($all_business['checkbox'] == 1): ?>
			                                <?php echo e(Form::checkbox('checkbox[]',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly'])); ?>

			                                <?php else: ?>
			                                <?php echo e(Form::checkbox('checkbox[]',1,false, ['class' => 'signincheckbox','id'=>'kidfriendly'])); ?>

			                                <?php endif; ?>
			                            <?php else: ?>
			                            	<?php echo e(Form::checkbox('checkbox[]',1,null, ['class' => 'signincheckbox','id'=>'kidfriendly'])); ?>

			                            <?php endif; ?>
										<span></span>
									    <?php echo e(Form::label('kidfriendly','Kid Friendly')); ?>

									</div>
									<div class="form-group checkboxlist createventcheckboxlst">
										<?php if(isset($all_business['checkbox'])): ?>
											<?php if($all_business['checkbox'] == 2): ?>
			                                <?php echo e(Form::checkbox('checkbox[]',2,true, ['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

			                                <?php else: ?>
			                                <?php echo e(Form::checkbox('checkbox[]',2,false, ['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

			                                <?php endif; ?>
			                            <?php else: ?>
			                            	<?php echo e(Form::checkbox('checkbox[]',2,null, ['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

			                            <?php endif; ?>
									    <span></span>
									    <?php echo e(Form::label('petfriendly','Pet Friendly')); ?>

									</div>
								<?php endif; ?>
			    			</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<label for="venue" class="houroperation">HOURS OF OPERATION</label>
		      				<div class="form-group operationgroup">
		      					<div class="col-md-12 form-inline operationform">
		      						<div class="col-md-4 day">
		      						<?php echo e(Form::label('venue','Sun')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
				      					<?php echo e(Form::text('sunday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('sun_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('sunday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('sun_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
		      					<div class="col-md-12 form-inline operationform">
		      						<div class="col-md-4 day">
		      						<?php echo e(Form::label('venue','Mon')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
				      					<?php echo e(Form::text('monday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('mon_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('monday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('mon_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						<?php echo e(Form::label('venue','Tue')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
										<?php echo e(Form::text('tuesday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('tue_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('tuesday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('tue_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						<?php echo e(Form::label('venue','Wed')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
										<?php echo e(Form::text('wednessday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('wed_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('wednessday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('wed_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						<?php echo e(Form::label('venue','Thurs')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
										<?php echo e(Form::text('thursday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('thurs_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('thursday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('thurs_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						<?php echo e(Form::label('venue','Fri')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
										<?php echo e(Form::text('friday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('fri_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('friday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('fri_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
			      				<div class="col-md-12 form-inline operationform">
			      					<div class="col-md-4 day">
			      						<?php echo e(Form::label('venue','Sat')); ?>

			      					</div>
			      					<div class="col-md-8 daylist">
										<?php echo e(Form::text('saturday_start',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('sat_start_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

										<span>to</span>
										<?php echo e(Form::text('saturday_end',null,['class'=>'form-control operationformcontrol'])); ?>

										<?php echo e(Form::select('sat_end_hour',['AM','PM'], null,['class'=>'form-control operationformcontrol'] )); ?>

									</div>
			      				</div>
			      			</div>
				      	</div>
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('venue','VENUE')); ?>

		      				<!-- <span class="require-star"></span> -->
		      				<?php echo e(Form::text('venue',null,['id'=>'venue','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Venue of Your Business'])); ?>

		      				<?php if($errors->has('venue')): ?>
                                <span id="venueerror" class="help-block">
                                    <span class="signup-error"><?php echo e($errors->first('venue')); ?></span>
                                </span>
                            <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('streetaddress','ADDRESS')); ?>

		      				<span class="require-star"></span>
		      				<?php echo e(Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Address of Venue'])); ?>

		      				<?php if($errors->has('address_line_1')): ?>
                                    <span id="streetaddress1error" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('address_line_1')); ?></span>
                                    </span>
                                <?php endif; ?>
		    			</div>

		    			<div style="display: none;" class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('streetaddress','ADDRESS LINE 2')); ?>

		      				<span class="require-star"></span>
		      				<?php echo e(Form::text('address_line_2',null,['id'=>'streetaddress2','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Street Address of Venue'])); ?>

		      				<?php if($errors->has('address_line_2')): ?>
                                    <span id="streetaddress2error" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('address_line_2')); ?></span>
                                    </span>
                                <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountdropdowngroup">
				    			<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
					      			<label for="city">COUNTRY</label>
					      			<span class="require-star"></span>
						      		<div class="select">
						      			<?php echo e(Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'citydropdown', 'placeholder'=>'--select--' ] )); ?>

						      			<?php if($errors->has('country')): ?>
                                    <span id="countrydropdownerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('country')); ?></span>
                                    </span>
                                <?php endif; ?>
									</div>

								</div> -->

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountdropddwnclass">
									<label for="state">STATE</label>
									<span class="require-star"></span>
									<div class="createevent-state">
										<?php if(isset($business['respected_states'])): ?>
			                              <?php echo e(Form::select('state',$business['respected_states'], null,[ 'id' => 'state', 'class'=>'stateblock searchState', 'placeholder'=>'--select--' ] )); ?>

			                            <?php else: ?>
			                            <?php echo e(Form::select('state',$all_states, null,[ 'id' => 'state','class'=>'stateblock searchState', 'placeholder'=>'--select--'] )); ?>

			                            <?php endif; ?>
									 	<?php if($errors->has('state')): ?>
		                                    <span id="stateerror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('state')); ?></span>
		                                    </span>
		                                <?php endif; ?>
									</div>


								</div>

							</div>
				    	</div>

				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountdropdowngroup">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">

					      			<label for="city">CITY</label>
					      			<!-- <span class="require-star"></span> -->
					      			<?php  $testArray =['0'=>'Select'];  ?>
						      		<div class="createevent-state">
						      			<?php if(isset($business['respected_city'])): ?>
			                              <?php echo e(Form::select('city',$business['respected_city'], null,[ 'id' => 'citydropdown','class'=>'citydropdown searchState', 'placeholder'=>'--select--' ] )); ?>

			                            <?php else: ?>
			                            <?php echo e(Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'citydropdown searchState', 'placeholder'=>'--select--' ] )); ?>

			                            <?php endif; ?>
						      			<?php if($errors->has('city')): ?>
                                    		<span id="citydropdownerror" class="help-block">
                                        	<span class="signup-error"><?php echo e($errors->first('city')); ?></span>
                                    		</span>
                                		<?php endif; ?>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass">
									<?php echo e(Form::label('zipcode','ZIP CODE')); ?>

									<span class="require-star"></span>
									<?php echo e(Form::text('zipcode',null,['id'=>'zipcode','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Zip Code'])); ?>

									<?php if($errors->has('zipcode')): ?>
	                                    <span id="zipcodeerror" class="help-block">
	                                        <span class="signup-error"><?php echo e($errors->first('zipcode')); ?></span>
	                                    </span>
	                                <?php endif; ?>
								</div>

							</div>
				    	</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
						      		<?php echo e(Form::label('latitude','LATITUDE')); ?>

						      		<span class="require-star"></span>
						      		<?php echo e(Form::text('latitude',null,['id'=>'latitude','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Latitude','readonly'])); ?>

						      		<?php if($errors->has('latitude')): ?>
                                    <span id="latitudeerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('latitude')); ?></span>
                                    </span>
                                	<?php endif; ?>
						      	</div>

						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
							      	<?php echo e(Form::label('longitude','LONGITUDE')); ?>

							      	<span class="require-star"></span>
						      		<?php echo e(Form::text('longitude',null,['id'=>'longitude','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Longitude','readonly'])); ?>

						      		<?php if($errors->has('longitude')): ?>
                                    <span id="longitudeerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('longitude')); ?></span>
                                    </span>
                                	<?php endif; ?>
						      	</div>

					      	</div>
		    			</div>
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
							<div class="googlemaping createeventgooglemap">
  								<div id="map" class="googlemap"></div>
  							</div>
  						</div>
  						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
					      		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
						      		<?php echo e(Form::label('contactno','CONTACT NO')); ?>

						      		<?php echo e(Form::text('contactNo',null,['id'=>'contactno','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Contact No.'])); ?>

						      		<?php if($errors->has('contactNo')): ?>
                                    <span id="contactnoerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('contactNo')); ?></span>
                                    </span>
                                <?php endif; ?>
						      	</div>

						      	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
							      	<?php echo e(Form::label('email','EMAIL')); ?>

						      		<?php echo e(Form::text('email',null,['id'=>'emailid','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Email Id.'])); ?>

						      		<?php if($errors->has('email')): ?>
                                    <span id="emailiderror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('email')); ?></span>
                                    </span>
                                <?php endif; ?>
						      	</div>

					      	</div>
					    </div>
					    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<?php echo e(Form::label('websitelink','WEBSITE LINK')); ?>

						    <?php echo e(Form::text('websitelink',null,['id'=>'webname','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Website Link'])); ?>

						    <?php if($errors->has('websitelink')): ?>
                                    <span id="webnameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('websitelink')); ?></span>
                                    </span>
                                <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<?php echo e(Form::label('fblink','FB LINK')); ?>

						    <?php echo e(Form::text('fblink',null,['id'=>'fbname','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Facebook Link'])); ?>

						    <?php if($errors->has('fblink')): ?>
                                    <span id="fbnameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('fblink')); ?></span>
                                    </span>
                                <?php endif; ?>
		    			</div>

				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<?php echo e(Form::label('twitterlink','TWITTER LINK')); ?>

						    <?php echo e(Form::text('twitterlink',null,['id'=>'twittername','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Twitter Link'])); ?>

						    <?php if($errors->has('twitterlink')): ?>
                                    <span id="twitternameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('twitterlink')); ?></span>
                                    </span>
                                <?php endif; ?>
				    	</div>

				    	<div class="text-center profilesavebtn">
				    		<?php if(empty($all_business)): ?>
				    			<?php echo e(Form::submit('Create Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile'])); ?>

				    		<?php else: ?>
		    					<?php echo e(Form::submit('Update Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile'])); ?>

		    				<?php endif; ?>
		    			</div>
		    		<?php echo Form::close(); ?>

		    	</div>
		    </div>
		</div>
	</div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">
	/* state selection by searching */
	$('.searchState').select2({
		placeholder: "Select"
	});

	$(document).ready(function(){
		$('#countrydropdown').on('change', function(){
		var value = $(this).val();
		// console.log(value);
		$.ajax({
			type: 'get',
			url: "<?php echo e(url('/fetch_state_business')); ?>",
			data: { data: value },
			success: function(data){
				// console.log(data);
				$('#state').empty();
				$.each(data,function(index, value){
					$('#state').append('<option value="'+ index +'">'+value+'</option>');
				});
			}
		});
	});

		$('#state').on('change', function() {
    	var value = $(this).val();
	    	// console.log(value);
	    	$.ajax({
	    		type: 'get',
	    		url: "<?php echo e(url('/fetch_country_business')); ?>",
	    		data: { data: value },
	    		success: function(data){
	    			// console.log(data);
	    			$('#citydropdown').empty();
	    			$.each(data,function(index, value){
	    				$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
	    				// console.log(value);
	    			});
	    		}
	    	});
		});

		var state_id = $('#state').val();
		var city_id = $('#city_id').html();
		$.ajax({
	    		type: 'get',
	    		url: "<?php echo e(url('/fetch_country_business')); ?>",
	    		data: { data: state_id },
	    		success: function(data){
	    			// console.log(data);
	    			$('#citydropdown').empty();
	    			$.each(data,function(index, value){
	    				if(index == city_id) {
	    					$('#citydropdown').append('<option value="'+ index +'" selected>'+value+'</option>');
	    				}
	    				else {
	    					$('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
	    				}
	    				// console.log(value);
	    			});
	    		}
	    	});

		// $('#citydropdown').on('change',function(){
	 //    	var address1 = $('#streetaddress1').val();
	 //    	var address2 = $('#streetaddress2').val();
	 //    	var country = $('#countrydropdown option:selected').text();
	 //    	var state = $('#state option:selected').text();
	 //    	var city = $('#citydropdown option:selected').text();
	 //    	var full_address = address1+','+address2+','+country+','+state+','+city;
	 //    	var longitude = $('#longitude').val();
	 //    	var latitude = $('#latitude').val();
	 //    	$.ajax({
		// 	  url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
		// 	  type: "POST",
		// 	  success:function(res){
		// 	  	// console.log(longitude);
		// 	  	// console.log(latitude);
		// 	    var lat = res.results[0].geometry.location.lat;
		// 	    var long = res.results[0].geometry.location.lng;
		// 	    var long_diff = Math.pow((longitude - long), 2);
		// 	    var lat_diff = Math.pow((latitude - lat), 2);
		// 	    var difference = Math.sqrt(long_diff + lat_diff)*100;

		// 	    if(difference > 10){
		// 	    	new PNotify({
		//               title: 'Error',
		//               text: 'Venue and address should be within 10 km',
		//               type: 'error',
		//               buttons: {
		//                   sticker: false
		//               }
		//           	});
		//           	$("input[type=submit]").attr('disabled','disabled');
		// 	    }
		// 	    else{
		// 	    	$("input[type=submit]").removeAttr('disabled');
		// 	    }
		// 	  }
		// 	});
  //   	});

	});

	function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
	// files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('uploadfile').innerHTML =  output.join('');
    // console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
	}

$('#eventname').on('keyup',function(){
	$('#eventnameerror').html('');
})

$('#eventcost').on('keyup',function(){
	$('#eventcosterror').html('');
})

$('#eventcomment').on('keyup',function(){
	$('#eventcommenterror').html('');
})

$('#datestart').on('focus',function(){
	$('#datestarterror').html('');
})

$('#timestart').on('focus',function(){
	$('#timestarterror').html('');
})

$('#dateend').on('focus',function(){
	$('#dateenderror').html('');
})

$('#timeend').on('focus',function(){
	$('#timeenderror').html('');
})

$('#venue').on('keyup',function(){
	$('#venueerror').html('');
	if($('#longitude').html != ''){
		$('#longitudeerror').html('');
	}
	if($('#latitude').html != ''){
		$('#latitudeerror').html('');
	}
})

$('#streetaddress1').on('keyup',function(){
	$('#streetaddress1error').html('');
})

$('#streetaddress2').on('keyup',function(){
	$('#streetaddress2error').html('');
})

$('#countrydropdown').on('change',function(){
	$('#countrydropdownerror').html('');
})

$('#state').on('change',function(){
	$('#stateerror').html('');
})

$('#citydropdown').on('change',function(){
	$('#citydropdownerror').html('');
})

$('#zipcode').on('keyup',function(){
	$('#zipcodeerror').html('');
})

$('#contactno').on('keyup',function(){
	$('#contactnoerror').html('');
})

$('#emailid').on('keyup',function(){
	$('#emailiderror').html('');
})

$('#webname').on('keyup',function(){
  $('#webnameerror').html('');
})

$('#fbname').on('keyup',function(){
  $('#fbnameerror').html('');
})

$('#twittername').on('keyup',function(){
  $('#twitternameerror').html('');
})
$('#dateend').on('blur',function(){
  var StartDate= $('#datestart').val();
  var EndDate= $(this).val();
  var eDate = new Date(EndDate);
  var sDate = new Date(StartDate);
  if(StartDate!= '' && StartDate!= '' && sDate> eDate){
  	$("input[type=submit]").attr('disabled','disabled');
    new PNotify({
      title: 'Error',
      text: 'Please ensure that the End Date is greater than or equal to the Start Date.',
      type: 'error',
      buttons: {
          sticker: false
      }
  	});
  }
  else{
  	$("input[type=submit]").removeAttr('disabled');
  }
})

// function initAutocomplete() {
// 	var map = new google.maps.Map(document.getElementById('map'), {
// 	  center: {lat: 38.889931, lng: -77.009003},
// 	  zoom: 13,
// 	  mapTypeId: 'roadmap'
// 	});

// 	// Create the search box and link it to the UI element.
// 	var input = document.getElementById('streetaddress1');
// 	var searchBox = new google.maps.places.SearchBox(input);
// 	// map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

// 	// Bias the SearchBox results towards current map's viewport.
// 	map.addListener('bounds_changed', function() {
// 	  searchBox.setBounds(map.getBounds());
// 	});

// 	var markers = [];
// 	// Listen for the event fired when the user selects a prediction and retrieve
// 	// more details for that place.
// 	searchBox.addListener('places_changed', function() {
// 	  var places = searchBox.getPlaces();

// 	  if (places.length == 0) {
// 	    return;
// 	  }

// 	  // Clear out the old markers.
// 	  markers.forEach(function(marker) {
// 	    marker.setMap(null);
// 	  });
// 	  markers = [];

// 	  // For each place, get the icon, name and location.
// 	  var bounds = new google.maps.LatLngBounds();
// 	  places.forEach(function(place) {
// 	    if (!place.geometry) {
// 	      console.log("Returned place contains no geometry");
// 	      return;
// 	    }
// 	    var icon = {
// 	      url: place.icon,
// 	      size: new google.maps.Size(71, 71),
// 	      origin: new google.maps.Point(0, 0),
// 	      anchor: new google.maps.Point(17, 34),
// 	      scaledSize: new google.maps.Size(25, 25)
// 	    };

// 	    // Create a marker for each place.
// 	    markers.push(new google.maps.Marker({
// 	      map: map,
// 	      icon: icon,
// 	      title: place.name,
// 	      position: place.geometry.location
// 	    }));

// 	    if (place.geometry.viewport) {
// 	      // Only geocodes have viewport.
// 	      bounds.union(place.geometry.viewport);
// 	    } else {
// 	      bounds.extend(place.geometry.location);
// 	    }

// 	    document.getElementById('latitude').value = place.geometry.location.lat();
// 		document.getElementById('longitude').value = place.geometry.location.lng();
// 		// console.log(place.geometry.location.lat());
// 		var lat = place.geometry.location.lat();
// 		var long = place.geometry.location.lng();
// 		$.ajax({
// 		    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+long+'&sensor=false',
// 		    success: function(data){
// 		        var formatted = data.results;
// 		        var address_array = formatted[6].formatted_address.split(',');
// 		        // var city = address_array[0];
// 		         $.each( data['results'],function(i, val) {
// 	                $.each( val['address_components'],function(i, val) {
// 	                    if (val['types'] == "locality,political") {
// 	                        if (val['long_name']!="") {
// 	                            // console.log(val['long_name']);
// 	                            $('#city_share_location').val(val['long_name']);
// 	                        }
// 	                        else {
// 	                            console.log("unknown");
// 	                        }
// 	                    }
// 	                });
// 	            })
// 		        // console.log(address_array);
// 		   }
// 		});
// 	  });
// 	  map.fitBounds(bounds);
// 	});
// }
function initMap() {

	var current_lat = $('#latitude').val();
	var current_lng = $('#longitude').val();

	var current_lat_modified = 40.4173;
	if(current_lat) {
		current_lat_modified = parseFloat(current_lat);
	}

	var current_lng_modified = -82.9071;
	if(current_lng) {
		current_lng_modified = parseFloat(current_lng);
	}

	var map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: current_lat_modified, lng: current_lng_modified},
	  zoom: 7
	});


	var input = document.getElementById('streetaddress1');

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

	marker.setPosition(map.center);
 	// This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function(event) {
	  var geocoder = new google.maps.Geocoder;
	  var pos = {
	      lat: event.latLng.lat(),
	      lng: event.latLng.lng()
	    };
	  geocodeLatLng(geocoder, map, pos);
      marker.setPosition(event.latLng);
    });

	autocomplete.addListener('place_changed', function() {
	  marker.setVisible(false);
	  var place = autocomplete.getPlace();
		$('#latitude').val(place.geometry.location.lat());
		$('#longitude').val(place.geometry.location.lng());
	  if (!place.geometry) {
	    // User entered the name of a Place that was not suggested and
	    // pressed the Enter key, or the Place Details request failed.
	    window.alert("No details available for input: '" + place.name + "'");
	    return;
	  }

	  // If the place has a geometry, then present it on a map.
	  if (place.geometry.viewport) {
	    map.fitBounds(place.geometry.viewport);
	  } else {
	    map.setCenter(place.geometry.location);
	    map.setZoom(17);  // Why 17? Because it looks good.
	  }
	  marker.setPosition(place.geometry.location);
	  marker.setVisible(true);
	});
}

function geocodeLatLng(geocoder, map, pos) {
	$('#latitude').val(pos.lat);
	$('#longitude').val(pos.lng);
	geocoder.geocode({'location': pos}, function(results, status) {
	  if (status === 'OK') {
	    if (results[0]) {
	      $('#streetaddress1').val(results[0].formatted_address);
	    } else {
	      window.alert('No results found');
	    }
	  } else {
	    window.alert('Geocoder failed due to: ' + status);
	  }
	});
}

// main image upload start
	function mainHandleFileSelect(evt) {
	    var files = evt.target.files; // FileList object
		// files is a FileList of File objects. List some properties.
	    var output = [];
	    for (var i = 0, f; f = files[i]; i++) {
	      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
	    }
	    document.getElementById('uploadmainfile').innerHTML =  output.join('');
	    // console.log(output);
	}

  document.getElementById('mainfiles').addEventListener('change', mainHandleFileSelect, false);
	function close_btn(cross){
		$(cross).parent().remove();
  }
// main image upload end
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHZpcyDU3JbFSCUDIEN59Apxj4EqDomI&libraries=places&callback=initMap"
         async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>