<?php $__env->startSection('title', 'Business List'); ?>

<?php $__env->startSection('add-css'); ?>
  <link rel="stylesheet" href="<?php echo e(url('/plugins/iCheck/all.css')); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(url('/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/select2/dist/css/select2.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/AdminLTE.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
       <div class="row">
        <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <?php if(isset($all_business)): ?>
                      <h3 class="box-title">Edit Business</h3>
                    <?php else: ?>
                      <h3 class="box-title">Create Business</h3>
                    <?php endif; ?>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    <?php if(empty($all_business)): ?>
                      <?php echo e(Form::open(['url' => '/admin/business/save', 'method' => 'post', 'files'=>'true'])); ?>

                    <?php endif; ?>
                    <?php if(!empty($all_business)): ?>
                      <?php echo e(Form::model($all_business,['method'=>'post', 'files'=>'true', 'url'=>'/admin/business/update'])); ?>

                      <?php echo e(Form::hidden('business_id',null,[])); ?>


                    <?php endif; ?>
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          <?php echo e(Form::label('businessname', 'Business Name')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::text('name',null,['id'=>'eventname','class'=>'form-control createcategory-input','placeholder'=>'Enter Name'])); ?>

                          <?php if($errors->has('name')): ?>
                                    <span id="eventnameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('name')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          <?php echo e(Form::label('category','Category')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::select('category',$all_category, null,['class'=>'form-control createcategory-input' ] )); ?>

                          <?php if($errors->has('category')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('category')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-10 form-group ">
                            <?php echo e(Form::label('business_description','ENTER BRIEF DESCRIPTION OF THE BUSINESS')); ?>

                            <?php echo e(Form::textarea('business_description', null, ['size' => '64x7','placeholder'=>'Enter Description of the business','class'=>'form-control createcategory-input','id'=>'business_description'])); ?>

                            <?php if($errors->has('business_description')): ?>
                                              <span class="help-block">
                                                  <span id="eventcommenterror" class="signup-error"><?php echo e($errors->first('business_description')); ?></span>
                                              </span>
                                          <?php endif; ?>
                        </div>

                        <div class="col-md-12 col-sm-10 col-xs-12 form-group">
                          <?php echo e(Form::label('tags','TAGS')); ?>

                          <div class="categoryselect">
                            <?php echo e(Form::select('tags[]',$all_tag, null,[ 'multiple'=>'multiple','class'=>'form-control tagdropdown add-tag createcategory-input' ])); ?>

                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup createeventadmin-div">
                            <?php echo e(Form::label('image', 'Image')); ?>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventimagediv"> 
                              <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 eventtextboxdiv">
                                <div id="businessupload" class="upload-file-container" >
                                  <span id="businessuploadfile" class="businessselectfile"></span>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 imgbrwsebtn">
                                <button type="button" class="btn btn-secondary browsebtn btnimage">Browse</button>
                                    <?php echo e(Form::file('file[]', ['multiple' => 'multiple','id'=>'files','class'=>'form-control eventbrowsefile createcategory-input eventbrowsefile'])); ?>

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
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup createeventadmin-div edit_image_parent_div">
                            <?php $__currentLoopData = $business['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="edit-image-show-div">
                             <?php if($image): ?>
                              <span>
                                <?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$image) == 1): ?>
                                  <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/business'.'/'.$image)); ?>">
                                <?php else: ?>
                                  <img class="edit_image_div" height="200" width="200" src="<?php echo e(url('/images/event/placeholder.svg')); ?>">
                                <?php endif; ?>
                                    <a href= "<?php echo e(route('admin_business_edit_image_delete',['business_id'=> $business->business_id,'img_name'=>$image])); ?>" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
                              </span>
                             <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                          </div>
                        <?php endif; ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventcost">
                            <?php echo e(Form::label('businesscost', 'Business Cost')); ?>

                            <!-- <span class="require-star"></span> -->
                            <?php echo e(Form::number('costbusiness',null,['id'=>'eventcost','class'=>'form-control createcategory-input','placeholder'=>'Enter Amount'])); ?>

                            <?php if($errors->has('costbusiness')): ?>
                                    <span id="eventcosterror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('costbusiness')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdiscount">
                            <?php echo e(Form::label('businessdiscount', 'Discounts(If Available)')); ?>

                            <?php echo e(Form::number('businessdiscount',null,['id'=>'discount','class'=>'form-control createcategory-input','placeholder'=>'Enter Discount Rate'])); ?>

                            <?php if($errors->has('businessdiscount')): ?>
                                    <span class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('businessdiscount')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('discountas', 'Discount As')); ?>

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
                          <?php if(isset($all_event['checkbox']) && $all_event['checkbox'] == '1,2'): ?>
                            <div class="form-group checkboxlist createventcheckboxlst">
                              <?php echo e(Form::checkbox('checkbox[]',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly'])); ?>

                              <span></span>
                              <?php echo e(Form::label('kidfriendly', 'Kid Friendly')); ?>

                            </div>
                            <div class="form-group checkboxlist createventcheckboxlst">
                              <?php echo e(Form::checkbox('checkbox[]',2,true,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

                              <span></span>
                              <?php echo e(Form::label('petfriendly', 'Pet Friendly')); ?>

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
                              <?php echo e(Form::label('kidfriendly', 'Kid Friendly')); ?>

                            </div>
                            <div class="form-group checkboxlist createventcheckboxlst">
                            <?php if(isset($all_business['checkbox'])): ?>
                            <?php if($all_business['checkbox'] == 2): ?>
                             <?php echo e(Form::checkbox('checkbox[]',2,true,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

                            <?php else: ?>
                            <?php echo e(Form::checkbox('checkbox[]',2,false,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

                            <?php endif; ?>
                            <?php else: ?>
                              <?php echo e(Form::checkbox('checkbox[]',2,null,['class' => 'signincheckbox','id'=>'petfriendly'])); ?>

                            <?php endif; ?>
                              <span></span>
                              <?php echo e(Form::label('petfriendly', 'Pet Friendly')); ?>

                            </div>
                          <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                          <?php echo e(Form::label('hoursofopertaion','HOURS OF OPERATION')); ?>

                          <label for="venue" class="houroperation">HOURS OF OPERATION</label>
                            <div class="form-group operationgroup">
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    <?php echo e(Form::label('venue','Mon')); ?>

                                  </div>
                                  <div class="col-md-8 daylist">
                                    <?php echo e(Form::text('monday_start',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('mon_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                      <span>to</span>
                                      <?php echo e(Form::text('monday_end',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                      <?php echo e(Form::select('mon_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    <?php echo e(Form::label('venue','Tue')); ?>

                                  </div>
                                  <div class="col-md-8 daylist">
                                    <?php echo e(Form::text('tuesday_start',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('tue_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                    <span>to</span>
                                    <?php echo e(Form::text('tuesday_end',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('tue_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    <?php echo e(Form::label('venue','Wed')); ?>

                                  </div>
                                  <div class="col-md-8 daylist">
                                    <?php echo e(Form::text('wednessday_start',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('wed_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                    <span>to</span>
                                    <?php echo e(Form::text('wednessday_end',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('wed_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    <?php echo e(Form::label('venue','Thurs')); ?>

                                  </div>
                                  <div class="col-md-8 daylist">
                                    <?php echo e(Form::text('thursday_start',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('thurs_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                    <span>to</span>
                                    <?php echo e(Form::text('thursday_end',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('thurs_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    <?php echo e(Form::label('venue','Fri')); ?>

                                  </div>
                                  <div class="col-md-8 daylist">
                                    <?php echo e(Form::text('friday_start',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('fri_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                    <span>to</span>
                                    <?php echo e(Form::text('friday_end',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('fri_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    <?php echo e(Form::label('venue','Sat')); ?>

                                  </div>
                                  <div class="col-md-8 daylist">
                                    <?php echo e(Form::text('saturday_start',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('sat_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                    <span>to</span>
                                    <?php echo e(Form::text('saturday_end',null,['class'=>'form-control operationformcontrol','id'=>''])); ?>

                                    <?php echo e(Form::select('sat_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])); ?>

                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('venue', 'Venue')); ?>

                          <!-- <span class="require-star"></span> -->
                          <?php echo e(Form::text('venue',null,['id'=>'venue','class'=>'form-control createcategory-input','placeholder'=>'Enter Venue of Your Event'])); ?>

                          <?php if($errors->has('venue')): ?>
                                    <span id="venueerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('venue')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('addline1', 'Address')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue'])); ?>

                          <?php if($errors->has('address_line_1')): ?>
                                    <span id="streetaddress1error" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('address_line_1')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div style="display: none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('addline2', 'Address Line 2')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::text('address_line_2',null,['id'=>'streetaddress2','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue'])); ?>

                          <?php if($errors->has('address_line_2')): ?>
                                    <span id="streetaddress2error" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('address_line_2')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass
                          citydiv">
                            <?php echo e(Form::label('country', 'Country')); ?>

                            <span class="require-star"></span>
                            <?php echo e(Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'form-control createcategory-input', 'placeholder'=>'--select--' ] )); ?>

                            <?php if($errors->has('country')): ?>
                                    <span id="countrydropdownerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('country')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass statediv">
                            <?php echo e(Form::label('state', 'State')); ?>

                            <span class="require-star"></span>
                            <?php if(isset($business['respected_states'])): ?>
                              <?php echo e(Form::select('state',$business['respected_states'], null,[ 'id' => 'state', 'class'=>'stateblock form-control createcategory-input', 'placeholder'=>'--select--' ] )); ?>

                            <?php else: ?>
                            <?php echo e(Form::select('state',[], null,[ 'id' => 'state','class'=>'form-control createcategory-input', 'placeholder'=>'--select--'] )); ?>

                            <?php endif; ?>
                            <?php if($errors->has('state')): ?>
                                    <span id="stateerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('state')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass
                          citydiv">
                            <?php echo e(Form::label('city', 'City')); ?>

                            <span class="require-star"></span>
                            <?php if(isset($business['respected_city'])): ?>
                              <?php echo e(Form::select('city',$business['respected_city'], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input citydropdown', 'placeholder'=>'--select--' ] )); ?>

                            <?php else: ?>
                            <?php echo e(Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input', 'placeholder'=>'--select--' ] )); ?>

                            <?php endif; ?>
                            <?php if($errors->has('city')): ?>
                                    <span id="citydropdownerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('city')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass zip-div">
                            <?php echo e(Form::label('zicode', 'Zip Code')); ?>

                            <span class="require-star"></span>
                            <?php echo e(Form::text('zipcode',null,['id'=>'zipcode','class'=>'form-control createcategory-input','placeholder'=>'Enter Zip Code'])); ?>

                            <?php if($errors->has('zipcode')): ?>
                                    <span id="zipcodeerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('zipcode')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            <?php echo e(Form::label('enddate','Lattitude')); ?>

                            <span class="require-star"></span>
                            <?php echo e(Form::text('latitude',null,['id'=>'latitude','class'=>'form-control createcategory-input','placeholder'=>'Enter Latitude','readonly'])); ?>

                            <?php if($errors->has('latitude')): ?>
                                    <span id="latitudeerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('latitude')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            <?php echo e(Form::label('longitude','Longitude')); ?>

                            <span class="require-star"></span>
                            <?php echo e(Form::text('longitude',null,['id'=>'longitude','class'=>'form-control createcategory-input','placeholder'=>'Enter Longitude','readonly'])); ?>

                            <?php if($errors->has('longitude')): ?>
                                    <span id="longitudeerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('longitude')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group profilegroup createeventgroup createeventadmin-div">
                          <div class="googlemaping eventmap">
                              <div id="map" class="googlemap eventmap"></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            <?php echo e(Form::label('contact','Contact No.')); ?>

                            <?php echo e(Form::number('contactNo',null,['class'=>'form-control createcategory-input','id'=>'contactno'])); ?>

                            <?php if($errors->has('contactNo')): ?>
                                    <span id="contactnoerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('contactNo')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            <?php echo e(Form::label('email','Email')); ?>

                            <?php echo e(Form::text('email',null,['class'=>'form-control createcategory-input','id'=>'emailid'])); ?>

                            <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <span id="emailiderror" class="signup-error"><?php echo e($errors->first('email')); ?></span>
                                    </span>
                                <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('website', 'Website Link')); ?>

                          <?php echo e(Form::text('websitelink',null,['class'=>'form-control createcategory-input','id'=>'webname','placeholder'=>'Enter website link'])); ?>

                          <?php if($errors->has('websitelink')): ?>
                                    <span id="webnameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('websitelink')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('fb', 'Fb Link')); ?>

                          <?php echo e(Form::text('fblink',null,['class'=>'form-control createcategory-input','id'=>'fbname','placeholder'=>'Enter fb link'])); ?>

                          <?php if($errors->has('fblink')): ?>
                                    <span id="fbnameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('fblink')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::label('twitter', 'Twitter Link')); ?>

                          <?php echo e(Form::text('twitterlink',null,['class'=>'form-control createcategory-input','id'=>'twittername','placeholder'=>'Enter twitter link'])); ?>

                          <?php if($errors->has('twitterlink')): ?>
                                    <span id="twitternameerror" class="help-block">
                                        <span class="signup-error"><?php echo e($errors->first('twitterlink')); ?></span>
                                    </span>
                                <?php endif; ?>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <?php echo e(Form::submit('Submit',['class'=>'btn btn-primary submit-btn'])); ?>

                        </div>
                      </div>
                  <!-- /.box-body -->
                    <?php echo e(Form::close()); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
      
    </section>
<?php $__env->stopSection(); ?>
<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">

  $(document).ready(function(){

    $('#countrydropdown').on('change', function(){
    var value = $(this).val();
    // console.log(value);
    $.ajax({
      type: 'get',
      url: "<?php echo e(url('admin/business/fetch_state')); ?>",
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
          url: "<?php echo e(url('/admin/business/fetch_country')); ?>",
          data: { data: value },
          success: function(data){
            console.log(data);
            $('#citydropdown').empty();
            $.each(data,function(index, value){
              $('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
              console.log(value);
            });
          }
        });
    });

    // $('#citydropdown').on('change',function(){
    //     var address1 = $('#streetaddress1').val();
    //     var address2 = $('#streetaddress2').val();
    //     var country = $('#countrydropdown option:selected').text();
    //     var state = $('#state option:selected').text();
    //     var city = $('#citydropdown option:selected').text();
    //     var full_address = address1+','+address2+','+country+','+state+','+city;
    //     var longitude = $('#longitude').val();
    //     var latitude = $('#latitude').val();
    //     $.ajax({
    //     url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
    //     type: "POST",
    //     success:function(res){
    //       // console.log(longitude);
    //       // console.log(latitude);
    //       var lat = res.results[0].geometry.location.lat;
    //       var long = res.results[0].geometry.location.lng;
    //       var long_diff = Math.pow((longitude - long), 2);
    //       var lat_diff = Math.pow((latitude - lat), 2);
    //       var difference = Math.sqrt(long_diff + lat_diff);
    //       if(difference > 10){
    //         new PNotify({
    //               title: 'Error',
    //               text: 'Venue and address should be within 10 km',
    //               type: 'error',
    //               buttons: {
    //                   sticker: false
    //               }
    //             });
    //             $("input[type=submit]").attr('disabled','disabled');
    //       }
    //       else{
    //         $("input[type=submit]").removeAttr('disabled');
    //       }
    //     }
    //   });
    // });

  });
//image upload start
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
  // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('businessuploadfile').innerHTML =  output.join('');
    console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  function close_btn(cross){
    $(cross).parent().remove();
  }
//image upload end

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
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>