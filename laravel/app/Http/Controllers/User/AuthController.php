<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
	// validate user for registration
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'iagree' => 'required',
        ]); 
    }

	// For register user
    public function userRegistration(Request $request){
    	$input = $request->input();
    	$validation = $this->validator($input);
    	if($validation->fails()){
    		// $validation->errors();
    		return redirect()->back()->withErrors($validation->errors());
    	}
    	else{
    		if($input['password'] == $input['confirm_password']){
            User::create([
                'user_id' => uniqid(),
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
            ]);
            if (Auth::attempt(['email'=>$input['email'],'password'=>$input['password']]))
		        {
		            return redirect()->back();
		        }
	        }
	        else{
	            return redirect('/');
	        }
    	}

    }

    // validate user for login
	protected function signInValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]); 
    }
    
    // User Login function
     public function signIn(Request $request){
        $validation = $this->signInValidator($input);
    	if($validation->fails()){
    		return redirect()->back()->withErrors($validation->errors());
    	}
    	else{
		        $email= $request->input['email'];
		        $password= $request->input['password'];
		        if (Auth::attempt(['email'=>$email,'password'=>$password]))
		        {
		            return redirect()->back();
		        }
		        else{
		        	return redirect()->back()->with('msg','Credential not match');
		        }
    	}
    }
    // Logout function
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
