@extends('admin.layouts.master')

@section('title', 'Business List')

@section('add-css')
  <link rel="stylesheet" href="{{ url('/plugins/iCheck/all.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('/plugins/timepicker/bootstrap-timepicker.min.css') }}">
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
                    @if(isset($all_business))
                      <h3 class="box-title">Edit Business</h3>
                    @else
                      <h3 class="box-title">Create Business</h3>
                    @endif
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                    @if(empty($all_business))
                      {{ Form::open(['url' => '/admin/business/save', 'method' => 'post', 'files'=>'true']) }}
                    @endif
                    @if(!empty($all_business))
                      {{ Form::model($all_business,['method'=>'post', 'files'=>'true', 'url'=>'/admin/business/update']) }}
                      {{ Form::hidden('business_id',null,[]) }}

                    @endif
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          {{Form::label('businessname', 'Business Name')}}
                          <span class="require-star"></span>
                          {{ Form::text('name',null,['id'=>'eventname','class'=>'form-control createcategory-input','placeholder'=>'Enter Name']) }}
                          @if ($errors->has('name'))
                                    <span id="eventnameerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventimagediv"> 
                              <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 eventtextboxdiv">
                                <div id="businessupload" class="upload-file-container" >
                                  <span id="businessuploadfile" class="businessselectfile"></span>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 imgbrwsebtn">
                                <button type="button" class="btn btn-secondary browsebtn btnimage">Browse</button>
                                    {{ Form::file('file[]', ['multiple' => 'multiple','id'=>'files','class'=>'form-control eventbrowsefile createcategory-input eventbrowsefile']) }}
                                    <output id="list"></output>
                                    @if ($errors->has('file'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('file') }}</span>
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                         @if(isset($business))
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup createeventadmin-div edit_image_parent_div">
                            @foreach($business['images'] as $image)
                            <div class="edit-image-show-div">
                             @if($image)
                              <span>
                                @if(file_exists(public_path().'/'.'images'.'/'.'business'.'/'.$image) == 1)
                                  <img class="edit_image_div" height="200" width="200" src="{{ url('/images/business'.'/'.$image) }}">
                                @else
                                  <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event/placeholder.svg') }}">
                                @endif
                                    <a href= "{{ route('admin_business_edit_image_delete',['business_id'=> $business->business_id,'img_name'=>$image]) }}" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
                              </span>
                             @endif
                            </div>
                            @endforeach  
                          </div>
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventcost">
                            {{Form::label('businesscost', 'Business Cost')}}
                            <span class="require-star"></span>
                            {{ Form::text('costbusiness',null,['id'=>'eventcost','class'=>'form-control createcategory-input','placeholder'=>'Enter Amount']) }}
                            @if ($errors->has('costbusiness'))
                                    <span id="eventcosterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('costbusiness') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdiscount">
                            {{Form::label('businessdiscount', 'Discounts(If Available)')}}
                            {{ Form::text('businessdiscount',null,['id'=>'discount','class'=>'form-control createcategory-input','placeholder'=>'Enter Discount Rate']) }}
                            @if ($errors->has('businessdiscount'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('businessdiscount') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('discountas', 'Discount As')}}
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 checkboxes createventcheckboxes">
                            <div class="form-group checkboxlist createventcheckboxlst">
                              @if(isset($all_business))
                                {{ Form::checkbox('checkbox',1,null, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                              @else
                                {{ Form::checkbox('checkbox',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                              @endif
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                          {{Form::label('hoursofopertaion','HOURS OF OPERATION')}}
                          <label for="venue" class="houroperation">HOURS OF OPERATION</label>
                            <div class="form-group operationgroup">
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    {{Form::label('venue','Mon')}}
                                  </div>
                                  <div class="col-md-8 daylist">
                                    {{ Form::text('monday_start',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('mon_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                      <span>to</span>
                                      {{ Form::text('monday_end',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                      {{Form::select('mon_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    {{Form::label('venue','Tue')}}
                                  </div>
                                  <div class="col-md-8 daylist">
                                    {{ Form::text('tuesday_start',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('tue_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                    <span>to</span>
                                    {{ Form::text('tuesday_end',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('tue_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    {{Form::label('venue','Wed')}}
                                  </div>
                                  <div class="col-md-8 daylist">
                                    {{ Form::text('wednessday_start',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('wed_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                    <span>to</span>
                                    {{ Form::text('wednessday_end',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('wed_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    {{Form::label('venue','Thurs')}}
                                  </div>
                                  <div class="col-md-8 daylist">
                                    {{ Form::text('thursday_start',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('thurs_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                    <span>to</span>
                                    {{ Form::text('thursday_end',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('thurs_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    {{Form::label('venue','Fri')}}
                                  </div>
                                  <div class="col-md-8 daylist">
                                    {{ Form::text('friday_start',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('fri_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                    <span>to</span>
                                    {{ Form::text('friday_end',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('fri_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                  </div>
                                </div>
                                <div class="col-md-12 form-inline operationform">
                                  <div class="col-md-4 day">
                                    {{Form::label('venue','Sat')}}
                                  </div>
                                  <div class="col-md-8 daylist">
                                    {{ Form::text('saturday_start',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('sat_start_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                    <span>to</span>
                                    {{ Form::text('saturday_end',null,['class'=>'form-control operationformcontrol','id'=>'']) }}
                                    {{Form::select('sat_end_hour',[0=>'AM',1=>'PM'],null,['class'=>'form-control operationformcontrol'])}}
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('venue', 'Venue')}}
                          <span class="require-star"></span>
                          {{ Form::text('venue',null,['id'=>'venue','class'=>'form-control createcategory-input','placeholder'=>'Enter Venue of Your Event']) }}
                          @if ($errors->has('venue'))
                                    <span id="venueerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('venue') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline1', 'Address Line 1')}}
                          <span class="require-star"></span>
                          {{ Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue']) }}
                          @if ($errors->has('address_line_1'))
                                    <span id="streetaddress1error" class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_1') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline2', 'Address Line 2')}}
                          <span class="require-star"></span>
                          {{ Form::text('address_line_2',null,['id'=>'streetaddress2','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue']) }}
                          @if ($errors->has('address_line_2'))
                                    <span id="streetaddress2error" class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_2') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass
                          citydiv">
                            {{Form::label('country', 'Country')}}
                            <span class="require-star"></span>
                            {{ Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'form-control createcategory-input', 'placeholder'=>'--select--' ] ) }}
                            @if ($errors->has('country'))
                                    <span id="countrydropdownerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('country') }}</span>
                                    </span>
                                @endif
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass statediv">
                            {{Form::label('state', 'State')}}
                            <span class="require-star"></span>
                            @if(isset($business['respected_states']))
                              {{ Form::select('state',$business['respected_states'], null,[ 'id' => 'state', 'class'=>'stateblock form-control createcategory-input', 'placeholder'=>'--select--' ] ) }}
                            @else
                            {{ Form::select('state',[], null,[ 'id' => 'state','class'=>'form-control createcategory-input', 'placeholder'=>'--select--'] ) }}
                            @endif
                            @if ($errors->has('state'))
                                    <span id="stateerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('state') }}</span>
                                    </span>
                                @endif
                          </div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass
                          citydiv">
                            {{Form::label('city', 'City')}}
                            <span class="require-star"></span>
                            @if(isset($business['respected_city']))
                              {{ Form::select('city',$business['respected_city'], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input citydropdown', 'placeholder'=>'--select--' ] ) }}
                            @else
                            {{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input', 'placeholder'=>'--select--' ] ) }}
                            @endif
                            @if ($errors->has('city'))
                                    <span id="citydropdownerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('city') }}</span>
                                    </span>
                                @endif
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass zip-div">
                            {{Form::label('zicode', 'Zip Code')}}
                            <span class="require-star"></span>
                            {{ Form::text('zipcode',null,['id'=>'zipcode','class'=>'form-control createcategory-input','placeholder'=>'Enter Zip Code']) }}
                            @if ($errors->has('zipcode'))
                                    <span id="zipcodeerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('zipcode') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 startdate"> 
                            {{Form::label('enddate','Lattitude')}}
                            <span class="require-star"></span>
                            {{ Form::text('latitude',null,['id'=>'latitude','class'=>'form-control createcategory-input','placeholder'=>'Enter Latitude','readonly']) }}
                            @if ($errors->has('latitude'))
                                    <span id="latitudeerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('latitude') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('longitude','Longitude')}}
                            <span class="require-star"></span>
                            {{ Form::text('longitude',null,['id'=>'longitude','class'=>'form-control createcategory-input','placeholder'=>'Enter Longitude','readonly']) }}
                            @if ($errors->has('longitude'))
                                    <span id="longitudeerror" class="help-block">
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
                            {{Form::label('contact','Contact No.')}}
                            <span class="require-star"></span>
                            {{Form::text('contactNo',null,['class'=>'form-control createcategory-input','id'=>'contactno'])}}
                            @if ($errors->has('contactNo'))
                                    <span id="contactnoerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('contactNo') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate"> 
                            {{Form::label('email','Email')}}
                            <span class="require-star"></span>
                            {{Form::text('email',null,['class'=>'form-control createcategory-input','id'=>'emailid'])}}
                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <span id="emailiderror" class="signup-error">{{ $errors->first('email') }}</span>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('website', 'Website Link')}}
                          {{ Form::text('websitelink',null,['class'=>'form-control createcategory-input','id'=>'webname','placeholder'=>'Enter website link']) }}
                          @if ($errors->has('websitelink'))
                                    <span id="webnameerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('websitelink') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('fb', 'Fb Link')}}
                          {{ Form::text('fblink',null,['class'=>'form-control createcategory-input','id'=>'fbname','placeholder'=>'Enter fb link']) }}
                          @if ($errors->has('fblink'))
                                    <span id="fbnameerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('fblink') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('twitter', 'Twitter Link')}}
                          {{ Form::text('twitterlink',null,['class'=>'form-control createcategory-input','id'=>'twittername','placeholder'=>'Enter twitter link']) }}
                          @if ($errors->has('twitterlink'))
                                    <span id="twitternameerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('twitterlink') }}</span>
                                    </span>
                                @endif
                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{ Form::submit('Submit',['class'=>'btn btn-primary submit-btn']) }}
                        </div>
                      </div>
                  <!-- /.box-body -->
                    {{ Form::close() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
      {{-- </div> --}}
    </section>
@endsection
<!-- ./wrapper -->
@section('add-js')
<script type="text/javascript">

  $(document).ready(function(){

    $('#countrydropdown').on('change', function(){
    var value = $(this).val();
    // console.log(value);
    $.ajax({
      type: 'get',
      url: "{{ url('admin/business/fetch_state') }}",
      data: { data: value },
      success: function(data){
        // console.log(data);
        $('#state').empty();
        $.each(data,function(index, value){
          $('#state').append('<option value="'+ index +'">'+value+'</option>');
        });
      }
    });
  });

    $('#state').on('change', function() {
      var value = $(this).val();
        // console.log(value);
        $.ajax({
          type: 'get',
          url: "{{ url('/admin/business/fetch_country') }}",
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
        var address1 = $('#streetaddress1').val();
        var address2 = $('#streetaddress2').val();
        var country = $('#countrydropdown option:selected').text();
        var state = $('#state option:selected').text();
        var city = $('#citydropdown option:selected').text();
        var full_address = address1+','+address2+','+country+','+state+','+city;
        var longitude = $('#longitude').val();
        var latitude = $('#latitude').val();
        $.ajax({
        url:"http://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
        type: "POST",
        success:function(res){
          // console.log(longitude);
          // console.log(latitude);
          var lat = res.results[0].geometry.location.lat;
          var long = res.results[0].geometry.location.lng;
          var long_diff = Math.pow((longitude - long), 2);
          var lat_diff = Math.pow((latitude - lat), 2);
          var difference = Math.sqrt(long_diff + lat_diff);
          if(difference > 10){
            new PNotify({
                  title: 'Error',
                  text: 'Venue and address should be within 10 km',
                  type: 'error',
                  buttons: {
                      sticker: false
                  }
                });
                $("input[type=submit]").attr('disabled','disabled');
          }
          else{
            $("input[type=submit]").removeAttr('disabled');
          }
        }
      });
    });

  });
//image upload start
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
  // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<div class="allimg"><span class="crossing">'+escape(f.name)+'</span><a href="javascript:void(0)" onclick="close_btn(this)"><i class="fa fa-times cross" aria-hidden="true"></i></a></div>');
    }
    document.getElementById('businessuploadfile').innerHTML =  output.join('');
    console.log(output);
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  function close_btn(cross){
    $(cross).parent().remove();
  }
//image upload end

$('#eventname').on('keyup',function(){
  $('#eventnameerror').html('');
})

$('#eventcost').on('keyup',function(){
  $('#eventcosterror').html('');
})

$('#eventcomment').on('keyup',function(){
  $('#eventcommenterror').html('');
})

$('#datestart').on('focus',function(){
  $('#datestarterror').html('');
})

$('#timestart').on('focus',function(){
  $('#timestarterror').html('');
})

$('#dateend').on('focus',function(){
  $('#dateenderror').html('');
})

$('#timeend').on('focus',function(){
  $('#timeenderror').html('');
})

$('#venue').on('keyup',function(){
  $('#venueerror').html('');
  if($('#longitude').html != ''){
    $('#longitudeerror').html('');
  }
  if($('#latitude').html != ''){
    $('#latitudeerror').html('');
  }
})

$('#streetaddress1').on('keyup',function(){
  $('#streetaddress1error').html('');
})

$('#streetaddress2').on('keyup',function(){
  $('#streetaddress2error').html('');
})

$('#countrydropdown').on('change',function(){
  $('#countrydropdownerror').html('');
})

$('#state').on('change',function(){
  $('#stateerror').html('');
})

$('#citydropdown').on('change',function(){
  $('#citydropdownerror').html('');
})

$('#zipcode').on('keyup',function(){
  $('#zipcodeerror').html('');
})

$('#contactno').on('keyup',function(){
  $('#contactnoerror').html('');
})

$('#emailid').on('keyup',function(){
  $('#emailiderror').html('');
})

$('#webname').on('keyup',function(){
  $('#webnameerror').html('');
})

$('#fbname').on('keyup',function(){
  $('#fbnameerror').html('');
})

$('#twittername').on('keyup',function(){
  $('#twitternameerror').html('');
})
</script>
@endsection

