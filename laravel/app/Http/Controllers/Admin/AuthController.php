<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(){
    	return view('admin.login');
    }
    // check login
    public function checkLogin(Request $request){
    	$input = $request->input();
    	if(Auth::attempt(['email'=>$input['useremail'],'password'=>$input['password'],'type'=>2])){
    			return view('admin.layouts.master');
    	}
    	else{
    		return redirect()->back();
    	}
    }
}
