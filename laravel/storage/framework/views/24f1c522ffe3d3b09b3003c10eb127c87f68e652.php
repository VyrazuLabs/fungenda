<?php $__env->startSection('title', 'Show Event'); ?>

<?php $__env->startSection('add-css'); ?>
	<link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<section class="content-header">
      <h1 class="pull-left">
        Tags Table<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo e(url('/admin/tags/create')); ?>' ">Create New</button> 
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tags Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Serial no</th>
                  <th>Tag name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
              	<tbody>
                <?php 
                  $counter = 1;
                 ?>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($counter); ?></td>
                      <td><?php echo e($tag['tag_name']); ?></td>
                      <td><?php echo e($tag['description']); ?></td>
                      <?php if($tag['status'] == 1): ?>
                      <td>Active</td>
                      <?php else: ?>
                      <td>Inactive</td>
                      <?php endif; ?>
                      <td>
                        <a href="<?php echo e(route('edit_tag_page',['q' => $tag['tag_id']])); ?>" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                        <a class="tag-delete" data-id="<?php echo e($tag['tag_id']); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                  <?php 
                    $counter++;
                   ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
              	</tbody>
            	<tfoot>
            	</tfoot>
              </table>
              <?php echo e($tags->links()); ?>

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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tag-delete').on('click',function(){
              var id = $(this).attr('data-id');

              swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then(function(){

                      $.ajax({
                              headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
                              type: 'get',
                              url: "<?php echo e(route('delete_tag')); ?>",
                              data: { 'q': id },
                              success: function(data){
                                console.log(data);
                                
                              }
                            });

                  }).then(function () {
                    swal(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    ).then(function(){
                      location.reload();
                    })
                  });  
            });
        });
      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>