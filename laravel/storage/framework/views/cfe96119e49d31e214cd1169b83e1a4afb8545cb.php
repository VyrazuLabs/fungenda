<?php $__env->startSection('title', 'Create Category'); ?>

<?php $__env->startSection('add-css'); ?>
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo e(url('/plugins/iCheck/all.css')); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo e(url('/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(url('/bower_components/select2/dist/css/select2.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(url('/dist/css/AdminLTE.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php //echo "<pre>"; print_r($category_details); die(); ?>

<?php $__env->startSection('content'); ?>
      <section class="content">
       <div class="row">
        <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Update Category</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    <?php echo e(Form::open(['url'=>'/admin/category/edit','method'=>'post'])); ?>

                    <?php echo e(Form::model($category_details)); ?>

                      <div class="box-body">

                      	<?php echo e(Form::hidden('category_id',null,['value'=>$category_details['category_id'],'class'=>'form-control createcategory-input','id'=>'catname','placeholder'=>'Enter category name'])); ?>


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          <?php echo e(Form::label('categoryname', 'Category Name')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::text('category_name',null,['class'=>'form-control createcategory-input','id'=>'catname','placeholder'=>'Enter category name'])); ?>

                          <?php if($errors->has('category_name')): ?>
                                    <span class="help-block">
                                        <strong style="float: left; color: red;"><?php echo e($errors->first('category_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          <?php echo e(Form::label('parentname','Parent')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::select('parent_name',$var,null,['class'=>'form-control createcategory-input','id'=>'parentname','placeholder'=>'Enter parent name'])); ?>

                          <?php if($errors->has('parent_name')): ?>
                                    <span class="help-block">
                                        <strong style="float: left; color: red;"><?php echo e($errors->first('parent_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          <?php echo e(Form::label('description','Description')); ?>

                          <?php echo e(Form::textarea('description',null,['class'=>'form-control','rows'=>'3','placeholder'=>'Enter ...'])); ?>

                          <?php if($errors->has('description')): ?>
                                    <span class="help-block">
                                        <strong style="float: left; color: red;"><?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          <?php echo e(Form::label('status','Status')); ?>

                          <span class="require-star"></span>
                          <?php echo e(Form::select('status_dropdown',[null=>'Select',1=>'ACTIVE',2=>'INACTIVE'], null,['class'=>'form-control createcategory-input'])); ?>

                           <?php if($errors->has('status_dropdown')): ?>
                              <span class="help-block">
                                  <strong style="float: left; color: red;"><?php echo e($errors->first('status_dropdown')); ?></strong>
                              </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                         <?php echo e(Form::submit('Submit',['class' =>'btn btn-primary submit-btn','name'=>'submit'])); ?>

                        </div>
                      </div>
                      <!-- /.box-body -->
                    <?php echo e(Form::close()); ?>

                  </div>
                </div>
              </div>
          </div>
      </div>
    </section>
          <!-- /.box -->
          
<?php $__env->stopSection(); ?>

<!-- ./wrapper -->
<?php $__env->startSection('add-js'); ?>
<?php if(Session::has('msg')): ?>
    <script type="text/javascript">
     swal(
        'New Category',
        'Created successfully',
        'success'
      )
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>