<?php $__env->startSection('title', 'Public Shared Locations|List'); ?>

<?php $__env->startSection('add-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Event Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Location Name</th>
                  <th>Address</th>
                  <th>Description</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $shared_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($value->given_name); ?></td>
                      <td><?php echo e($value->location_name); ?></td>
                      <td><?php echo e($value['description']); ?></td>
                      <td><?php echo e($value->city_name); ?></td>
                      <td><?php echo e($value->state_name); ?></td>
                      <td><a href="#" onclick="deleteFunction(this)" data-id = "<?php echo e($value['shared_location_id']); ?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              <tfoot>
              </tfoot>
              </table>
              <?php echo e($shared_locations->links()); ?>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('add-js'); ?>

<script>
  function deleteFunction(location) {
    var id = $(location).attr('data-id');
    swal({
      title: 'Are you sure?',
      text: "Are you really want to delete!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
        url: "<?php echo e(route('location_delete')); ?>",
        type: 'post',
        data: {data: id},
        success: function(data){
        	window.location.reload(true);
        }
      })
    })
  }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>