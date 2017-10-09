<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Auth;
use Mail;

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
            $errors = $validation->errors();
            return $errors;
        }
        else{
            if($input['password'] == $input['confirm_password']){

                if($input['iagree'] == 0){
                    return ['status'=>3];
                }
                if($input['iagree'] == 1){
                    User::create([
                        'user_id' => uniqid(),
                        'first_name' => $input['first_name'],
                        'last_name' => $input['last_name'],
                        'email' => $input['email'],
                        'password' => bcrypt($input['password']),
                    ]);

                    $email = $input['email'];
                    $first_name = $input['first_name'];

                    Mail::send('email.registration_email',['name' => 'Efungenda'],function($message) use($email,$first_name){
                        $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Registration Successfull');
                    });

                    if (Auth::attempt(['email'=>$input['email'],'password'=>$input['password']])) {
                        return ['status'=>1];
                    }
                }
            }
            else{
                return ['status'=>2];
            }
        }

    }

    // validate user for login
	protected function signInValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]); 
    }
    
    // User Login function
     public function signIn(Request $request){
        $input = $request->input();
        $validation = $this->signInValidator($input);
    	if($validation->fails()){
                $errors = $validation->errors();
                return $errors;
    	}
    	else{
		        $email= $input['email'];
		        $password= $input['password'];
		        if (Auth::attempt(['email'=>$email,'password'=>$password,'type'=>1]))
		        {
		            return ['status'=>1];
		        }
		        else{
		        	return ['status'=>2];
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
