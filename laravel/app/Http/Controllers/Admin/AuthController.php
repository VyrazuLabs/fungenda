<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Validator;
use Session;
use Mail;
use Crypt;

class AuthController extends Controller
{
    public function login(){
    	return view('admin.login');
    }
    // check login
    public function checkLogin(Request $request){
    
    	$input = $request->input();
        $validation = $this->signInValidator($input);
        if($validation->fails()){
                return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
        	if(Auth::attempt(['email'=>$input['useremail'],'password'=>$input['password'],'type'=>2])){
        			return redirect('/admin/dashboard');
        	}
        	else{
                Session::flash('error', "Credential not matched");
        		return redirect()->back();
        	}
        }
    }

    public function adminLogout(Request $request){

        $request->session()->flush();
        return redirect('/admin/login');
    }

    // validate user for login
    protected function signInValidator(array $data)
    {
        return Validator::make($data, [
            'useremail' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]); 
    }

    public function forgetPassword(){
        return view('admin.forget_password');
    }

    public function postForgetPassword(Request $request){
        $input = $request->input();
        $validation = $this->postForgetPasswordValidation($input);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
            $data = User::where('email',$input['email'])->first();

            if(!empty($data)){
                $email = $input['email'];
                $first_name = $data['first_name'];
                $uniqueid = uniqid();
                Session::put('uniqueid',$uniqueid);

                Mail::send('email.forget_password_email_admin',['first_name'=>$first_name,'last_name'=>$data['last_name'],'name' => 'Efungenda','email' => $email,'uniqueid' => $uniqueid],function($message) use($email,$first_name){
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Your password reset link');
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

    // Validation of create-business-form-field
    protected function postForgetPasswordValidation($request){
        return Validator::make($request,[
                                        'email' => 'required|email'
                                    ]); 
    }

     /* Change forget password */
    public function changeForgetPassword($id,$email){
        if(Session::get('uniqueid') == $id){
            $decripted_email = Crypt::decrypt($email);
            $data = User::where('email',$decripted_email)->first();
            if(!empty($data)){
                // Session::forget('uniqueid');
                return view('admin.reset_password',compact('decripted_email'));
            }
        }
        else{
            return view('admin.not_valid_link');
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
        return redirect('/admin/login');
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
