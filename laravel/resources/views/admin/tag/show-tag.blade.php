@extends('admin.layouts.master')

@section('title', 'Show Event')

@section('add-css')
	<link rel="stylesheet" href="{{ url('/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
	<section class="content-header">
      <h1 class="pull-left">
        Tags Table<small>Details.</small>
      </h1>
      <div class="export-fn-container text-right">
        <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/tags/create')}}' ">Create New</button> 
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tags Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Serial no</th>
                  <th>Tag name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
              	<tbody>
                @php
                  $counter = 1;
                @endphp
                @foreach($tags as $tag)
                    <tr>
                      <td>{{ $counter }}</td>
                      <td>{{ $tag['tag_name'] }}</td>
                      <td>{{ $tag['description'] }}</td>
                      @if($tag['status'] == 1)
                      <td>Active</td>
                      @else
                      <td>Inactive</td>
                      @endif
                      <td>
                        <a href="{{ route('edit_tag_page',['q' => $tag['tag_id']]) }}" ><i class="fa fa-edit add-mrgn-right" aria-hidden="true"></i></a>
                        <a class="tag-delete" data-id="{{ $tag['tag_id'] }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                  @php
                    $counter++;
                  @endphp
                @endforeach
                    </tr>
              	</tbody>
            	<tfoot>
            	</tfoot>
              </table>
              {{ $tags->links() }}
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
    @if(Session::has('status'))
      <script type="text/javascript">
          swal(
                'Tag',
                "{{ Session::get('status') }}",
                'success'
              )
      </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tag-delete').on('click',function(){
              var id = $(this).attr('data-id');

              swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then(function(){

                      $.ajax({
                              headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                              type: 'get',
                              url: "{{ route('delete_tag') }}",
                              data: { 'q': id },
                              success: function(data){
                                console.log(data);
                                
                              }
                            });

                  }).then(function () {
                    swal(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    ).then(function(){
                      location.reload();
                    })
                  });  
            });
        });
      </script>
@endsection
{{-- href="{{ route('delete_tag',['q' => $tag['tag_id']]) --}}