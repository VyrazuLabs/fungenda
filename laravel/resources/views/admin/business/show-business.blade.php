@extends('admin.layouts.master')

@section('title', 'Show business')

@section('add-css')
	<link rel="stylesheet" href="{{ url('/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
	<section class="content-header">
      <h1 class="pull-left">
        All Business List<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/business/create')}}' ">Create New</button> 
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Business Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Business Image</th>
                      <th>Business Name</th>
                      <th>Category</th>
                      <th>Business Cost</th>
                      <th>Discount</th>
                      <th>Venue</th>
                      <th>City</th>
                      <th>Mail</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                	<tbody>
                	@foreach($data as $value)
                      <tr>
                        @if(!empty($value['image'][0]))
                          @if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$value->image[0]) == 1)
                            <td><img style="border-radius: 50%;" src="{{ url('/images/business/'.$value->image[0]) }}" height="40" width="40"></td>
                          @else
                            <td><img style="border-radius: 50%;" src="{{ url('/images/event/placeholder.svg') }}" height="40" width="40"></td>
                          @endif
                        @else
                          <td><img src="{{ url('/images/event/placeholder.svg') }}" height="40" width="40"></td>
                        @endif
                        <td>{{ $value['business_title'] }}</td>
                        <td>{{ $value->getCategory()->first()->name }}</td>
                        <td>{{ $value['business_cost'] }}</td>
                        @if(!empty($value->getBusinessOffer()->first()))
                          <td>{{ $value->getBusinessOffer()->first()->business_discount_rate}}</td>
                        @else{
                          <td></td>
                        @endif
                        <td>{{ $value['business_venue']}}</td>
                        <td>{{ $value->getAddress()->first()->getCity()->first()->name }}</td>
                        <td>{{ $value['business_email'] }}</td>
                        <td>
                          <a href="{{ route('edit_business_page',['q'=>$value['business_id']]) }}" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                          <a href="#" onclick="deleteFunction(this)" data-id = "{{ $value['business_id'] }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
  function deleteFunction(event) {
    var id = $(event).attr('data-id');
    // console.log(id);
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
        url: "{{ route('business_delete') }}",
        type: 'post',
        data: {data: id},
        success: function(data){
          console.log(data);
          if(data.status == 1){
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            ).then(function(){
              location.reload();
            })
          }
        }
      })
    })
  }
</script>

@endsection
