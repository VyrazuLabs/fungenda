<?php echo $__env->make('frontend.layouts.theme.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->yieldContent('content'); ?>	
<?php echo $__env->make('frontend.layouts.theme.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>