<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use Auth;
use Session;
use Validator;

class ProfileController extends Controller
{
    //Return profile page
    public function viewProfilePage(){

    	$data['user'] = User::where('user_id',Auth::user()->user_id)->first();
    	$user_details = UserDetails::where('user_id',Auth::user()->user_id)->first();
    	
    	if(count($user_details) > 0){
    		$data['user']['file'] = $user_details['user_image'];
    		$data['user']['phone_number'] = $user_details['user_phone_number'];
    		$data['user']['address'] = $user_details['user_address'];
    	}

    	return view('frontend.pages.profile',$data);
    }

    //Save user profile
    public function saveProfile(Request $request){

    	$input = $request->input();
    	$files = $request->file();
    	$new_image = null;

    	$validation = $this->validation($input);

    	if($validation->fails()){
        Session::flash('error', "Field is missing");
    		return redirect()->back()->withErrors($validation->errors())->withInput();
    	}
    	else{

	    	if(!empty($files)){
		    	foreach ($files as $file) {
					$filename = $file->getClientOriginalName();
		            $extension = $file->getClientOriginalExtension();
		            $picture = "user_".uniqid().".".$extension;
		            $destinationPath = public_path().'/images/user/';
		            $file->move($destinationPath, $picture);

		            $new_image = $picture;
				}
			}

			$user = User::where('user_id',Auth::user()->user_id)->first();

			$user->update([
					'first_name' => $input['first_name'],
					'last_name' => $input['last_name'],
					'email' => $input['email']
				]);

			$user_details = UserDetails::where('user_id',Auth::user()->user_id)->first();

			if(empty($user_details)){

				if(empty($new_image)){

					UserDetails::create([
						'user_id' => Auth::user()->user_id,
						'user_image' => 'account_icon.png',
						'user_phone_number' => $input['phone_number'],
						'user_address' => $input['address'],
						'updated_by' => Auth::user()->user_id,
					]);

				}
				else{

					UserDetails::create([
						'user_id' => Auth::user()->user_id,
						'user_image' => $new_image,
						'user_phone_number' => $input['phone_number'],
						'user_address' => $input['address'],
						'updated_by' => Auth::user()->user_id,
					]);
				}		
			}
			else{
				if(empty($new_image)){

					$user_details->update([
							'user_id' => Auth::user()->user_id,
							'user_image' => $user_details->user_image,
							'user_phone_number' => $input['phone_number'],
							'user_address' => $input['address'],
							'updated_by' => Auth::user()->user_id,
						]);	
				}
				else{

					$user_details->update([
							'user_id' => Auth::user()->user_id,
							'user_image' => $new_image,
							'user_phone_number' => $input['phone_number'],
							'user_address' => $input['address'],
							'updated_by' => Auth::user()->user_id,
						]);
				}
			}

			Session::flash('success', "User created successfully.");
			return redirect()->back();
		}
    }

    //user form validation
    protected function validation($request){

    	return Validator::make($request,[
    			'first_name' => 'required',
    			'last_name' => 'required',
    			'email' => 'required',
    			'address' => 'required'
    		]);
    }
}
