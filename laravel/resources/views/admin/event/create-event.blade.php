
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
                    @if(isset($all_event))
                      <h3 class="box-title">Edit Event</h3>
                    @else
                      <h3 class="box-title">Create Event</h3>
                    @endif
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <div class="text-left createform">
                  @if(empty($all_event))
                    {{ Form::open(['method' => 'post', 'files'=>'true', 'url'=>'/admin/event/save']) }}
                  @endif
                  @if(!empty($all_event))
                    {{ Form::model($all_event,['method'=>'post', 'files'=>'true', 'url'=>'/admin/event/update']) }}

                    {{ Form::hidden('event_id',null,[]) }}
                  @endif

                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('eventname', 'Event Name')}}
                          <span class="require-star"></span>
                          {{ Form::text('name',null,['id'=>'eventname','class'=>'form-control createcategory-input','placeholder'=>'Enter Name']) }}
                          @if ($errors->has('name'))
                                    <span id="eventnameerror" class="help-block">
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
                              </div>
                              @if ($errors->has('file'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('file') }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if(isset($event))
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group profilegroup createeventgroup createeventadmin-div edit_image_parent_div">
                            @foreach($event['images'] as $image)
                            <div class="edit-image-show-div">
                             @if($image)
                              <span>
                                @if(file_exists(public_path().'/'.'images'.'/'.'event'.'/'.$image) == 1)
                                  <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event'.'/'.$image) }}">
                                @else
                                  <img class="edit_image_div" height="200" width="200" src="{{ url('/images/event/placeholder.svg') }}">
                                @endif
                                  <a href= "{{ route('admin_event_edit_image_delete',['event_id'=> $event->event_id,'img_name'=>$image]) }}" class="edit-image-cross"><i class="fa fa-times cross" aria-hidden="true"></i></a>
                              </span>
                             @endif
                            </div>
                            @endforeach
                          </div>
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventcost">
                            {{Form::label('evencost', 'Event Cost')}}
                            <span class="require-star"></span>
                            {{ Form::number('costevent',null,['id'=>'eventcost','class'=>'form-control createcategory-input','placeholder'=>'Enter Amount']) }}
                            @if ($errors->has('costevent'))
                                    <span id="eventcosterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('costevent') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdiscount">
                            {{Form::label('eventdiscount', 'Discounts(If Available)')}}
                            {{ Form::number('eventdiscount',null,['id'=>'discount','class'=>'form-control createcategory-input','placeholder'=>'Enter Discount Rate']) }}
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
                          @if(isset($all_event['checkbox']) && $all_event['checkbox'] == '1,2')
                            <div class="form-group checkboxlist createventcheckboxlst">
                            {{ Form::checkbox('checkbox[]',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                            <span></span>
                              {{Form::label('kidfriendly', 'Kid Friendly')}}
                            </div>
                            <div class="form-group checkboxlist createventcheckboxlst">
                            {{ Form::checkbox('checkbox[]',2,true,['class' => 'signincheckbox','id'=>'petfriendly']) }}
                            <span></span>
                              {{Form::label('petfriendly', 'Pet Friendly')}}
                            </div>
                          @else
                            <div class="form-group checkboxlist createventcheckboxlst">
                            @if(isset($all_event['checkbox']))
                            @if($all_event['checkbox'] == 1)
                              {{ Form::checkbox('checkbox[]',1,true, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                            @else
                              {{ Form::checkbox('checkbox[]',1,false, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                            @endif
                            @else
                              {{ Form::checkbox('checkbox[]',1,null, ['class' => 'signincheckbox','id'=>'kidfriendly']) }}
                            @endif
                              <span></span>
                              {{Form::label('kidfriendly', 'Kid Friendly')}}
                            </div>
                            <div class="form-group checkboxlist createventcheckboxlst">
                            @if(isset($all_event['checkbox']))
                            @if($all_event['checkbox'] == 2)
                             {{ Form::checkbox('checkbox[]',2,true,['class' => 'signincheckbox','id'=>'petfriendly']) }}
                            @else
                              {{ Form::checkbox('checkbox[]',2,false,['class' => 'signincheckbox','id'=>'petfriendly']) }}
                            @endif
                            @else
                              {{ Form::checkbox('checkbox[]',2,null,['class' => 'signincheckbox','id'=>'petfriendly']) }}
                            @endif
                              <span></span>
                              {{Form::label('petfriendly', 'Pet Friendly')}}
                            </div>
                        @endif
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('description', 'Enter Brief Description Of Discount')}}

                          {{ Form::textarea('comment', null, ['size' => '64x7','placeholder'=>'Enter Description of Discount','class'=>'form-control createcategory-input createeventtextarea', 'id'=>'eventcomment']) }}
                          @if ($errors->has('comment'))
                                    <span id="eventcommenterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('comment') }}</span>
                                    </span>
                                @endif
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('event_description', 'Enter Brief Description Of The Event')}}

                          {{ Form::textarea('event_description', null, ['size' => '64x7','placeholder'=>'Enter Description Of The Event','class'=>'form-control createcategory-input createeventtextarea', 'id'=>'event_description']) }}
                          @if ($errors->has('event_description'))
                                    <span id="eventcommenterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('event_description') }}</span>
                                    </span>
                                @endif
                        </div>

                        <div class="col-md-12 col-sm-10 col-xs-10 form-group createeventadmin-div">
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 startdate">
                            {{Form::label('startdate','Event Start Date')}}
                            <span class="require-star"></span>
                            {{ Form::text('startdate',null,['id'=>'datestart','class'=>'form-control createcategory-input eventdate','placeholder'=>'Select Date']) }}
                            @if ($errors->has('startdate'))
                                    <span id="datestarterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('startdate') }}</span>
                                    </span>
                                @endif
                            <i class="fa fa-calendar admineventdate" aria-hidden="true"></i>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 enddate">
                            {{Form::label('starttime','Event Start Time')}}
                            <span class="require-star"></span>
                            {{ Form::text('starttime',null,['id'=>'timestart','class'=>'form-control createcategory-input eventtime','placeholder'=>'Select Time']) }}
                            @if ($errors->has('starttime'))
                                    <span id="timestarterror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('starttime') }}</span>
                                    </span>
                                @endif
                            <i class="fa fa-clock-o admineventtimer" aria-hidden="true"></i>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 enddate">
                            {{Form::label('endtime','Event End Time')}}
                            <span class="require-star"></span>
                            {{ Form::text('endtime',null,['id'=>'timeend','class'=>'form-control createcategory-input eventtime','placeholder'=>'Select Time']) }}
                            @if ($errors->has('endtime'))
                                    <span id="timeenderror" class="help-block">
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
                                    <span id="venueerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('venue') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
                          {{Form::label('addline1', 'Address')}}
                          <span class="require-star"></span>
                          {{ Form::text('address_line_1',null,['id'=>'streetaddress1','class'=>'form-control createcategory-input','placeholder'=>'Enter Street Address of Venue']) }}
                          @if ($errors->has('address_line_1'))
                                    <span id="streetaddress1error" class="help-block">
                                        <span class="signup-error">{{ $errors->first('address_line_1') }}</span>
                                    </span>
                                @endif
                        </div>
                        <div style="display: none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group createeventadmin-div">
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
                            {{ Form::select('country',$all_country, null,[ 'id' => 'countrydropdown','class'=>'form-control createcategory-input citydropdown', 'placeholder'=>'--select--' ] ) }}
                            @if ($errors->has('country'))
                                    <span id="countrydropdownerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('country') }}</span>
                                    </span>
                                @endif
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 accountdropddwnclass statediv">
                            {{Form::label('state', 'State')}}
                            <span class="require-star"></span>
                            @if(isset($event['respected_states']))
                              {{ Form::select('state',$event['respected_states'], null,[ 'id' => 'state', 'class'=>'stateblock form-control createcategory-input', 'placeholder'=>'--select--' ] ) }}
                            @else
                              {{ Form::select('state',[], null,[ 'id' => 'state', 'class'=>'stateblock form-control createcategory-input', 'placeholder'=>'--select--' ] ) }}
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
                            @if(isset($event['respected_city']))
                              {{ Form::select('city',$event['respected_city'], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input citydropdown', 'placeholder'=>'--select--' ] ) }}
                            @else
                              {{ Form::select('city',[], null,[ 'id' => 'citydropdown','class'=>'form-control createcategory-input citydropdown', 'placeholder'=>'--select--' ] ) }}
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
                            {{Form::label('latitude','Lattitude')}}
                            <span class="require-star"></span>
                            {{Form::text('latitude',null,['id'=>'latitude','class'=>'form-control createcategory-input', 'readonly'])}}
                            @if ($errors->has('latitude'))
                                    <span id="latitudeerror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('latitude') }}</span>
                                    </span>
                                @endif
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 enddate">
                            {{Form::label('longitude','Longitude')}}
                            <span class="require-star"></span>
                            {{Form::text('longitude',null,['id'=>'longitude','class'=>'form-control createcategory-input', 'readonly'])}}
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
                            {{Form::label('contactNo','Contact No.')}}
                            <span class="require-star"></span>
                            {{Form::number('contactNo',null,['class'=>'form-control createcategory-input','id'=>'contactno'])}}
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
                                    <span id="emailiderror" class="help-block">
                                        <span class="signup-error">{{ $errors->first('email') }}</span>
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
    </section>
          <!-- /.box -->
@endsection

<!-- ./wrapper -->
@section('add-js')
<script src="{{ url('/js/moment.min.js') }}"></script>
<script src="{{ url('/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function(){

    $('#countrydropdown').on('change', function(){
    var value = $(this).val();
    // console.log(value);
    $.ajax({
      type: 'get',
      url: "{{ url('admin/event/fetch_state') }}",
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

    // $('#citydropdown').on('change',function(){
    //     var address1 = $('#streetaddress1').val();
    //     var address2 = $('#streetaddress2').val();
    //     var country = $('#countrydropdown option:selected').text();
    //     var state = $('#state option:selected').text();
    //     var city = $('#citydropdown option:selected').text();
    //     var full_address = address1+','+address2+','+country+','+state+','+city;
    //     var longitude = $('#longitude').val();
    //     var latitude = $('#latitude').val();
    //     $.ajax({
    //     url:"https://maps.googleapis.com/maps/api/geocode/json?address="+full_address+"&sensor=false",
    //     type: "POST",
    //     success:function(res){
    //       // console.log(longitude);
    //       // console.log(latitude);
    //       var lat = res.results[0].geometry.location.lat;
    //       var long = res.results[0].geometry.location.lng;
    //       var long_diff = Math.pow((longitude - long), 2);
    //       var lat_diff = Math.pow((latitude - lat), 2);
    //       var difference = Math.sqrt(long_diff + lat_diff);
    //       if(difference > 10){
    //         new PNotify({
    //               title: 'Error',
    //               text: 'Venue and address should be within 10 km',
    //               type: 'error',
    //               buttons: {
    //                   sticker: false
    //               }
    //             });
    //             $("input[type=submit]").attr('disabled','disabled');
    //       }
    //       else{
    //         $("input[type=submit]").removeAttr('disabled');
    //       }
    //     }
    //   });
    // });

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
$('#dateend').on('blur',function(){
  var StartDate= $('#datestart').val();
  var EndDate= $(this).val();
  var eDate = new Date(EndDate);
  var sDate = new Date(StartDate);
  if(StartDate!= '' && StartDate!= '' && sDate> eDate){
    $("input[type=submit]").attr('disabled','disabled');
    new PNotify({
      title: 'Error',
      text: 'Please ensure that the End Date is greater than or equal to the Start Date.',
      type: 'error',
      buttons: {
          sticker: false
      }
    });
  }
  else{
    $("input[type=submit]").removeAttr('disabled');
  }
})
</script>
@endsection
