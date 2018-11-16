@extends('admin.layouts.master')

@section('title', 'Public Shared Locations|List')

@section('add-css')

@endsection

@section('content')

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
                  <th>Location Name</th>
                  <th>Address</th>
                  <th>Description</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shared_locations as $value)
                    <tr>
                      <td>{{ $value->given_name }}</td>
                      <td>{{ $value->location_name }}</td>
                      <td>{{ $value['description'] }}</td>
                      <td>{{ $value->city_name }}</td>
                      <td>{{ $value->state_name }}</td>
                      <td><a href="#" onclick="deleteFunction(this)" data-id = "{{ $value['shared_location_id'] }}" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
              <tfoot>
              </tfoot>
              </table>
              {{ $shared_locations->links() }}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>

@endsection


@section('add-js')

<script>
  function deleteFunction(location) {
    var id = $(location).attr('data-id');
    swal({
      title: 'Are you sure?',
      text: "Are you really want to delete!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
      $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        url: "{{ route('location_delete') }}",
        type: 'post',
        data: {data: id},
        success: function(data){
        	window.location.reload(true);
        }
      })
    })
  }
</script>

@endsection
