@extends('admin.Master.master')

@section('content')
 <!-- Content Header (Page header) -->
<section class="content-header">
<h1>
  Dashboard
  <small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
</section>
<center>
	<h1>Category</h1>
	{{ Form::open(['method'=>'post','url'=>'/admin-save-category']) }}
		<div>
			{{ Form::label('category_name','Category Name:') }}
			{{ Form::text('category_name') }}
		</div>
		<div>
			{{ Form::label('description','Category Description:') }}
			{{ Form::textarea('description',null,['rows'=>5,'cols'=>30]) }}
		</div>
		<div>
			{{ Form::label('status','Status:') }}
			{{ Form::select('status',[null => '--select--',1 => 'Active',2 => 'Inactive']) }}
		</div>
		<div>
			{{ Form::submit('Save') }}
		</div>
	{{ Form::close() }}
</center>
@endsection