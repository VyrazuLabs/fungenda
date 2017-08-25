<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use Auth;
use Session;

class ProfileController extends Controller
{
    //Return profile page
    public function viewProfilePage(){

    	$data['user'] = User::where('user_id',Auth::user()->user_id)->first();

    	return view('frontend.pages.profile',$data);
    }

    //Save user profile
    public function saveProfile(Request $request){
    	$input = $request->input();
    	$files = $request->file();

    	foreach ($files as $file) {
			$filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = "user_".uniqid().".".$extension;
            $destinationPath = public_path().'/images/user/';
            $file->move($destinationPath, $picture);

            $new_image = $picture;
		}

		$user = User::where('user_id',Auth::user()->user_id)->first();

		$user->update([
				'first_name' => $input['first_name'],
				'last_name' => $input['last_name'],
				'email' => $input['email']
			]);

		UserDetails::create([
				'user_id' => Auth::user()->user_id,
				'user_image' => $new_image,
				'user_phone_number' => $input['phone_number'],
				'user_address' => $input['address'],
				'updated_by' => Auth::user()->user_id,
			]);

		Session::flash('success', "User created successfully.");
		return redirect()->back();
    }
}
