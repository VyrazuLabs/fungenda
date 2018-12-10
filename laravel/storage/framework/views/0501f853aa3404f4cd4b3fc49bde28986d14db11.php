<?php $__env->startSection('content'); ?>
<!--start business div-->
<div class="col-md-12 maindiv">
	<div class="container">
		<div class="col-md-12 business">
			<div class="col-md-12 custombox">
				<div class="col-md-9 left-div">
					<div class="col-md-12 leftcardshadow">
						<div class="customdetail">
							<!--start event div-->
							<div class="eventmain businessevent">
								<h3 class="business-text">Events:</h3>
								<?php $__currentLoopData = $total_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($event['show_event_status'] == 1): ?>
										<div class="col-md-12 devide">
											<div class="col-md-3 divimgs">
											<?php if(!empty($event['discount_rate'])): ?>
												<div class="ribbon-wrapper-green">
													<div class="img-discount-badge">
														Discounts
													</div>
												</div>
											<?php endif; ?>
											<?php if(!empty($event['event_main_image'])): ?>
												<?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$event['event_main_image']) == 1): ?>

													<a href="<?php echo e(route('frontend_more_event',['q'=>$event['event_id']])); ?>"><img src="<?php echo e(url('/images/event/'.$event['event_main_image'])); ?>" class="img-responsive thumb-img placeholder"></a>

												<?php else: ?>

													<a href="<?php echo e(route('frontend_more_event',['q'=>$event['event_id']])); ?>"><img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder"></a>

												<?php endif; ?>
											<?php else: ?>
												<a href="<?php echo e(route('frontend_more_event',['q'=>$event['event_id']])); ?>"><img src="<?php echo e(url('/images/placeholder.svg')); ?>" class="img-responsive thumb-img placeholder"></a>
											<?php endif; ?>
											</div>
											<div class="col-md-6 textdetails">
												<h4 class="head"><a href="<?php echo e(route('frontend_more_event',['q'=>$event['event_id']])); ?>"><?php echo e($event['event_title']); ?></a></h4>
											<?php 
												$counter = 0;
											 ?>
											<?php if( count($event['tags']) > 0 ): ?>
												<h5 class="colors">Listed in
												<?php $__currentLoopData = $event['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
													<?php if(!empty($event['event_description'])): ?>
														<?php if(mb_strlen($event['event_description']) > 150): ?>
			                            					<?php  echo substr($event['event_description'],0,150);  ?> ...
			                        					<?php else: ?>
			                        						<?php echo e($event['event_description']); ?>

			                        					<?php endif; ?>
													<?php else: ?>
														No description
													<?php endif; ?>

												</p>
												<p class="read">
													<a href="<?php echo e(route('frontend_more_event',['q'=>$event['event_id']])); ?>">Read More</a>
													
													<?php if(Auth::check() && Auth::user()->user_id == $event->created_by): ?>
														<a href="<?php echo e(route('edit_event',['q'=> $event['event_id']])); ?>">| Edit</a>
													<?php endif; ?>
												</p>

											</div>
											<div class="col-md-3 text-center socialicon">

											<div class="fav-btn-container">
											<?php if(!Favourite::check($event['event_id'], 2)): ?>
												<button type="button" data-id="<?php echo e($event['event_id']); ?>" class="btn favourite add_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Add To Favorites</span></i></button>
											<?php else: ?>

												<button type="button"  data-id="<?php echo e($event['event_id']); ?>" class="btn favourite rvm_fav_event"><i class="fa fa-heart" aria-hidden="true"><span class="favourite-btn"> Remove Favorites</span></i></button>
											<?php endif; ?>
											</div>

												<p class="text-center text-1"><span><i class="fa fa-heart heart-icon" aria-hidden="true"></i> <span class="fav-count"><?php echo e($event['fav_count']); ?></span> <?php echo e($event['fav_count']>1 ? 'FAVORITES' : 'FAVORITE'); ?></span></p>
												<div class="icon">

												<a href="javascript:void(0);" class="btn btn-social-icon btn-facebook facebook" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://www.facebook.com/sharer.php?u=<?php echo e(url('/moreevent?q=').$event['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn fbH" target="_blank" id="fbbtm"><i class="fa fa-facebook"></i></a>

												<a href="mailto:?subject=Click the link&body=<?php echo e(url('/moreevent?q=').$event['event_id']); ?>" class="btn btn-social-icon btn-envelope email"><span class="fa fa-envelope"></span></a>

												<a class="btn btn-social-icon btn-twitter twitter" href="javascript:void(0);" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open('http://twitter.com/share?text=Share&nbsp;event;url=<?php echo e(url('/moreevent?q=').$event['event_id']); ?>','sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" class="hamBtn twH" id="twttop"><i class="fa fa-twitter"></i></a>

												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<!-- <div class="col-md-12 text-center">
									<button type="button" class="btn view">View All</button>
								</div> -->
								<div class="col-lg-12 col-md-12 col-xs-12 text-center">
								<?php echo $total_events->setPath(route('frontend_view_events'))->render(); ?>
								</div>
							</div>
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

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>