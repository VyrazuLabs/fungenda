<!DOCTYPE html>
<html>
  <head>
    <!-- Your Stylesheets, Scripts & Title
    ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'eFungenda Admin')</title>

    @include('admin.layouts.head')
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @yield('add-meta')

    <!-- section for adding page specific CSS -->
    @yield('add-css')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- header -->
      @include('admin.layouts.header')

      <!-- sidebar menu -->
      @include('admin.layouts.menu')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        @yield('content')
      </div>

      <!-- Footer Scripts
        ============================================= -->
      @include('admin.layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('bower_components/fastclick/lib/fastclick.js') }}"></script>
    {{-- SweetAlert --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/pnotify.custom.min.js') }}"></script>
    <script type="text/javascript">
    /***************************
          PNOTIFY GLOBAL POPUPS
      ****************************/
      @if( session('success') )
          new PNotify({
              title: 'Success',
              text: '{{ session("success") }}',
              type: 'success',
              buttons: {
                  sticker: false
              }
          });
      @endif
      @if( session('error') )
          new PNotify({
              title: 'Error',
              text: '{{ session("error") }}',
              type: 'error',
              buttons: {
                  sticker: false
              }
          });
      @endif
    </script>

    <!-- section for adding page specific JS -->
    @yield('add-js')
    
  </body>
</html>
