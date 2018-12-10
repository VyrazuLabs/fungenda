<?php $__env->startSection('content'); ?>
<div class="col-md-12 sharedlocationmaindiv errormain-div">
	<div class="container">
		<div class="col-md-12 business">
			<p class="text-center errorpage-text">404</p>
			<p class="text-center errorpage-sub-text">Oops! That page can't be found.</p>
			<p></p>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>