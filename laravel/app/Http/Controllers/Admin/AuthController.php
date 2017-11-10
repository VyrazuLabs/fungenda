<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Validator;
use Session;

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
}
