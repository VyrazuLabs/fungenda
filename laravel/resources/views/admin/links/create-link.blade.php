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
                    @if(!empty($data))
                       <h3 class="box-title">Edit Links</h3>
                    @else
                      <h3 class="box-title">Create Links</h3>
                    @endif
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    @if(!empty($data))
                      {{ Form::model($data,['method'=>'post','url'=>'/admin/links/edit']) }}
                      {{ Form::hidden('id') }}
                    @endif
                    @if(empty($data))
                      {{ Form::open(['url'=>'/admin/links/save','method'=>'post']) }}
                    @endif
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('facebook', 'Facebook Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('facebook',null,['class'=>'form-control createcategory-input','id'=>'facebook','placeholder'=>'Enter facebook link']) }}
                          @if ($errors->has('facebook'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('twitter', 'Twitter Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('twitter',null,['class'=>'form-control createcategory-input','id'=>'twitter','placeholder'=>'Enter twitter link']) }}
                          @if ($errors->has('twitter'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('linkedin', 'Linkedin Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('linkedin',null,['class'=>'form-control createcategory-input','id'=>'linkedin','placeholder'=>'Enter linkedin link']) }}
                          @if ($errors->has('linkedin'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('googlePlus', 'Google+ Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('google_plus',null,['class'=>'form-control createcategory-input','id'=>'googlePlus','placeholder'=>'Enter google+ link']) }}
                          @if ($errors->has('google_plus'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('google_plus') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('pinterest', 'Pinterest Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('pinterest',null,['class'=>'form-control createcategory-input','id'=>'pinterest','placeholder'=>'Enter pinterest link']) }}
                          @if ($errors->has('pinterest'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('pinterest') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('mailId', 'Mail Id')}}
                          <span class="require-star"></span>
                          {{ Form::text('mail_id',null,['class'=>'form-control createcategory-input','id'=>'mailId','placeholder'=>'Enter mail id']) }}
                          @if ($errors->has('mail_id'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('mail_id') }}</strong>
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

