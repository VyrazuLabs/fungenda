<?php $__env->startSection('title', 'Show business'); ?>

<?php $__env->startSection('add-css'); ?>
	<link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<section class="content-header">
      <h1 class="pull-left">
        All Business List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo e(url('/admin/business/create')); ?>' ">Create New</button>
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Business Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Business Image</th>
                      <th>Business Name</th>
                      <th>Category</th>
                      <th>Business Cost</th>
                      <th>Discount</th>
                      <th>Venue</th>
                      <th>City</th>
                      <th>Mail</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                	<tbody>
                	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <?php if(!empty($value['image'][0])): ?>
                          <?php if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$value->image[0]) == 1): ?>
                            <td><img style="border-radius: 50%;" src="<?php echo e(url('/images/business/'.$value->image[0])); ?>" height="40" width="40"></td>
                          <?php else: ?>
                            <td><img style="border-radius: 50%;" src="<?php echo e(url('/images/event/placeholder.svg')); ?>" height="40" width="40"></td>
                          <?php endif; ?>
                        <?php else: ?>
                          <td><img src="<?php echo e(url('/images/event/placeholder.svg')); ?>" height="40" width="40"></td>
                        <?php endif; ?>
                        <td><?php echo e($value['business_title']); ?></td>
                        <td><?php echo e($value->getCategory()->first()->name); ?></td>
                        <td><?php echo e($value['business_cost']); ?></td>
                        <?php if(!empty($value->getBusinessOffer()->first())): ?>
                          <td><?php echo e($value->getBusinessOffer()->first()->business_discount_rate); ?></td>
                        <?php else: ?>{
                          <td></td>
                        <?php endif; ?>
                        <td><?php echo e($value['business_venue']); ?></td>
                        <td><?php echo e($value->city_name); ?></td>
                        <td><?php echo e($value['business_email']); ?></td>
                        <td>
                          <a href="<?php echo e(route('edit_business_page',['q'=>$value['business_id']])); ?>" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                          <a href="#" onclick="deleteFunction(this)" data-id = "<?php echo e($value['business_id']); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    // console.log(id);
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
        url: "<?php echo e(route('business_delete')); ?>",
        type: 'post',
        data: {data: id},
        success: function(data){
          console.log(data);
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