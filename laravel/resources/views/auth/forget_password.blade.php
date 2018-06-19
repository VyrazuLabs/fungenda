@extends('frontend.layouts.main.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container text-center">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profilediv">
              <p class="profile text-left">Change Password</p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 profileimgdiv">
      <div class="profilecard">
        <div class="text-center profileform">
                {!! Form::open(['url' => '/password/changing/', 'method' => 'post', 'files'=>'true']) !!}
                {{ Form::hidden('email_id',Crypt::encrypt($decripted_email),[]) }}

              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                {{ Form::label('password','New Password') }}
                {{ Form::password('password',['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Enter new password']) }}
                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('password') }}</span>
                                    </span>
                                @endif
              </div>

              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group profilegroup createeventgroup">
                {{ Form::label('confirm_password','Confirm Password') }}
                {{ Form::password('confirm_password',['id'=>'fblink','class'=>'form-control profileinput createeventinput','placeholder'=>'Confirm your password']) }}
                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <span class="signup-error">{{ $errors->first('confirm_password') }}</span>
                                    </span>
                                @endif
              </div>

              <div class="text-center profilesavebtn">
                {{ Form::submit('Change Password',['class'=>'btn btn-secondary profilebrowsebtn saveprofile']) }}
              </div>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('add-js')
@endsection
