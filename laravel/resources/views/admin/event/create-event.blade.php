@extends('admin.layouts.master')

@section('title', 'Create Event')

@section('add-css')
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ url('/plugins/iCheck/all.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('/css/bootstrap-datetimepicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/bower_components/select2/dist/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
 <section class="content">
       <div class="row">
        <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Create Event</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    {{ Form::open(['method' => 'post', 'files'=>'true', 'url'=>'/admin/event/save']) }}
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('eventname', 'Event Name')}}
                          <span class="require-star"></span>
                          {{ Form::text('name',null,['id'=>'eventname','class'=>'form-control createcategory-input','placeholder'=>'Enter Name']) }}
                          @if ($errors->has('name'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          {{Form::label('category','Category')}}
                          <span class="require-star"></span>
                          {{ Form::select('category',$all_category, null,['class'=>'form-control createcategory-input' ] ) }}
                          @if ($errors->has('category'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('category') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-12 form-group">
                          {{ Form::label('tags','TAGS') }}
                          <div class="categoryselect">
                            {{ Form::select('tags[]',$all_tag, null,[ 'multiple'=>'multiple','class'=>'form-control tagdropdown add-tag createcategory-input' ]) }}
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup createeventadmin-div">
                            {{Form::label('image', 'Image')}}
                            <span class="require-star"></span>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventimagediv"> 
                              <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 eventtextboxdiv">
                                <div id="uploadfile" class="upload-file-container" >
                                  <span id="uploadfile" class="businessselectfile"></span>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 imgbrwsebtn">
                                <button type="button" class="btn btn-secondary browsebtn btnimage">Browse</button>
                                    {{ Form::file('file[]', ['multiple' => 'multiple','id'=>'files','class'=>'form-control createcategory-input eventbrowsefile']) }}
                                    <output id="list"></output>
                                    @if ($errors->has('file'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('file') }}</span>
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventcost">
                            {{Form::label('evencost', 'Event Cost')}}
                            <span class="require-star"></span>
                            {{ Form::text('costevent',null,['id'=>'eventcost','class'=>'form-control createcategory-input','placeholder'=>'Enter Amount']) }}
                            @if ($errors->has('costevent'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('costevent') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdiscount">
                            {{Form::label('eventdiscount', 'Discounts(If Available)')}}
                            {{ Form::text('eventdiscount',null,['id'=>'discount','class'=>'form-control createcategory-input','placeholder'=>'Enter Discount Rate']) }}
                            @if ($errors->has('eventdiscount'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('eventdiscount') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('discountas', 'Discount As')}}
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
                            <div class="form-group checkboxlist createventcheckboxlst">
                              {{ Form::checkbox('checkbox',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                              <span></span>
                              {{Form::label('kidfriendly', 'Kid Friendly')}}
                            </div>
                            <div class="form-group checkboxlist createventcheckboxlst">
                             {{ Form::checkbox('checkbox',2,null,['class' => 'signincheckbox','id'=>'petfriendly']) }}
                              <span></span>
                              {{Form::label('petfriendly', 'Pet Friendly')}}
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('description', 'Enter Brief Description Of Discount')}}

                          {{ Form::textarea('comment', null, ['size' => '64x7','placeholder'=>'Enter Description of Discount','class'=>'form-control createcategory-input createeventtextarea']) }}
                          @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('comment') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('startdate','Event Start Date')}}
                            <span class="require-star"></span>
                            {{ Form::text('startdate',null,['id'=>'datestart','class'=>'form-control createcategory-input eventdate','placeholder'=>'Select Date']) }}
                            @if ($errors->has('startdate'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('startdate') }}</span>
                                    </span>
                                @endif
                            <i class="fa fa-calendar admineventdate" aria-hidden="true"></i>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('starttime','Event Start Time')}}
                            <span class="require-star"></span>
                            {{ Form::text('starttime',null,['id'=>'timestart','class'=>'form-control createcategory-input eventtime','placeholder'=>'Select Time']) }}
                            @if ($errors->has('starttime'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('starttime') }}</span>
                                    </span>
                                @endif
                            <i class="fa fa-clock-o admineventtimer" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('enddate','Event End Date')}}
                            <span class="require-star"></span>
                            {{ Form::text('enddate',null,['id'=>'dateend','class'=>'form-control createcategory-input eventdate','placeholder'=>'Select Date']) }}
                            @if ($errors->has('enddate'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('enddate') }}</span>
                                    </span>
                                @endif
                            <i class="fa fa-calendar admineventdate" aria-hidden="true"></i>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('endtime','Event End Time')}}
                            <span class="require-star"></span>
                            {{ Form::text('endtime',null,['id'=>'timeend','class'=>'form-control createcategory-input eventtime','placeholder'=>'Select Time']) }}
                            @if ($errors->has('endtime'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('endtime') }}</span>
                                    </span>
                                @endif
                            <i class="fa fa-clock-o admineventtimer" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('venue', 'Venue')}}
                          <span class="require-star"></span>
                          {{ Form::text('venue',null,['id'=>'venue','class'=>'form-control createcategory-input','placeholder'=>'Enter Venue of Your Event']) }}
                          @if ($errors->has('venue'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('venue') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline1', 'Address Line 1')}}
                          <span class="require-star"></span>
                          {{ Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue']) }}
                          @if ($errors->has('address_line_1'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_1') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline2', 'Address Line 2')}}
                          <span class="require-star"></span>
                          {{ Form::text('address_line_2',null,['id'=>'streetaddress2','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue']) }}
                          @if ($errors->has('address_line_2'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_2') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass
                          citydiv">
                            {{Form::label('city', 'City')}}
                            <span class="require-star"></span>
                            {{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input citydropdown' ] ) }}
                            @if ($errors->has('city'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('city') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass statediv">
                            {{Form::label('state', 'State')}}
                            <span class="require-star"></span>
                            {{ Form::select('state',$all_states, null,[ 'id' => 'state', 'class'=>'stateblock form-control createcategory-input' ] ) }}
                            @if ($errors->has('state'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('state') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass zip-div">
                            {{Form::label('zicode', 'Zip Code')}}
                            <span class="require-star"></span>
                            {{ Form::text('zipcode',null,['id'=>'zipcode','class'=>'form-control createcategory-input','placeholder'=>'Enter Zip Code']) }}
                            @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('zipcode') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('latitude','Lattitude')}}
                            <span class="require-star"></span>
                            {{Form::text('latitude',null,['id'=>'latitude','class'=>'form-control createcategory-input'])}}
                            @if ($errors->has('latitude'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('latitude') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('longitude','Longitude')}}
                            <span class="require-star"></span>
                            {{Form::text('longitude',null,['id'=>'longitude','class'=>'form-control createcategory-input'])}}
                            @if ($errors->has('longitude'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('longitude') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group profilegroup createeventgroup createeventadmin-div">
                          <div class="googlemaping eventmap">
                              <div id="map" class="googlemap eventmap"></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('contactNo','Contact No.')}}
                            <span class="require-star"></span>
                            {{Form::text('contactNo',null,['class'=>'form-control createcategory-input'])}}
                            @if ($errors->has('contactNo'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('contactNo') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('email','Email')}}
                            <span class="require-star"></span>
                            {{Form::text('email',null,['class'=>'form-control createcategory-input'])}}
                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('email') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('website', 'Website Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('websitelink',null,['class'=>'form-control createcategory-input','id'=>'webname','placeholder'=>'Enter website link']) }}
                          @if ($errors->has('websitelink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('websitelink') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('fb', 'Fb Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('fblink',null,['class'=>'form-control createcategory-input','id'=>'fbname','placeholder'=>'Enter fb link']) }}
                          @if ($errors->has('fblink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('fblink') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('twitter', 'Twitter Link')}}
                          <span class="require-star"></span>
                          {{ Form::text('twitterlink',null,['class'=>'form-control createcategory-input','id'=>'twittername','placeholder'=>'Enter twitter link']) }}
                           @if ($errors->has('twitterlink'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('twitterlink') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                         <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    {{ Form::close() }}
                  </div>
                </div>
              </div>
          </div>
      </div>
    </section>
          <!-- /.box -->
@endsection

<!-- ./wrapper -->
@section('add-js')
<script src="{{ url('/js/moment.min.js') }}"></script>
<script src="{{ url('/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
/*for google map start*/
  function myMap(latitude = 51.508742,longitude = -0.120850) {
    var myCenter = new google.maps.LatLng(latitude,longitude);
    var mapCanvas = document.getElementById("map");
    var mapOptions = {center: myCenter, zoom: 5};
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({position:myCenter});
    marker.setMap(map);
  }
  $(document).ready(function(){
      $('#state').on('change', function() {
        var value = $(this).val();
        // console.log(value);
        $.ajax({
          type: 'get',
          url: "{{ url('admin/event/fetch_country') }}",
          data: { data: value },
          success: function(data){
            console.log(data);
            $('#citydropdown').empty();
            $.each(data,function(index, value){
              $('#citydropdown').append('<option value="'+ index +'">'+value+'</option>');
              console.log(value);
            });
          }
        });
    });

    $('#citydropdown').on('change',function(){
      var city = $(this).find('option:selected').text();
      console.log(city);
      $.ajax({
        type: 'get',
        url: "{{ url('/get_longitude_latitude') }}",
        data: { data: city},
        success: function(data){
          var longitude = data.longitude;
          var latitude = data.latitude;
          $('#latitude').val(latitude);
          $('#longitude').val(longitude);
          myMap(latitude,longitude);
        }
      });
    });
  });
  /*for google map end*/
  //image upload start
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
  // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('uploadfile').innerHTML =  output.join('');
    console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  function close_btn(cross){
    $(cross).parent().remove();
  }
//image upload end
//datepicker
	$('.eventdate').datetimepicker({
	    format: 'L'
	});
	$(".eventdate").on("dp.show", function (e) {
        $(this).parent().addClass('dates');
    });
	$(".eventdate").on("dp.hide", function (e) {
        $(this).parent().removeClass('dates');
    });
  //datepicker
  //for time picker
  $('.eventtime').datetimepicker({
      format: 'LT'
  });
  $(".eventtime").on("dp.show", function (e) {
        $(this).parent().addClass('times');
    });
  $(".eventtime").on("dp.hide", function (e) {
        $(this).parent().removeClass('times');
    });
  //timepicker
</script>
<script src="{{url('https://maps.googleapis.com/maps/api/js?key=AIzaSyBlnFMM7LYrLdByQPJopWVNXq0mJRtqb38&callback=myMap')}}"></script>
@endsection
