<?php $__env->startSection('title', 'Category List'); ?>

<?php $__env->startSection('add-css'); ?>
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/skins/_all-skins.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
      <h1 class="pull-left">
        All Category List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo e(url('/admin/category/create')); ?>' ">Create New</button> 
      </div>
    </section>
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Caregory Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Business title</th>
                  <th>Parent</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
              <tbody>
                
               <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <tr>
                    <td><?php echo e($category['name']); ?></td>
                    <td>
                      <?php if($category['parent'] == 0): ?>
                        Root
                      <?php else: ?>
                        <?php echo e($category->getParent->name); ?>

                      <?php endif; ?>
                    </td>
                    <td><?php echo e($category['description']); ?></td>
                    <?php if($category['category_status'] == 1): ?>
                    <td>Active</td>
                    <?php else: ?>
                    <td>InActive</td>
                    <?php endif; ?>
                    <td>
                      <a href="<?php echo e(route('edit_category_page',['q'=> $category['category_id']])); ?>" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                      <a href="#"" onclick="deleteCategory(this)" data-id="<?php echo e($category['category_id']); ?>"><i class="fa fa-trash-o category_delete" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
              </table>
              <?php echo e($data->links()); ?>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>

<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>
	<!-- DataTables -->
	<script src="<?php echo e(url('/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(url('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.j')); ?>s"></script>
	<!-- SlimScroll -->
	<script src="<?php echo e(url('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
  <script>
    function deleteCategory(id){
    var id = $(id).attr('data-id');
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
                    url: "<?php echo e(route('delete_category')); ?>",
                    data: { 'data': id },
                    success: function(data){
                      console.log(data);
                      
                    }
                  });

        }).then(function () {
          swal(
            'Deleted!',
            'Category has been deleted.',
            'success'
          ).then(function(){
            location.reload();
          })
        });
    };
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>