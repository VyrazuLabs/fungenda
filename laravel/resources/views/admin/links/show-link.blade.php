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
        @if(empty($data))
          <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/links/create')}}' ">Create New</button> 
        @else
          <button class="btn btn-primary" onclick="window.location.href='{{url('/admin/links/edit')}}' ">Edit New</button> 
        @endif
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
                    <th>Sites</th>
                    <th>Links</th>
                  </tr>
                </thead>
              	<tbody>
                  <tr>
                    <th><i class="fa fa-facebook-square" aria-hidden="true"></i></th>
                    <td>{{ $data['facebook'] }}</td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-twitter-square" aria-hidden="true"></i></th>
                    <td>{{ $data['twitter'] }}</td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-linkedin-square" aria-hidden="true"></i></th>
                    <td>{{ $data['linkedin'] }}</td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-google-plus-square" aria-hidden="true"></i></th>
                    <td>{{ $data['google_plus'] }}</td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-pinterest-square" aria-hidden="true"></i></th>
                    <td>{{ $data['pinterest'] }}</td>
                  </tr>
                  <tr>
                    <th><i class="fa fa-envelope" aria-hidden="true"></i></th>
                    <td>{{ $data['mail_id'] }}</td>
                  </tr>
              	</tbody>
            	<tfoot>
            	</tfoot>
              </table>
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
@endsection
{{-- href="{{ route('delete_tag',['q' => $tag['tag_id']]) --}}