@extends('admin.layouts.master')

@section('title', 'Edit Tag')
@section('add-meta')
@endsection

@section('add-css')
  
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
                    <h3 class="box-title">Edit Tag</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    {{ Form::open(['url'=>'/admin/tag/edit','method'=>'post']) }}
                    {!! Form::model($tag) !!}
                    	{{ Form::hidden('id',$tag['tag_id'],[]) }}
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('tag_name','Tag')}}
                          {{ Form::text('tag_name',null,['class'=>'form-control createcategory-input','id'=>'tag','placeholder'=>'Enter a tag ']) }}
                          @if ($errors->has('tag_name'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('tag_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('description','Tag Description')}}
                          {{ Form::textarea('description',null,['class'=>'form-control createcategory-input','id'=>'description','placeholder'=>'Enter description ']) }}
                          @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
                          {{Form::label('status','Status')}}
                          {{Form::select('status',[null=>'select',1=>'ACTIVE',2=>'INACTIVE'],null,['class'=>'form-control createcategory-input'])}}
                          @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong style="float: left; color: red;">{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                         {{ Form::submit('submit',['class' =>'btn btn-primary submit-btn','name'=>'submit']) }}
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

@endsection

<!-- ./wrapper -->
@section('add-js')
	@if(Session::has('status'))
	    <script type="text/javascript">
	        swal(
	              'Tag',
	              "{{ Session::get('status') }}",
	              'success'
	            )
	    </script>
	@endif
@endsection