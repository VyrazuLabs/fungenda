@extends('admin.layouts.master')

@section('title', 'Category List')

@section('add-meta')
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
@endsection

@section('add-css')
  <link rel="stylesheet" href="{{ url('/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <h1 class="pull-left">
        All Category List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/category/create-category')}}' ">Create New</button> 
      </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-custom-main">
            <div class="box-body">
              <div class="table-responsive table-responsive-custom">
                <table id="park-booking" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Parent</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $category)
                  	<tr>
                  	  <td>{{ $category['name'] }}</td>
                      <td>{{ $category['parent'] }}</td>
                      <td>{{ $category['description'] }}</td>
                      <td>{{ $category['status'] }}</td>
                      <td>
                        <a href="#" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                        <a href="#" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                  	</tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
		  </div>
    </section>
@endsection

<!-- ./wrapper -->
@section('add-js')
	<!-- DataTables -->
	<script src="{{ url('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.j') }}s"></script>
	<!-- SlimScroll -->
	<script src="{{ url('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- page script -->
	<script>
	  $(function () {
	    $('#example1').DataTable()
	    $('#example2').DataTable({
	      'paging'      : true,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    })
	  })
	</script>
@endsection

