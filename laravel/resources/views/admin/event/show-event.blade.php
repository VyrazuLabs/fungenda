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
                  <th>Event Image</th>  
                  <th>Category</th>
                  <th>Event Cost</th>
                  <th>Discount</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Venue</th>
                  <th>City</th>
                  <th>Mail</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr>
                      <td>{{ $value->event_title }}</td>
                      <td>
                      @if(!empty($value->event_image))
                        <img style="border-radius: 50%;" src="{{ url('/images/event/'.explode(',',$value->event_image)[0]) }}" height="40" width="40">
                      @else
                        <img style="border-radius: 50%;" src="{{ url('/images/placeholder.svg') }}" height="40" width="40">
                      @endif
                      </td>
                      <td>{{ $value->getCategory()->first()->name }}</td> 
                      <td>{{ $value['event_cost'] }}</td>
                      <td>{{ $value->getEventOffer()->first()->discount_rate }}</td>
                      <td>{{ explode(' ',$value->event_start_date)[0] }} / {{ $value->event_start_time }}</td>
                      <td>{{ explode(' ',$value->event_start_date)[0] }} / {{ $value->event_end_time }}</td>
                      <td>{{ $value->event_venue }}</td>
                      <td>{{ $value->getAddress()->first()->getCity()->first()->name }}</td>
                      <td>{{ $value->event_email }}</td>
                      <td>
                        <a href="{{ route('edit_event_page',['q'=>$value['event_id']]) }}" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
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