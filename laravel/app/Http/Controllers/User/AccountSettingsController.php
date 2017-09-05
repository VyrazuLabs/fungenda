<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\User;

class AccountSettingsController extends Controller
{
    public function savePassword(Request $request){

    	$input = $request->input();

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
