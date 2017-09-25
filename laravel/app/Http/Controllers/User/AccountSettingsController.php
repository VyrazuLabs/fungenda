<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\User;
use App\Models\EmailNotificationSettings;
use Validator;

class AccountSettingsController extends Controller
{	
	
	//Return view of account settings
	public function view(){

		$data['email_notification'] = EmailNotificationSettings::where('user_id',Auth::user()->user_id)->first();
		
		return view('frontend.pages.accountsetting',$data);
	}

	//Function for password update
    public function savePassword(Request $request){

    	$input = $request->input();
    	$validation = $this->validation($input);

    	if($validation->fails()){
        	Session::flash('error', "Field is missing");
    		return redirect()->back()->withErrors($validation->errors())->withInput();
    	}
    	else{
	    	if (Auth::attempt(['email'=>Auth::user()->email,'password'=>$input['oldpassword']])){
	    		if($input['newpassword'] == $input['confirmpassword']){
	    			$data = User::where('email',Auth::user()->email)->first();
	    			$data->update([
	    					'password' => bcrypt($input['newpassword']),
	    				]);

	    			Session::flash('success', "Password update successfully.");
	    			return redirect()->back();
	    		}
	    		else{
	    			Session::flash('error', "New Password and Confirm Password not matched");
	    			return redirect()->back();
	    		}
	    	}
	    	else{
	    		Session::flash('error', "Your current password is wrong");
	    			return redirect()->back();
	    	}
    	}
    }

    // Save notification settings
    public function saveNotificationSettings(Request $request){

    	$input = $request->input();

    	if(array_key_exists('notification_enabled',$input) == 1){
    		$notification_enabled = 1;
    	}
    	else{
    		$notification_enabled = 0;
    	}

    	$data = EmailNotificationSettings::where('user_id',Auth::user()->user_id)->first();

    	if(empty($data)){
	    	EmailNotificationSettings::create([
	    			'user_id' => Auth::user()->user_id,
	    			'notification_enabled' => $notification_enabled,
	    			'notification_frequency' => $input['notification_frequency']
	    		]);

	    	Session::flash('success', "Email notification settings successfully updated");
	    	return redirect()->back();
    	}
    	else{
    		$data->update([
    				'notification_enabled' => $notification_enabled,
	    			'notification_frequency' => $input['notification_frequency']
    			]);

    		Session::flash('success', "Email notification settings successfully updated");
	    	return redirect()->back();
    	}
    }

    // Validation account settings form
    protected function validation($request){

    	return Validator::make($request,[
    			'oldpassword' => 'required',
    			'newpassword' => 'required',
    			'confirmpassword' => 'required'
    		]);
    }
}
