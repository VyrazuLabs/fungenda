<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\User;
use Validator;

class AccountSettingsController extends Controller
{	
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

    // Validation account settings form
    protected function validation($request){

    	return Validator::make($request,[
    			'oldpassword' => 'required',
    			'newpassword' => 'required',
    			'confirmpassword' => 'required'
    		]);
    }
}
