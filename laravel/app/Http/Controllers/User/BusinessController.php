<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use App\Models\Business;
use App\Models\BusinessOffer;
use App\Models\Address;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use GetLatitudeLongitude;

class BusinessController extends Controller
{	
	// View Create Business page
    public function viewCreateBusiness(){
    	$state_model = new State();
    	$data['all_states'] = $state_model->where('country_id',101)->pluck('name','id');
    	return view('frontend.pages.createbusiness',$data);
    }
    // Save Business
    public function saveBusiness(Request $request){
    	$input = $request->input();
    	$all_files = $request->file();
    	$validation = $this->businessValidation($input);
    	if($validation->fails()){
    		return redirect()->back()->withErrors($validation->errors());
    	}
    	else{
    		$city_model = new City();
	    	$state_model = new State();

	    	foreach($all_files as $files){
    			foreach ($files as $file) {
    				$filename = $file->getClientOriginalName();
	                $extension = $file->getClientOriginalExtension();
	                $picture = "business_".uniqid().".".$extension;
	                $destinationPath = public_path().'/images/business/';
	                $file->move($destinationPath, $picture);

	                //STORE NEW IMAGES IN THE ARRAY VARAIBLE
	                $new_images[] = $picture;
    			}
            }

	    	$address = Address::create([
	    					  'address_id' => uniqid(),
	                          'user_id' =>Auth::user()->user_id,
	                          'city_id' => $input['city'],
	                          'state_id' => $input['state'],
	                          'address_1' => $input['address_line_1'],
	                          'address_2' => $input['address_line_2'],
	                          'pincode' => $input['zipcode'],
	                        ]);

	    	$images_string = implode(',',$new_images);
	    	$business_model = new Business();
	    	$business_offer_model = new BusinessOffer();

	    	$business = Business::create([
	                      'business_id' =>uniqid(),
	                      'location' => $address['address_id'],
	                      'venue' => $input['venue'],
	                      'category_id' => $input['category'],
	                      'business_image' => $images_string,
	                    ]);


	    	BusinessOffer::create([
	    				  'business_offer_id' => uniqid(),
	                      'business_id' => $business['business_id'],
	                    	  ]);

	    	return redirect()->back();
	    }
    }

     // Fetch country according to state
    public function fetchCountry(Request $request){
    	$input = $request->input();
    	$all_cities = City::where('state_id',$input['data'])->pluck('name','id');
    	return $all_cities;
    }
    // Getting longitude latitude of specific address
    public function getLongitudeLatitude(Request $request){
    	$input = $request->input();
    	 $city = $input['data'];
    	 $latLong = GetLatitudeLongitude::getLatLong($city);
    	 return $latLong;
    }
    // Validation of create-business-form-field
    protected function businessValidation($request){
    	return Validator::make($request,[
                                      	'name' => 'required',
                                      	'category' => 'required',
                                      	'costbusiness' => 'required',
									    'venue' => 'required',
									    'address_line_1' => 'required',
									    'address_line_2' => 'required',
									    'city' => 'required',
									    'state' => 'required',
									    'zipcode' => 'required', 
									    'latitude'=> 'required',
									    'longitude' => 'required',  
									    'contactNo' => 'required',
									    'websitelink' => 'required',
									    'fblink' => 'required',
									    'twitterlink' => 'required'

                                    ]); 
    }
}
