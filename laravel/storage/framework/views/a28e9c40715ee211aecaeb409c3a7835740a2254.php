<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
		<p class="search-nearby myfav">My Favorites:</p>
	</div>
</div>
<!--end search nearby-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myfavdiv">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 business">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 custombox">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 left-div">
					<?php echo e(Form::open(['method'=>'post', 'url'=>'/my-favourite/search'])); ?>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow favouritesearch">
						<label class="custom-control custom-radio event-btn">
							<?php if(Session::get('radio') == 2): ?>
			  					<input id="radio2" value="2" name="radio" type="radio" class="custom-control-input" checked>
			  				<?php else: ?>
			  					<input id="radio2" value="2" name="radio" type="radio" class="custom-control-input">
			  				<?php endif; ?>
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">Events</span>
						</label>
						<label class="custom-control custom-radio">
							<?php if(Session::get('radio') == 1): ?>
			  					<input id="radio1" value="1" name="radio" type="radio" class="custom-control-input" checked>
			  				<?php else: ?>
			  					<input id="radio1" value="1" name="radio" type="radio" class="custom-control-input">
			  				<?php endif; ?>
			  				<span class="custom-control-indicator"></span>
			  				<span class="custom-control-description">Businesses</span>
						</label>
						<!-- <label class="custom-control custom-radio event-btn">
							<?php if(Session::get('radio') == 4): ?>
			  					<input id="radio4" value="4" name="radio" type="radio" class="custom-control-input" checked>
			  				<?php else: ?>
			  					<input id="radio4" value="4" name="radio" type="radio" class="custom-control-input">
			  				<?php endif; ?>
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">Shared location</span>
						</label> -->
						<label class="custom-control custom-radio event-btn">
							<?php if(Session::get('radio') == 3): ?>
			  					<input id="radio2" value="3" name="radio" type="radio" class="custom-control-input" checked>
			  				<?php else: ?>
			  					<input id="radio2" value="3" name="radio" type="radio" class="custom-control-input">
			  				<?php endif; ?>
			  				<span class="custom-control-indicator"></span>
			 				<span class="custom-control-description">All</span>
						</label>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 searchboxbtn">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbox">
								<div class="searchboxfavourite">
									<select multiple="multiple" class="form-control searchboxinput search-tag" name="tags[]">
		      						</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 searchbtn">
								<button type="submit" class="btn btn-secondary top-search">Submit</button>
							</div>
						</div>
					</div>
					<?php echo e(Form::close()); ?>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftcardshadow">
						<div class="customdetail">
							<?php if(isset($all_search_business) || isset($all_search_events)): ?>
								<?php if(empty($all_search_business) && empty($all_search_events)): ?>
									<div class="eventmain businessevent">
										<center><img style="margin-top: 56px; margin-bottom: 30px;" src="<?php echo e(url('/images/error/Image_from_Skype1.png')); ?>" height="100" width="100"></center><br>
										<center><h4>Nothing Found...</h4></center>
										<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
									</div>
								<?php else: ?>
									<?php if(isset($all_search_business)): ?>
										<div class="businessmain businessevent">
											<h3 class="business-text">Businesses:</h3>
											<?php if(empty($all_search_business)): ?>
												<h3 class="text-center">Nothing to show</h3>
											<?php else: ?>
											<?php $__currentLoopData = $all_search_business; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
												<?php if(!empty($business[0]['image'][0])): ?>
													<?php if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business[0]['image'][0]) == 1): ?>

													<a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>">
														<?php if(!empty($business[0]['discount_rate'])): ?>
														<div class="ribbon-wrapper-green">
															<div class="img-discount-badge">
																Discounts
															</div>
														</div>
														<?php endif; ?>
														<img src="<?php echo e(url('images/business/'.$business[0]['image'][0])); ?>" class="img-responsive thumb-img placeholder">
													</a>

												<?php else: ?>
													<?php if(!empty($business[0]['discount_rate'])): ?>
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													<?php endif; ?>
													<img src="<?php echo e(url('images/business/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">


												<?php endif; ?>
											<?php else: ?>
												<?php if(!empty($business[0]['discount_rate'])): ?>
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												<?php endif; ?>
												<img src="<?php echo e(url('images/business/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">
											<?php endif; ?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>"><?php echo e($business[0]['business_title']); ?></a></h4>
													<?php if(count($business[0]['tags']) > 0 ): ?>
													<h5 class="colors">Listed in
													<?php 
														$counter=0;
													 ?>
													<?php $__currentLoopData = $business[0]['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php 
															$unserialize_array = unserialize($value['tags_id']);
														 ?>
														<?php $__currentLoopData = $unserialize_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php 
																$counter++;
															 ?>
															<span class="listed_in_index"><?php echo e(TagName::getTagName($tag)); ?><?php echo e($counter != count($unserialize_array) ? ',' : ''); ?></span>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</h5>
													<?php endif; ?>
													<p class="left-sub-text">
													<?php if(!empty($business[0]['business_description'])): ?>
														<?php if(mb_strlen($business[0]['business_description']) > 150): ?>
                                        					<?php  echo substr($business[0]['business_description'],0,150);  ?> ...
                                    					<?php else: ?>
                                    						<?php echo e($business[0]['business_description']); ?>

                                    					<?php endif; ?>
													<?php else: ?>
														No description
													<?php endif; ?>
													</p>
													<p class="read"><a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>">Read More</a></p>
												</div>
												<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
													<div>
													<button type="button" data-id="<?php echo e($business[0]['business_id']); ?>" class="btn favourite rvm_fav_business"><span class="favourite-btn"> Remove Favorites</span></button>
													</div>

													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count"><?php echo e($business[0]['fav_count']); ?></span> FAVORITES</span></p>
													<div class="icon">

													<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/morebusiness?q=').$business[0]['business_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

													<a href="mailto:?subject=Click the link&body=<?php echo e(url('/morebusiness?q=').$business[0]['business_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

													<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url=<?php echo e(url('/morebusiness?q=').$business[0]['business_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

											</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<?php if(isset($all_search_events)): ?>
										<div class="eventmain businessevent">
											<h3 class="business-text">Events:</h3>
											<?php if(empty($all_search_events)): ?>
												<h3 class="text-center">Nothing to show</h3>
											<?php else: ?>
											<?php $__currentLoopData = $all_search_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">

											<?php if(!empty($event[0]['image'][0])): ?>
												<?php if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event[0]['image'][0]) == 1): ?>

													<a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>">
														<?php if(!empty($event[0]['discount_rate'])): ?>
														<div class="ribbon-wrapper-green">
															<div class="img-discount-badge">
																Discounts
															</div>
														</div>
														<?php endif; ?>
														<img src="<?php echo e(url('/images/event/'.$event[0]['image'][0])); ?>" class="img-responsive thumb-img placeholder">
													</a>

												<?php else: ?>
													<?php if(!empty($event[0]['discount_rate'])): ?>
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													<?php endif; ?>
													<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">

												<?php endif; ?>
											<?php else: ?>
												<?php if(!empty($event[0]['discount_rate'])): ?>
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												<?php endif; ?>
												<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">
											<?php endif; ?>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
													<h4 class="head"><a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>"><?php echo e($event[0]['event_title']); ?></a></h4>
													<?php if( count($event[0]['tags']) > 0 ): ?>
														<h5 class="colors">Listed in
														<?php 
															$counter = 0;
														 ?>
														<?php $__currentLoopData = $event[0]['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php 
																$unserialize_array = unserialize($value['tags_id']);
															 ?>
															<?php $__currentLoopData = $unserialize_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<?php 
																	$counter++;
																 ?>
																<span class="listed_in_index"><?php echo e(TagName::getTagName($tag)); ?><?php echo e($counter != count($unserialize_array) ? ',' : ''); ?></span>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</h5>
													<?php endif; ?>
													<p class="left-sub-text">
													<?php if(!empty($event[0]['event_description'])): ?>
														<?php if(mb_strlen($event[0]['event_description']) > 150): ?>
                                        					<?php  echo substr($event[0]['event_description'],0,150);  ?> ...
                                    					<?php else: ?>
                                    						<?php echo e($event[0]['event_description']); ?>

                                    					<?php endif; ?>
													<?php else: ?>
														No description
													<?php endif; ?>
													</p>
													<p class="read"><a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>">Read More</a></p>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
													<div>
													<button type="button"  data-id="<?php echo e($event[0]['event_id']); ?>" class="btn favourite rvm_fav_event"><span class="favourite-btn"> Remove Favorites</span></button>
													</div>
													<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i><span class="fav-count"> <?php echo e($event[0]['fav_count']); ?></span> FAVORITES</span></p>
													<div class="icon">

													<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/moreevent?q=').$event[0]['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

													<a href="mailto:?subject=Click the link&body=<?php echo e(url('/moreevent?q=').$event[0]['event_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

													<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url=<?php echo e(url('/moreevent?q=').$event[0]['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

													</div>
												</div>
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

											</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							<?php else: ?>
								<?php if(count($all_businesses) > 0): ?>
									<div class="businessmain businessevent">
										<h3 class="business-text">Businesses:</h3>
										<?php $__currentLoopData = $all_businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<?php if(!empty($business[0]['image'][0])): ?>
											<?php if(file_exists(public_path().'/'.'images'.'/'.'business/'.$business[0]['image'][0]) == 1): ?>

												<a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>">
													<?php if(!empty($business[0]['discount_rate'])): ?>
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													<?php endif; ?>
													<img src="<?php echo e(url('images/business/'.$business[0]['image'][0])); ?>" class="img-responsive thumb-img placeholder">
												</a>

											<?php else: ?>
												<?php if(!empty($business[0]['discount_rate'])): ?>
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												<?php endif; ?>
												<img src="<?php echo e(url('images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">

											<?php endif; ?>
										<?php else: ?>
											<?php if(!empty($business[0]['discount_rate'])): ?>
											<div class="ribbon-wrapper-green">
												<div class="img-discount-badge">
													Discounts
												</div>
											</div>
											<?php endif; ?>
											<img src="<?php echo e(url('images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">
										<?php endif; ?>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
												<h4 class="head"><a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>"><?php echo e($business[0]['business_title']); ?></a></h4>
												<?php if(count($business[0]['tags']) > 0 ): ?>
												<?php 
													$counter = 0;
												 ?>
												<h5 class="colors">Listed in
												<?php $__currentLoopData = $business[0]['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php 
														$unserialize_array = unserialize($value['tags_id']);
													 ?>
													<?php $__currentLoopData = $unserialize_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php 
															$counter++;
														 ?>
														<span class="listed_in_index"><?php echo e(TagName::getTagName($tag)); ?><?php echo e($counter != count($unserialize_array) ? ',' : ''); ?></span>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</h5>
												<?php endif; ?>
												<p class="left-sub-text">
													<?php if(!empty($business[0]['business_description'])): ?>
														<?php if(mb_strlen($business[0]['business_description']) > 150): ?>
                                        					<?php  echo substr($business[0]['business_description'],0,150);  ?> ...
                                    					<?php else: ?>
                                    						<?php echo e($business[0]['business_description']); ?>

                                    					<?php endif; ?>
													<?php else: ?>
														No description
													<?php endif; ?>
												</p>
												<p class="read"><a href="<?php echo e(route('frontend_more_business',['q'=>$business[0]['business_id']])); ?>">Read More</a></p>
											</div>
											<div class="col-md-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
												<div>
												<button type="button" data-id="<?php echo e($business[0]['business_id']); ?>" class="btn favourite rvm_fav_business"><span class="favourite-btn"> Remove Favorites</span></button>
												</div>
												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count"><?php echo e($business[0]['fav_count']); ?></span> FAVORITES</span></p>
												<div class="icon">

												<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/morebusiness?q=').$business[0]['business_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

													<a href="mailto:?subject=Click the link&body=<?php echo e(url('/morebusiness?q=').$business[0]['business_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

													<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;business;url=<?php echo e(url('/morebusiness?q=').$business[0]['business_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

												</div>
											</div>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

										</div>
									</div>
								<?php endif; ?>
									<!--end business div-->
									<!--start event div-->
								<?php if(count($all_events) > 0): ?>
									<div class="eventmain businessevent">
										<h3 class="business-text">Events:</h3>

										<?php $__currentLoopData = $all_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<?php if(!empty($event[0]['image'][0])): ?>
											<?php if(file_exists(public_path().'/'.'images'.'/'.'event/'.$event[0]['image'][0]) == 1): ?>

												<a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>">
													<?php if(!empty($event[0]['discount_rate'])): ?>
													<div class="ribbon-wrapper-green">
														<div class="img-discount-badge">
															Discounts
														</div>
													</div>
													<?php endif; ?>
													<img src="<?php echo e(url('/images/event/'.$event[0]['image'][0])); ?>" class="img-responsive thumb-img placeholder">
												</a>

											<?php else: ?>
												<?php if(!empty($event[0]['discount_rate'])): ?>
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
												<?php endif; ?>
												<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">

											<?php endif; ?>
										<?php else: ?>
											<?php if(!empty($event[0]['discount_rate'])): ?>
											<div class="ribbon-wrapper-green">
												<div class="img-discount-badge">
													Discounts
												</div>
											</div>
											<?php endif; ?>
											<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">
										<?php endif; ?>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">
												<h4 class="head"><a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>"><?php echo e($event[0]['event_title']); ?></a></h4>
												<?php if( count($event[0]['tags']) > 0 ): ?>
													<?php 
														$counter = 0;
													 ?>
													<h5 class="colors">Listed in
													<?php $__currentLoopData = $event[0]['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php 
															$unserialize_array = unserialize($value['tags_id']);
														 ?>
														<?php $__currentLoopData = $unserialize_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php 
																$counter++;
															 ?>
															<span class="listed_in_index"><?php echo e(TagName::getTagName($tag)); ?><?php echo e($counter != count($unserialize_array) ? ',' : ''); ?></span>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</h5>
												<?php endif; ?>
												<p class="left-sub-text">
													<?php if(!empty($event[0]['event_description'])): ?>
														<?php if(mb_strlen($event[0]['event_description']) > 150): ?>
                                        					<?php  echo substr($event[0]['event_description'],0,150);  ?> ...
                                    					<?php else: ?>
                                    						<?php echo e($event[0]['event_description']); ?>

                                    					<?php endif; ?>
													<?php else: ?>
														No description
													<?php endif; ?>
												</p>
												<p class="read"><a href="<?php echo e(route('frontend_more_event',['q'=>$event[0]['event_id']])); ?>">Read More</a></p>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">
												<div>
												<button type="button"  data-id="<?php echo e($event[0]['event_id']); ?>" class="btn favourite rvm_fav_event"><span class="favourite-btn"> Remove Favorites</span></button>
												</div>
												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count"><?php echo e($event[0]['fav_count']); ?></span> FAVORITES</span></p>
												<div class="icon">

												<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/moreevent?q=').$event[0]['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

												<a href="mailto:?subject=Click the link&body=<?php echo e(url('/moreevent?q=').$event[0]['event_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

												<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url=<?php echo e(url('/moreevent?q=').$event[0]['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

												</div>
											</div>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

										</div>
									</div>
								<?php endif; ?>

								<?php if(count($all_share_location) > 0): ?>
									<div class="eventmain businessevent">
										<h3 class="business-text">Shared location:</h3>

										<?php $__currentLoopData = $all_share_location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $share_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 devide hidelist">
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divimgs">
										<?php if(!empty($share_location[0]['image'][0])): ?>
											<?php if(file_exists(public_path().'/'.'images'.'/'.'share_location/'.$share_location[0]['image'][0]) == 1): ?>

											<a href="<?php echo e(route('frontend_more_shared_location',[$share_location[0]['shared_location_id']])); ?>"><img src="<?php echo e(url('/images/share_location/'.$share_location[0]['image'][0])); ?>" class="img-responsive thumb-img placeholder"></a>
											<?php else: ?>

												<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">

											<?php endif; ?>
										<?php else: ?>
											<img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder">
										<?php endif; ?>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 textdetails">

												<h4 class="head"><a href="<?php echo e(route('frontend_more_shared_location',[$share_location[0]['shared_location_id']])); ?>"><?php echo e($share_location[0]['given_name']); ?></a></h4>

												<p class="left-sub-text">
												<?php if(!empty($share_location[0]['description'])): ?>
													<?php echo e($share_location[0]['description']); ?>

												<?php else: ?>
													No description
												<?php endif; ?>
												</p>

												<p class="read"><a href="<?php echo e(route('frontend_more_shared_location',[$share_location[0]['shared_location_id']])); ?>">Read More</a></p>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center socialicon">

												<button type="button"  data-id="<?php echo e($share_location[0]['shared_location_id']); ?>" class="btn btn favourite" id="shared_location_rvm_fav_btn"><span class="favourite-btn"> Remove Favorites</span></button>

												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <?php echo e($share_location[0]['fav_count']); ?> FAVORITES</span></p>
												<div class="icon">

												</div>
											</div>
										</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

										</div>
									</div>
								<?php endif; ?>

								<?php if(count($all_businesses) == 0 && count($all_events) == 0 && count($all_share_location) == 0): ?>
									<div class="eventmain businessevent">
										<center><img style="margin-top: 56px; margin-bottom: 30px;" src="<?php echo e(url('/images/error/Image_from_Skype1.png')); ?>" height="100" width="100"></center><br>
										<center><h4>Nothing Found...</h4></center>
										<center style="margin-bottom: 30px;">Can't find it? Feel free to add it!</center>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<!--end event div-->
				<?php echo $__env->make('frontend.layouts.theme.right-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('add-js'); ?>
<script type="text/javascript">
/*for load more*/
$(document).ready(function () {
    $('.showless-btn').hide();
    var right_length=3;

    // $('.businessmain').on('load',function()
        right_li_length = $('.businessevent').find('.devide').length;
        console.log(right_li_length);
        if (right_li_length <= 3) {
            $('.businessevent').find('.devide').show().removeClass('hidelist').addClass('showlist');
            $(this).find('.loadmore-btn').hide();
        } else {
            $('.businessevent').find('.devide:lt('+right_length+')').show().removeClass('hidelist').addClass('showlist');
        }
    // });
    $('.loadmore-btn').click(function () {
        right_size_li = $(this).parent().parent().find(".devide").length;
        right_length= $(this).parent().parent().find(".showlist").length;
        right_length= (right_length+3 <= right_size_li) ? right_length+3 : right_size_li;
        $(this).parent().parent().find('.devide:lt('+right_length+')').slideDown(
        	).removeClass('hidelist').addClass('showlist');
         $(this).parent().find('.showless-btn').slideDown('fast');
        if(right_length == right_size_li){
            $(this).slideUp('fast');
    	};
	});

    $('.showless-btn').click(function () {
        right_length=(right_length - 6 < 0) ? 3 : right_length - 3;
        console.log(right_length);
        $(this).parent().parent().find('.devide').not(':lt('+right_length+')').slideUp('fast').removeClass('showlist').addClass('hidelist');
        $(this).parent().parent().find('.loadmore-btn').slideDown('fast');
         $(this).show();
        if(right_length == 3){
            $(this).slideUp('fast');
        }
	});

});
 /*for load more*/
</script>
<script type="text/javascript">
	 $(".search-tag").select2({
	 	placeholder: "More terms like Yoga and Bicycle etc…",
	 	tags: true
	 });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>