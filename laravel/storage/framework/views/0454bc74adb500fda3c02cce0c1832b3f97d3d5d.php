<!DOCTYPE html>
<html>
  <head>
    <!-- Your Stylesheets, Scripts & Title
    ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title', 'eFungenda Admin'); ?></title>

    <?php echo $__env->make('admin.layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php echo $__env->yieldContent('add-meta'); ?>

    <!-- section for adding page specific CSS -->
    <?php echo $__env->yieldContent('add-css'); ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- header -->
      <?php echo $__env->make('admin.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- sidebar menu -->
      <?php echo $__env->make('admin.layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <?php echo $__env->yieldContent('content'); ?>
      </div>

      <!-- Footer Scripts
        ============================================= -->
      <?php echo $__env->make('admin.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?php echo e(url('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo e(url('bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(url('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo e(url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(url('bower_components/fastclick/lib/fastclick.js')); ?>"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(url('dist/js/adminlte.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('/js/pnotify.custom.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js/select2.min.js')); ?>"></script>
    <script type="text/javascript">
    /***************************
          PNOTIFY GLOBAL POPUPS
      ****************************/
      <?php if( session('success') ): ?>
          new PNotify({
              title: 'Success',
              text: '<?php echo e(session("success")); ?>',
              type: 'success',
              buttons: {
                  sticker: false
              }
          });
      <?php endif; ?>
      <?php if( session('error') ): ?>
          new PNotify({
              title: 'Error',
              text: '<?php echo e(session("error")); ?>',
              type: 'error',
              buttons: {
                  sticker: false
              }
          });
      <?php endif; ?>
    </script>
    <script type="text/javascript"> 
      $(".add-tag").select2();
    </script>
    <script type="text/javascript">
        
        function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 51.508530, lng: -0.076132},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('streetaddress1');
        var searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }

            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
          });
          map.fitBounds(bounds);
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBQKtNlfvLjsdZ6pmbFE8xjDkESuhcDgc&libraries=places&callback=initAutocomplete"
         async defer></script>
    <!-- section for adding page specific JS -->
    <?php echo $__env->yieldContent('add-js'); ?>
    
  </body>
</html>