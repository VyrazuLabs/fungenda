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

@section('content')
  
      <section class="content">
       <div class="row">
        <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Create Category</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    {{ Form::open(['url'=>'/admin/tags/save','method'=>'post']) }}
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('tag','Tag')}}
                          {{ Form::text('tag',null,['class'=>'form-control createcategory-input','id'=>'tag','placeholder'=>'Enter a tag ']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('description','Tag')}}
                          {{ Form::textarea('description',null,['class'=>'form-control createcategory-input','id'=>'description','placeholder'=>'Enter description ']) }}
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          {{Form::label('status','Status')}}
                          {{Form::select('status_dropdown',[null=>'select',1=>'active',2=>'inactive'],null,['class'=>'form-control createcategory-input'])}}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                         {{ Form::submit('submit',['class' =>'btn btn-primary','name'=>'submit']) }}
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
@endsection

