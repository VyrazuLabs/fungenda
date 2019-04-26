<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container text-center">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">
			<?php if(isset($all_event)): ?>
              <p class="profile text-left">Edit Event:</p>
            <?php else: ?>
              <p class="profile text-left">Create Event:</p>
            <?php endif; ?>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
			<div class="profilecard">
				<div class="text-center profileform">
				<?php if(session('city_id')): ?>
					<dir style="display: none;" id="city_id"><?php echo e(session("city_id")); ?></dir>
				<?php endif; ?>
				 <?php if(empty($all_event)): ?>
                    <?php echo Form::open(['url' => '/save-events', 'method' => 'post', 'files'=>'true']); ?>

                 <?php endif; ?>
                 <?php if(!empty($all_event)): ?>
                    <?php echo e(Form::model($all_event,['method'=>'post', 'files'=>'true', 'url'=>'/event/update','id'=>'event_creation_form'])); ?>


                    <?php echo e(Form::hidden('event_id',null,[])); ?>


                 <?php endif; ?>
				 		<?php echo e(csrf_field()); ?>

				 		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('eventname','EVENT NAME')); ?>

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
			                <?php echo e(Form::label('tags','TAGS')); ?>

			                <div class="categoryselect">
			                  <?php echo e(Form::select('tags[]',$all_tag, null,[ 'multiple'=>'multiple','class'=>'tagdropdown form-control add-tag categorydropdown add-new-tag' ])); ?>

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
						<?php if(isset($event)): ?>
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
	                            <div class="edit-image-show-div">
	                             <?php if(!empty($event['event_main_image'])): ?>
	                              <span>
	                                <?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$event['event_main_image']) == 1): ?>
	                                  <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event'.'/'.$event['event_main_image'])); ?>">
	                                <?php else: ?>
	                                  <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event/placeholder.svg')); ?>">
	                              	<?php endif; ?>
	                              	<a href= "<?php echo e(route('event_edit_main_image_delete',['event_id'=> $event['event_id'],'img_name'=>$event['event_main_image']])); ?>" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
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
						<?php if(isset($event)): ?>
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
							<?php $__currentLoopData = $event['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <div class="edit-image-show-div">
	                             <?php if($image): ?>
	                              <span>
	                                <?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$image) == 1): ?>
	                                  <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event'.'/'.$image)); ?>">
	                                <?php else: ?>
	                                  <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event/placeholder.svg')); ?>">
	                                <?php endif; ?>
	                                  <a href= "<?php echo e(route('event_edit_image_delete',['event_id'=> $event->event_id,'img_name'=>$image])); ?>" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
	                              </span>
	                             <?php endif; ?>
	                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						<?php endif; ?>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv">
			      				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventcostdiv">
				      				<?php echo e(Form::label('eventcost','EVENT COST')); ?>

				      				<!-- <span class="require-star"></span> -->
				      				<?php echo e(Form::text('costevent',null,['id'=>'eventcost','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Amount'])); ?>

				      				<?php if($errors->has('costevent')): ?>
                                    <span id="eventcosterror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('costevent')); ?></span>
                                    </span>
                                <?php endif; ?>
				      			</div>

				      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 createeventdiscountdiv">
					      			<?php echo e(Form::label('discount','DISCOUNT(IF AVAILABLE)')); ?>

				      				<?php echo e(Form::text('eventdiscount',null,['id'=>'discount','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Discount'])); ?>

				      				<?php if($errors->has('eventdiscount')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('eventdiscount')); ?></span>
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
										 	<?php echo e(Form::checkbox('checkbox[]',2,true,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

										 	<span></span>
										    <?php echo e(Form::label('petfriendly','Pet Friendly')); ?>

										 </div>
										<?php else: ?>
										<div class="form-group checkboxlist createventcheckboxlst">
											<?php if(isset($all_event['checkbox'])): ?>
												<?php if($all_event['checkbox'] == 1): ?>
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
										<?php if(isset($all_event['checkbox'])): ?>
											<?php if($all_event['checkbox'] == 2): ?>
										    <?php echo e(Form::checkbox('checkbox[]',2,true,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

										    <?php else: ?>
										    <?php echo e(Form::checkbox('checkbox[]',2,false,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

										    <?php endif; ?>
										<?php else: ?>
											<?php echo e(Form::checkbox('checkbox[]',2,null,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

										<?php endif; ?>
										    <span></span>
										    <?php echo e(Form::label('petfriendly','Pet Friendly')); ?>

										</div>
										<?php endif; ?>
			    				</div>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('description','ENTER BRIEF DESCRIPTION OF DISCOUNT')); ?>

		      				<?php echo e(Form::textarea('comment', null, ['size' => '64x7','placeholder'=>'Enter Description of Discount','class'=>'createeventtextarea','id'=>'eventcomment'])); ?>

		      				<?php if($errors->has('comment')): ?>
                                    <span class="help-block">
                                        <span id="eventcommenterror" class="signup-error"><?php echo e($errors->first('comment')); ?></span>
                                    </span>
                                <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('event_description','ENTER BRIEF DESCRIPTION OF THE EVENT')); ?>

		      				<?php echo e(Form::textarea('event_description', null, ['size' => '64x7','placeholder'=>'Enter Description of the event','class'=>'createeventtextarea','id'=>'event_description'])); ?>

		      				<?php if($errors->has('event_description')): ?>
                                    <span class="help-block">
                                        <span id="eventcommenterror" class="signup-error"><?php echo e($errors->first('event_description')); ?></span>
                                    </span>
                                <?php endif; ?>
		    			</div>

		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		    				<label>RECURRING</label>
		      				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accountradiobtn recurringbtn-bg">
		      					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
									<label class="custom-control custom-radio">
						  				<?php echo e(Form::radio('recurring_status', 1, false, ['class' => 'custom-control-input','id'=>'radio1'])); ?>

						  				<span class="custom-control-indicator"></span>
						  				<span class="custom-control-description">Daily</span>
									</label>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
									<label class="custom-control custom-radio event-btn">
						  				<?php echo e(Form::radio('recurring_status', 2, false, ['class' => 'custom-control-input','id'=>'radio2'])); ?>

						  				<span class="custom-control-indicator"></span>
						 				<span class="custom-control-description">Weekly</span>
									</label>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 accountradiobtngroup">
									<label class="custom-control custom-radio event-btn">
						  				<?php echo e(Form::radio('recurring_status', 3, false, ['class' => 'custom-control-input','id'=>'radio3'])); ?>

						  				<span class="custom-control-indicator"></span>
						 				<span class="custom-control-description">Monthly</span>
									</label>
								</div>
							</div>
		    			</div>

		    			<?php 
		    				$dateTimeArray =[];
	                    	if (Session::has('event_date_time_array')) {
			                    $dateTimeArray = Session::get('event_date_time_array');
			                    Session::forget('event_date_time_array');
			                }
			                $start_date_name='';
			                $start_time_name='';
			                $end_time_name='';
			                $i = 0;
			                $addFieldNo = '';
	                     ?>

		    			<?php if(empty($all_event)): ?>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup increaseZ">
		    				<?php if(empty($dateTimeArray)): ?>

			    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv datetime set0">
			    					<input type="hidden" class="event-time-date origin" value=''>
				      				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventcostdiv">
					      				<?php echo e(Form::label('startdate','START DATE')); ?>

					      				<span class="require-star"></span>
					      				<span class="notranslate">
					      				<?php echo e(Form::text('startdate',null,['id'=>'datestart','class'=>'form-control profileinput createeventinput datetimecalender','placeholder'=>'Select Date','onblur'=>'dateValidation(datestart)'])); ?>

					      				</span>
					      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
					      				<img src="<?php echo e(url('images/calenderpic.png')); ?>" class="img-responsive createcalender">
					      				<?php if($errors->has('startdate')): ?>
		                                    <span id="datestarterror" class="help-block">
		                                        <span class="signup-error">
		                                        <?php echo e($errors->first('startdate')); ?>

		                                        </span>
		                                    </span>
		                                <?php endif; ?>
					      			</div>
					      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">
						      			<?php echo e(Form::label('starttime','START TIME')); ?>

						      			<span class="require-star"></span>
						      			<span class="notranslate">
					      				<?php echo e(Form::text('starttime',null,['id'=>'timestart','class'=>'form-control profileinput createeventinput eventstarttime starttime','placeholder'=>'Select Time','onblur'=>'strttimeValidation(this)'])); ?>

					      				</span>
										<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
					      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
					      				<?php if($errors->has('starttime')): ?>
		                                    <span id="timestarterror" class="help-block">
		                                        <span class="signup-error">
		                                        <?php echo e($errors->first('starttime')); ?>

		                                        </span>
		                                    </span>
		                                <?php endif; ?>
						      		</div>
						      		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">
						      			<?php echo e(Form::label('endtime','END TIME')); ?>

						      			<span class="require-star"></span>
						      			<span class="notranslate">
					      				<?php echo e(Form::text('endtime',null,['id'=>'timeend','class'=>'form-control profileinput createeventinput eventstarttime endtime','placeholder'=>'Select Time','onblur'=>'endtimeValidation(this)'])); ?>

					      				</span>
					      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
					      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
					      				<?php if($errors->has('endtime')): ?>
		                                    <span id="timeenderror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('endtime')); ?></span>
		                                    </span>
	                               	 	<?php endif; ?>
					      			</div>

				      			</div>
				      		<?php else: ?>


				      		<?php if(count($dateTimeArray) > 0): ?>
		            			<?php  $addFieldNo = count($dateTimeArray)-1;  ?>
		            		<?php else: ?>
		            			<?php  $addFieldNo = 0;  ?>
		            		<?php endif; ?>
				      		<input type="hidden" class="event-time-date inval" value="<?php echo e($addFieldNo); ?>">
				      		<?php  $i = 0;
				      		$addFieldNo = '';
				      		 ?>
				      		<?php $__currentLoopData = $dateTimeArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				      			<?php 
					      			$indexno = $i++;
						            if ($indexno > 0) {
						              	$addFieldNo = $indexno;
						            }
						            $start_date_name=array_search($value['startdate'],$value).$addFieldNo;
					                $start_time_name=array_search($value['starttime'],$value).$addFieldNo;
					                $endtime_name=array_search($value['endtime'],$value).$addFieldNo;
					             ?>

					      		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv datetime set0">
				      				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventcostdiv">
					      				<?php echo e(Form::label('startdate','START DATE')); ?>

					      				<span class="require-star"></span>
					      				<span class="notranslate">
					      				<?php echo e(Form::text($start_date_name,null,['id'=>'datestart','class'=>'form-control profileinput createeventinput datetimecalender','placeholder'=>'Select Date','onblur'=>'dateValidation(datestart)'])); ?>

					      				</span>
					      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
					      				<img src="<?php echo e(url('images/calenderpic.png')); ?>" class="img-responsive createcalender">
					      				<?php if($errors->has('startdate')): ?>
		                                    <span id="datestarterror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('startdate')); ?></span>
		                                    </span>
		                                <?php endif; ?>
					      			</div>
					      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">
						      			<?php echo e(Form::label('starttime','START TIME')); ?>

						      			<span class="require-star"></span>
						      			<span class="notranslate">
					      				<?php echo e(Form::text($start_time_name,null,['id'=>'timestart','class'=>'form-control profileinput createeventinput eventstarttime starttime','placeholder'=>'Select Time','onblur'=>'strttimeValidation(this)'])); ?>

					      				</span>
										<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
					      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
					      				<?php if($errors->has('starttime')): ?>
		                                    <span id="timestarterror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('starttime')); ?></span>
		                                    </span>
		                                <?php endif; ?>
						      		</div>
						      		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">
						      			<?php echo e(Form::label('endtime','END TIME')); ?>

						      			<span class="require-star"></span>
						      			<span class="notranslate">
					      				<?php echo e(Form::text($endtime_name,null,['id'=>'timeend','class'=>'form-control profileinput createeventinput eventstarttime endtime','placeholder'=>'Select Time','onblur'=>'endtimeValidation(this)'])); ?>

					      				</span>
					      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
					      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
					      				<?php if($errors->has('endtime')): ?>
		                                    <span id="timeenderror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('endtime')); ?></span>
		                                    </span>
	                               	 	<?php endif; ?>
					      			</div>
				      			</div>
				      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				      		<?php endif; ?>
		    			</div>
		    			<?php else: ?>
		    				<?php echo e(Form::hidden('delete_event_time',0,['class'=>'deleteEventTime'])); ?>

		    				<?php 
		    					$counter = 20;
		    					$count = 0;
		    				 ?>
		    				<?php $__currentLoopData = $all_event['all_date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    					<?php 
		    						$counter++;
		    					 ?>
				    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup increaseZ">
				    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv datetime set<?php echo e($count); ?>" id="dateset<?php echo e($count); ?>">
					      				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventcostdiv">
						      				<?php echo e(Form::label('startdate','START DATE')); ?>

						      				<span class="require-star"></span>

						      				<input type="text" name="startdate<?php echo e($counter==21?'':$counter); ?>" value="<?php echo e($date['startdate']); ?>" class="form-control profileinput createeventinput datetimecalender" id="datestart<?php echo e($counter); ?>" placeholder="Select Date" onblur="dateValidation(datestart<?php echo e($counter); ?>">

						      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
						      				<img src="<?php echo e(url('images/calenderpic.png')); ?>" class="img-responsive createcalender">
						      				<?php if($errors->has('startdate')): ?>
		                                    <span id="datestarterror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('startdate')); ?></span>
		                                    </span>
		                                <?php endif; ?>
						      			</div>

						      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">
							      			<?php echo e(Form::label('starttime','START TIME')); ?>

							      			<span class="require-star"></span>
						      				<!-- <?php echo e(Form::text('starttime',$date['starttime'],['id'=>'timestart','class'=>'form-control profileinput createeventinput eventstarttime','placeholder'=>'Select Time'])); ?> -->

											<input type="text" name="starttime<?php echo e($counter==21?'':$counter); ?>" value="<?php echo e($date['starttime']); ?>" class="form-control profileinput createeventinput eventstarttime starttime" id="timestart<?php echo e($counter); ?>" placeholder="Select Time" onblur="timeValidation(datestart<?php echo e($counter); ?>,timestart<?php echo e($counter); ?>,timeend<?php echo e($counter); ?>)">

											<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
						      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
						      				<?php if($errors->has('starttime')): ?>
		                                    <span id="timestarterror" class="help-block">
		                                        <span class="signup-error"><?php echo e($errors->first('starttime')); ?></span>
		                                    </span>
		                                <?php endif; ?>
							      		</div>

										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">
							      			<?php echo e(Form::label('endtime','END TIME')); ?>

							      			<span class="require-star"></span>
						      				<!-- <?php echo e(Form::text('endtime',$date['endtime'],['id'=>'timeend','class'=>'form-control profileinput createeventinput eventstarttime','placeholder'=>'Select Time'])); ?> -->

											<input type="text" name="endtime<?php echo e($counter==21?'':$counter); ?>" value="<?php echo e($date['endtime']); ?>" class="form-control profileinput createeventinput eventstarttime endtime" id="timeend<?php echo e($counter); ?>" placeholder="Select Time" onblur="timeValidation(datestart<?php echo e($counter); ?>,timestart<?php echo e($counter); ?>,timeend<?php echo e($counter); ?>)">

						      				<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>
						      				<i class="fa fa-clock-o timepick" aria-hidden="true"></i>
						      				<?php if($errors->has('endtime')): ?>
			                                    <span id="timeenderror" class="help-block">
			                                        <span class="signup-error"><?php echo e($errors->first('endtime')); ?></span>
			                                    </span>
		                               	 	<?php endif; ?>
						      			</div>
						      			<?php if($count > 0): ?>
						      			<a class="edit-image-cross delete-event-date" style="cursor: pointer;" data-attr="dateset<?php echo e($count); ?>" ><i class="fa fa-times cross" aria-hidden="true"></i></a>


						      			<?php endif; ?>

					      			</div>
				    			</div>
				    			<?php 
				    				$count++;
				    			 ?>
 						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
		    			<div id="another_date_div"></div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup paragraphdiv">
		    				<p class="createeventdate"><a href="JavaScript:Void(0);" id="add_date">Add another Date for this Event</a></p>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
		      				<?php echo e(Form::label('venue','VENUE')); ?>

		      				<!-- <span class="require-star"></span> -->
		      				<?php echo e(Form::text('venue',null,['id'=>'venue','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Venue of Your Event'])); ?>

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
										<?php echo e(Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'citydropdown','placeholder'=>'--select--' ] )); ?>

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
									<?php if(isset($event['respected_states'])): ?>
		                              <?php echo e(Form::select('state',$event['respected_states'], null,[ 'id' => 'state', 'class'=>'form-control stateblock searchState', 'placeholder'=>'--select--' ] )); ?>

		                            <?php else: ?>
		                              <?php echo e(Form::select('state',$all_states, null,[ 'id' => 'state', 'class'=>'form-control stateblock searchState', 'placeholder'=>'--select--' ] )); ?>

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
						      		<div class="createevent-state">
						      		<?php if(isset($event['respected_city'])): ?>
		                              <?php echo e(Form::select('city',$event['respected_city'], null,[ 'id' => 'citydropdown','class'=>'citydropdown searchState', 'placeholder'=>'--select--' ] )); ?>

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

						    <?php echo e(Form::text('websitelink',null,['id'=>'websitelink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Website Link'])); ?>

						    <?php if($errors->has('websitelink')): ?>
                                <span class="help-block">
                                    <span class="signup-error"><?php echo e($errors->first('website link')); ?></span>
                                </span>
                            <?php endif; ?>
		    			</div>
		    			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<?php echo e(Form::label('fblink','FB LINK')); ?>

						    <?php echo e(Form::text('fblink',null,['id'=>'disabledTextInput','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Facebook Link'])); ?>

						    <?php if($errors->has('fblink')): ?>
                                <span class="help-block">
                                    <span class="signup-error"><?php echo e($errors->first('fblink')); ?></span>
                                </span>
                            <?php endif; ?>
		    			</div>
				    	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
				      		<?php echo e(Form::label('twitterlink','TWITTER LINK')); ?>

						    <?php echo e(Form::text('twitterlink',null,['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter Twitter Link'])); ?>

						    <?php if($errors->has('twitterlink')): ?>
                                <span class="help-block">
                                    <span class="signup-error"><?php echo e($errors->first('twitterlink')); ?></span>
                                </span>
                            <?php endif; ?>
				    	</div>
				    	<div class="text-center profilesavebtn">
				    		<?php if(isset($all_event)): ?>
				    		<?php echo e(Form::submit('Update Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile timeCheck'])); ?>

				    		<?php else: ?>
		    				<?php echo e(Form::submit('Create Now',['class'=>'btn btn-secondary profilebrowsebtn saveprofile timeCheck'])); ?>

		    				<?php endif; ?>
		    			</div>
		    		<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">

/* remove event dates */
$('.delete-event-date').click(function(){
	var dateSetId = $(this).attr('data-attr');
	$("#"+dateSetId).empty();
	$('.deleteEventTime').val('1'); // this status ensures that delete event has fired
	$( "#event_creation_form" ).submit();
});

/* state selection by searching */
$('.searchState').select2({
	placeholder: "Select"
});

$(".add-new-tag").select2({
  tags: true
});

//image upload start
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
//image upload end
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
//for date time picker start
function dateTimePicker(){
	$('.datetimecalender').datetimepicker({
	    format: 'L'
	});
	$(".datetimecalender").on("dp.show", function (e) {
        $(this).parent().parent().addClass('dates');
    });
	$(".datetimecalender").on("dp.hide", function (e) {
        $(this).parent().parent().removeClass('dates');
    });

	// $('#fromdate').datepicker();
	$('.eventstarttime').datetimepicker({
	    format: 'LT'
	});
	$(".eventstarttime").on("dp.show", function (e) {
        $(this).parent().parent().addClass('times');
    });
	$(".eventstarttime").on("dp.hide", function (e) {
        $(this).parent().parent().removeClass('times');
    });
}
$(document).ready(function(){
	dateTimePicker();
	$('#countrydropdown').on('change', function(){
		var value = $(this).val();
		// console.log(value);
		$.ajax({
			type: 'get',
			url: "https://fun-genda.com/fetch_state",
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
    	$.ajax({
    		type: 'get',
    		url: "<?php echo e(url('/fetch_country')); ?>",
    		data: { data: value },
    		success: function(data){
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
	console.log(city_id);
	if(state_id != '') {
		$.ajax({
    		type: 'get',
    		url: "<?php echo e(url('/fetch_country')); ?>",
    		data: { data: state_id },
    		success: function(data){
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
	}

	var counter = 0;
	var count = 0;
	var countArrayIndex = $('.event-time-date').val();
	$('#add_date').on('click',function(){
		counter++;
		countArrayIndex++;
		console.log(countArrayIndex);
		$('#another_date_div').append('<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">'+
			'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 createeventsectiondiv appenddatetime set'+count+'">'+
			'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventcostdiv">'+
			'<label for="startdate">START DATE</label>'+
			'<span class="require-star"></span>'+
			'<span class="notranslate">'+
			'<input type="text" name="startdate'+countArrayIndex+'" onblur="dateValidation(datestart'+countArrayIndex+')" id="datestart'+countArrayIndex+'" class="form-control profileinput createeventinput datetimecalender" placeholder="Select Date">'+
			'</span>'+
			'<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>'+
			'<img src="<?php echo e(url('images/calenderpic.png')); ?>" class="img-responsive createcalender">'+
			'</div>'+
			'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">'+
			'<label for="starttime">START TIME</label>'+
			'<span class="require-star"></span>'+
			'<span class="notranslate"><input type="text" onblur="strttimeValidation(this)" name="starttime'+countArrayIndex+'" id="timestart" class="form-control profileinput createeventinput eventstarttime starttime" placeholder="Select Time"></span>'+
			'<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i>'+
			'<i class="fa fa-clock-o timepick" aria-hidden="true"></i>'+
			'</div>'+
			'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 createeventdiscountdiv">'+
			'<label for="endtime">END TIME</label>'+
			'<span class="require-star"></span>'+
			'<span class="notranslate">'+
			'<input type="text" name="endtime'+countArrayIndex+'" id="timeend" class="form-control profileinput createeventinput eventstarttime endtime" placeholder="Select Time" onblur="endtimeValidation(this)"></span>'+
			'<i class="fa fa-angle-down datetimedown" aria-hidden="true"></i><i class="fa fa-clock-o timepick" aria-hidden="true"></i></div></div></div>');


		dateTimePicker();
		count++;
	});

    // $('#timeend').datetimepicker();
    // $('#timestart').datetimepicker({
    //     useCurrent: false //Important! See issue #1075
    // });
    // $("#timeend").on("dp.change", function (e) {
    //     $('#timestart').data("DateTimePicker").minDate(e.date);
    // });
    // $("#timestart").on("dp.change", function (e) {
    //     $('#timeend').data("DateTimePicker").maxDate(e.date);
    // });
});
//datetime picker end


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

// $('#dateend').on('focus',function(){
// 	$('#dateenderror').html('');
// })

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

// function for date validation
function dateValidation(start, end){

	  var StartDate= $('#'+start.id).val();
	  var sDate = new Date(StartDate);
}

// funtion for time validation
function timeValidation(strtime){

}

function strttimeValidation(strtime) {
	var startTime = $(strtime).val();
	var endTime = $(strtime).parent().parent().parent().find('#timeend').val();

	if (startTime != '' && endTime != '') {

		var startDate = new Date("1/1/1900 " + startTime);
		var endDate = new Date("1/1/1900 " + endTime);

		if (startDate > endDate){
			$('.timeCheck').attr('type', 'button');
			new PNotify({
			  title: 'Error',
			  text: 'Start time must be smaller than end time',
			  type: 'error',
			  buttons: {
			      sticker: false
			  }
			});
		}
		else{
		  	$('.timeCheck').attr('type', 'submit');
		}
	}
}

function endtimeValidation(strtime) {
	var endTime = $(strtime).val();
	var startTime = $(strtime).parent().parent().parent().find('#timestart').val();

	if (startTime != '' && endTime != '') {

		var startDate = new Date("1/1/1900 " + startTime);
		var endDate = new Date("1/1/1900 " + endTime);

		if (startDate >= endDate){
			$('.timeCheck').attr('type', 'button');
			new PNotify({
			  title: 'Error',
			  text: 'End time must be greater than start time',
			  type: 'error',
			  buttons: {
			      sticker: false
			  }
			});
		}
		else{
		  	$('.timeCheck').attr('type', 'submit');
		}
	}
}

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

// 	    // This event listener will call addMarker() when the map is clicked.
// 	    map.addListener('click', function(event) {
// 		  var geocoder = new google.maps.Geocoder;
// 		  var pos = {
// 		      lat: event.latLng.lat(),
// 		      lng: event.latLng.lng()
// 		    };
// 		  geocodeLatLng(geocoder, map, pos);
// 	      marker.setPosition(event.latLng);
// 	    });

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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJHZpcyDU3JbFSCUDIEN59Apxj4EqDomI&libraries=places&callback=initMap"
         async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>