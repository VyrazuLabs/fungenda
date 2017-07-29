@extends('admin.layouts.master')

@section('title', 'Show Event')

@section('add-css')
	<link rel="stylesheet" href="{{ url('/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
	<section class="content-header">
      <h1 class="pull-left">
        All Event List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/event/create')}}' ">Create New</button> 
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Event Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Event Name</th>
                  <th>category</th>
                  <th>Event Image</th>
                  <th>Event Cost</th>
                  <th>Discount</th>
                  <th>Discount As</th>
                  <th>Brief Description Of Discount</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Venue</th>
                  <th>Address line1</th>
                  <th>Address line2</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip Code</th>
                  <th>Lattitude</th>
                  <th>Longitude</th>
                  <th>Contact</th>
                  <th>Mail</th>
                  <th>Website Link</th>
                  <th>Fb Link</th>
                  <th>Twitter Link</th>
                  <th>Action</th>
                </tr>
                </thead>
              	<tbody>
              	@foreach($data as $value)
                    <tr>
                      <td>{{ $value['event_title'] }}</td>
                      <td>{{ $value->getCategory()->first()->name }}</td>
                      <td><img src="{{ url('/images/event/'.$value['image'][0]) }}" height="40" width="40"></td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
                      <td>{{ $value['event_start_date'] }}</td>
                      <td>{{ $value['event_end_date'] }}</td>
                      <td>na</td>
                      <td>na</td>
                      <td>{{ $value['venue'] }}</td>
                      <td>{{ $value->getAddress()->first()->address_1 }}</td>
                      <td>{{ $value->getAddress()->first()->address_2 }}</td>
                      <td>{{ $value->getAddress()->first()->getCity()->first()->name }}</td>
                      <td>{{ $value->getAddress()->first()->getState()->first()->name }}</td>
                      <td>{{ $value->getAddress()->first()->pincode }}</td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
                      <td>na</td>
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
              {{ $data->links() }}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>

@endsection

<!-- ./wrapper -->
@section('add-js')
<script src="{{ url('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.j') }}s"></script>
	<!-- SlimScroll -->
	<script src="{{ url('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script>
  function deleteFunction() {
    confirm("Do you want to delete?");
}
</script>

@endsection