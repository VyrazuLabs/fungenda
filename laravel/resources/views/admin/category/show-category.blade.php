@extends('admin.layouts.master')

@section('title', 'Category List')

@section('add-css')
  <link rel="stylesheet" href="{{ url('/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <h1 class="pull-left">
        All Category List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/category/create')}}' ">Create New</button> 
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
                
               @foreach($data as $category)
                    <tr>
                      <td>{{ $category['name'] }}</td>
                      <td>{{ $category['parent'] }}</td>
                      <td>{{ $category['description'] }}</td>
                      @if($category['category_status'] == 1)
                      <td>Active</td>
                      @else
                      <td>InActive</td>
                      @endif
                      <td>
                        <a href="{{ route('edit_category_page') }}" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                        <a href="#" onclick="deleteFunction()" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
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
  <script>
  function deleteFunction() {
    confirm("Do you want to delete?");
}
</script>

@endsection

