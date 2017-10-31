<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Auth;
use Mail;
use Session;
use Crypt;
use App\Models\EmailNotificationSettings;

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
            'confirm_password' => 'min:6|same:password'
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
            // if($input['password'] == $input['confirm_password']){

                if($input['iagree'] == 0){
                    return ['status'=>3];
                }
                if($input['iagree'] == 1){
                    $user = User::create([
                        'user_id' => uniqid(),
                        'first_name' => $input['first_name'],
                        'last_name' => $input['last_name'],
                        'email' => $input['email'],
                        'password' => bcrypt($input['password']),
                    ]);

                    EmailNotificationSettings::create([
                        'user_id' => $user['user_id'],
                        'notification_enabled' => 1,
                        'notification_frequency' => 1
                    ]);

                    $email = $input['email'];
                    $first_name = $input['first_name'];

                    Mail::send('email.registration_email',['name' => 'Efungenda','first_name' => $user['first_name'],'last_name' => $user['last_name']],function($message) use($email,$first_name){
                        $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Registration Successfull');
                    });

                    if (Auth::attempt(['email'=>$input['email'],'password'=>$input['password']])) {
                        return ['status'=>1];
                    }
                }
            // }
            // else{
            //     return ['status'=>2];
            // }
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
    public function logout(Request $request)  {
        $request->session()->flush();
        return redirect('/');
    }

    /* Forget password function */
    public function forgetPassword(Request $request){
        $input = $request->input();
        if($input['email'] == ''){
            Session::flash('error', "Please enter your mail id");
                return redirect()->back();
        }
        else{
            $data = User::where('email',$input['email'])->first();

            if(!empty($data)){
                $email = $input['email'];
                $first_name = $data['first_name'];
                $uniqueid = uniqid();
                Session::put('uniqueid',$uniqueid);

                Mail::send('email.forget_password_email',['first_name'=>$first_name,'last_name'=>$data['last_name'],'name' => 'Efungenda','email' => $email,'uniqueid' => $uniqueid],function($message) use($email,$first_name){
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Forget Password');
                });
                Session::flash('success', "Mail has been sent");
                return redirect()->back();
            }
            else{
                Session::flash('error', "The mail id is not valid");
                return redirect()->back();  
            }
        }
    } 

    /* Change forget password */
    public function changeForgetPassword($id,$email){
        if(Session::get('uniqueid') == $id){
            $decripted_email = Crypt::decrypt($email);
            $data = User::where('email',$decripted_email)->first();
            if(!empty($data)){
                // Session::forget('uniqueid');
                return view('auth.forget_password',compact('decripted_email'));
            }
        }
        else{
            return view('auth.not_valid_link');
        }
    }

    /* Update  password */
    public function updateForgetPassword(Request $request){
        $input = $request->input();

        $validation = $this->forgetPasswordValidator($input);
        if($validation->fails()){
                return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $data = User::where('email',Crypt::decrypt($input['email_id']))->first();
        $data->update([
            'password' => bcrypt($input['password'])
        ]);
        Session::forget('uniqueid');
        Session::flash('success','Password has been changed');
        return redirect('/');
    } 

    /* Password change validation */ 
    protected function forgetPasswordValidator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:6',
            'confirm_password' => 'min:6|same:password'
        ]); 
    }

}
