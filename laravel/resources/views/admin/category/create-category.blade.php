@extends('admin.layouts.master')

@section('title', 'Create Category')

@section('add-meta')
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
@endsection

@section('add-css')
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ url('/plugins/iCheck/all.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/bower_components/select2/dist/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
  
      <section class="content">
       <div class="row">
        <!-- left column -->
          <div class="col-md-12">
            <div class="container text-center">
              <div class="col-md-8 categorycreate-box">
              <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    <form role="form">
                      <div class="box-body">
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          <label for="categoryname">Category Name</label>
                          <input type="text" class="form-control" id="catname" placeholder="Enter category name">
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          <label for="parent">Parent</label>
                          <input type="text" class="form-control" id="parentname" placeholder="Enter parent name">
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          <label>Description</label>
                          <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          <label for="status">Status</label>
                          <select class="form-control" id="status">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                         <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                      <!-- /.box-body -->

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
          <!-- /.box -->
@endsection

<!-- ./wrapper -->
@section('add-js')

@endsection

