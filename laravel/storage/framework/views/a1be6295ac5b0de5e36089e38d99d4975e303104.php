<?php $__env->startSection('title', 'Show Event'); ?>

<?php $__env->startSection('add-css'); ?>
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="content-header">
      <h1 class="pull-left">
        All Event List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo e(url('/admin/event/create')); ?>' ">Create New</button>
      </div>
    </section>
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
                  <th>Event Image</th>
                  <th>Event Name</th>
                  <th>Category</th>
                  <th>Event Cost</th>
                  <th>Discount</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Venue</th>
                  <th>City</th>
                  <th>Mail</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td>
                      <?php if(!empty($value->event_image)): ?>
                        <?php if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.explode(',',$value->event_image)[0]) == 1): ?>
                          <img style="border-radius: 50%;" src="<?php echo e(url('/images/event/'.explode(',',$value->event_image)[0])); ?>" height="40" width="40">
                        <?php else: ?>
                          <img style="border-radius: 50%;" src="<?php echo e(url('/images/event/placeholder.svg')); ?>" height="40" width="40">
                        <?php endif; ?>
                      <?php else: ?>
                        <img style="border-radius: 50%;" src="<?php echo e(url('/images/placeholder.svg')); ?>" height="40" width="40">
                      <?php endif; ?>
                      </td>
                      <td><?php echo e($value->event_title); ?></td>
                      <td><?php echo e($value->getCategory->name); ?></td>
                      <td><?php echo e($value['event_cost']); ?></td>
                      <td>
                        <?php if($value['count_event_offer'] > 0): ?>
                          <?php echo e($value->getEventOffer->discount_rate); ?>

                        <?php else: ?>

                        <?php endif; ?>
                      </td>
                      <td><?php echo e(date('Y-m-d', strtotime($value->event_start_date))); ?> / <?php echo e($value->event_start_time); ?></td>
                      <td><?php echo e(date('Y-m-d', strtotime($value->event_start_date))); ?> / <?php echo e($value->event_end_time); ?></td>
                      <td><?php echo e($value->event_venue); ?></td>
                      <td><?php echo e($value->city_name); ?></td>
                      <td><?php echo e($value->event_email); ?></td>
                      <td>
                        <a href="<?php echo e(route('edit_event_page',['q'=>$value['event_id']])); ?>" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                        <a href="#" onclick="deleteFunction(this)" data-id = "<?php echo e($value['event_id']); ?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              <tfoot>
              </tfoot>
              </table>
              <?php echo e($data->links()); ?>

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
  <script>
  function deleteFunction(event) {
    var id = $(event).attr('data-id');
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
        url: "<?php echo e(route('event_delete')); ?>",
        type: 'post',
        data: {data: id},
        success: function(data){
          if(data.status == 1){
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then(function(){
              location.reload();
            })
          }
        }
      })
    })
  }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>