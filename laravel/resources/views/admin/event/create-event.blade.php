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
                    {{ Form::open() }}
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('eventname', 'Event Name')}}
                          {{ Form::text('event_name',null,['class'=>'form-control createcategory-input','id'=>'eventname','placeholder'=>'Enter event name']) }}
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          {{Form::label('category','Category')}}
                          {{Form::select('category_dropdown',[0=>'select',1=>'active',2=>'inactive'],null,['class'=>'form-control createcategory-input'])}}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup createeventadmin-div">
                            {{Form::label('image', 'Image')}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventimagediv"> 
                              <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 eventtextboxdiv">
                                <div id="uploadfile" class="upload-file-container" >
                                  <span id="uploadfile" class="businessselectfile"></span>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 imgbrwsebtn">
                                <button type="button" class="btn btn-secondary browsebtn btnimage">Browse</button>
                                    {{Form::file('files[]',['class'=>'form-control createcategory-input eventbrowsefile','id'=>'files','multiple'=>'multiple'])}}
                                    <output id="list"></output>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventcost">
                            {{Form::label('evencost', 'Event Cost')}}
                            {{ Form::text('event_cost',null,['class'=>'form-control createcategory-input','id'=>'eventcost','placeholder'=>'Enter event cost']) }}
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdiscount">
                            {{Form::label('eventdiscount', 'Discounts(If Available)')}}
                            {{ Form::text('event_discount',null,['class'=>'form-control createcategory-input','id'=>'eventdiscount','placeholder'=>'Enter event discount']) }}
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('discountas', 'Discount As')}}
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
                            <div class="form-group checkboxlist createventcheckboxlst">
                              {{ Form::checkbox('checkbox1',null,1,['class'=>'signincheckbox','id'=>'kidfriendly']) }}
                              <span></span>
                              {{Form::label('kidfriendly', 'Kid Friendly')}}
                            </div>
                            <div class="form-group checkboxlist createventcheckboxlst">
                             {{ Form::checkbox('checkbox2',null,null,['class'=>'signincheckbox','id'=>'petfriendly']) }}
                              <span></span>
                              {{Form::label('petfriendly', 'Pet Friendly')}}
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('description', 'Enter Brief Description Of Discount')}}
                          {{ Form::textarea('comment',null,['class'=>'form-control createcategory-input createeventtextarea','id'=>'describe','placeholder'=>'Enter Description of Discount','cols' => '64','rows'=> '7']) }}
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('startdate','Event Start Date')}}
                            {{Form::text('status_dropdown',null,['class'=>'form-control createcategory-input eventdate'])}}
                            <i class="fa fa-calendar admineventdate" aria-hidden="true"></i>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('starttime','Event Start Time')}}
                            {{Form::text('status_dropdown',null,['class'=>'form-control createcategory-input eventtime'])}}
                            <i class="fa fa-clock-o admineventtimer" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('enddate','Event End Date')}}
                            {{Form::text('status_dropdown',null,['class'=>'form-control createcategory-input eventdate'])}}
                            <i class="fa fa-calendar admineventdate" aria-hidden="true"></i>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('endtime','Event End Time')}}
                            {{Form::text('status_dropdown',null,['class'=>'form-control createcategory-input eventtime'])}}
                            <i class="fa fa-clock-o admineventtimer" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('venue', 'Venue')}}
                          {{ Form::text('venue_name',null,['class'=>'form-control createcategory-input','id'=>'venuename','placeholder'=>'Enter venue for your event']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline1', 'Address Line 1')}}
                          {{ Form::text('addline1_name',null,['class'=>'form-control createcategory-input','id'=>'addline1','placeholder'=>'Enter street address for venue']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline2', 'Address Line 2')}}
                          {{ Form::text('addline2_name',null,['class'=>'form-control createcategory-input','id'=>'addline2','placeholder'=>'Enter street address for venue']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass
                          citydiv">
                            {{Form::label('city', 'City')}}
                            {{Form::select('city_dropdown',[0=>'select',1=>'active',2=>'inactive'],null,['class'=>'form-control createcategory-input'])}}
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass statediv">
                            {{Form::label('state', 'State')}}
                            {{Form::select('state_dropdown',[0=>'select',1=>'active',2=>'inactive'],null,['class'=>'form-control createcategory-input'])}}
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 accountdropddwnclass zip-div">
                            {{Form::label('zicode', 'Zip Code')}}
                            {{ Form::text('addline2_name',null,['class'=>'form-control createcategory-input','id'=>'addline2','placeholder'=>'Enter Zip Code']) }}
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('enddate','Lattitude')}}
                            {{Form::text('latitude',null,['class'=>'form-control createcategory-input'])}}
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('longitude','Longitude')}}
                            {{Form::text('longitude',null,['class'=>'form-control createcategory-input'])}}
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group profilegroup createeventgroup createeventadmin-div">
                          <div class="googlemaping eventmap">
                              <div id="map" class="googlemap eventmap"></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('contact','Contact No.')}}
                            {{Form::text('contact',null,['class'=>'form-control createcategory-input'])}}
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('email','Email')}}
                            {{Form::text('email',null,['class'=>'form-control createcategory-input'])}}
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('website', 'Website Link')}}
                          {{ Form::text('website_name',null,['class'=>'form-control createcategory-input','id'=>'webname','placeholder'=>'Enter website link']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('fb', 'Fb Link')}}
                          {{ Form::text('fb_name',null,['class'=>'form-control createcategory-input','id'=>'fbname','placeholder'=>'Enter fb link']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('twitter', 'Twitter Link')}}
                          {{ Form::text('twitter_name',null,['class'=>'form-control createcategory-input','id'=>'twittername','placeholder'=>'Enter twitter link']) }}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                         <button type="submit" class="btn btn-primary">Submit</button>
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
    myMap();
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