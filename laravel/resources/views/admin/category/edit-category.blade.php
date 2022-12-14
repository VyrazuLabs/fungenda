@extends('admin.layouts.master')

@section('title', 'Create Category')

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

<?php //echo "<pre>"; print_r($category_details); die(); ?>

@section('content')
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
                    {{ Form::open(['url'=>'/admin/category/edit','method'=>'post']) }}
                    {{ Form::model($category_details) }}
                      <div class="box-body">

                      	{{ Form::hidden('category_id',null,['value'=>$category_details['category_id'],'class'=>'form-control createcategory-input','id'=>'catname','placeholder'=>'Enter category name']) }}

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('categoryname', 'Category Name')}}
                          <span class="require-star"></span>
                          {{ Form::text('category_name',null,['class'=>'form-control createcategory-input','id'=>'catname','placeholder'=>'Enter category name']) }}
                          @if ($errors->has('category_name'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('category_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('parentname','Parent')}}
                          <span class="require-star"></span>
                          {{ Form::select('parent_name',$var,null,['class'=>'form-control createcategory-input','id'=>'parentname','placeholder'=>'Enter parent name']) }}
                          @if ($errors->has('parent_name'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('parent_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('description','Description')}}
                          {{Form::textarea('description',null,['class'=>'form-control','rows'=>'3','placeholder'=>'Enter ...'])}}
                          @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          {{Form::label('status','Status')}}
                          <span class="require-star"></span>
                          {{Form::select('status_dropdown',[null=>'Select',1=>'ACTIVE',2=>'INACTIVE'], null,['class'=>'form-control createcategory-input'])}}
                           @if ($errors->has('status_dropdown'))
                              <span class="help-block">
                                  <strong style="float: left; color: red;">{{ $errors->first('status_dropdown') }}</strong>
                              </span>
                            @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                         {{ Form::submit('Submit',['class' =>'btn btn-primary submit-btn','name'=>'submit']) }}
                        </div>
                      </div>
                      <!-- /.box-body -->
                    {{ Form::close() }}
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
@if(Session::has('msg'))
    <script type="text/javascript">
     swal(
        'New Category',
        'Created successfully',
        'success'
      )
    </script>
@endif
@endsection

