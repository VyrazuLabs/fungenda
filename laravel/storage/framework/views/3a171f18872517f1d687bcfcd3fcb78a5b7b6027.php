<?php $__env->startSection('title', 'Show Event'); ?>

<?php $__env->startSection('add-css'); ?>
	<link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<section class="content-header">
      <h1 class="pull-left">
        Links Table<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <?php if(empty($data)): ?>
          <button class="btn btn-primary" onclick="window.location.href='<?php echo e(url('/admin/links/create')); ?>' ">Create New</button> 
        <?php else: ?>
          <button class="btn btn-primary" onclick="window.location.href='<?php echo e(url('/admin/links/edit')); ?>' ">Edit Now</button> 
        <?php endif; ?>
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Links Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Sites</th>
                    <th>Links</th>
                  </tr>
                </thead>
              	<tbody>
                  <tr>
                    <th>
                      <i class="fa fa-facebook admin-link-social-icon social-facebook" aria-hidden="true"></i>
                      
                    <td><?php echo e($data['facebook']); ?></td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-twitter admin-link-social-icon social-twitter" aria-hidden="true"></i></th>
                    <td><?php echo e($data['twitter']); ?></td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-linkedin admin-link-social-icon social-linkedin" aria-hidden="true"></i></th>
                    <td><?php echo e($data['linkedin']); ?></td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-google-plus admin-link-social-icon social-google-plus" aria-hidden="true"></i></th>
                    <td><?php echo e($data['google_plus']); ?></td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-pinterest admin-link-social-icon social-pinterest" aria-hidden="true"></i></th>
                    <td><?php echo e($data['pinterest']); ?></td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-envelope admin-link-social-icon social-envelope" aria-hidden="true"></i></th>
                    <td><?php echo e($data['mail_id']); ?></td>
                  </tr>
              	</tbody>
            	<tfoot>
            	</tfoot>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>

<?php $__env->stopSection(); ?>

<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>
<script src="<?php echo e(url('/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(url('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.j')); ?>s"></script>
	<!-- SlimScroll -->
	<script src="<?php echo e(url('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <?php if(Session::has('status')): ?>
      <script type="text/javascript">
          swal(
                'Tag',
                "<?php echo e(Session::get('status')); ?>",
                'success'
              )
      </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>