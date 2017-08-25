<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Models\Business;
use App\Models\BusinessOffer;
use App\Models\BusinessHoursOperation;
use App\Models\Address;
use App\Models\Category;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use GetLatitudeLongitude;
use App\Models\MyFavorite;
use App\Models\RecentlyViewed;
use Session;
use App\Models\Tag;
use App\Models\AssociateTag;

class BusinessController extends Controller
{
    // Return business index page
	public function viewBusiness(){
		$all_business = Business::paginate(4);
        if(!empty($all_business[0])){
        	foreach ($all_business as $business) {
                $business_count = count($business->getFavorite()->where('status',1)->get());
                $business['fav_count'] = $business_count;
        		$img = explode(',',$business['business_image']);
        		$business['image'] = $img;
                $related_tags = $business->getTags()->where('entity_type',1)->get();
                $business['tags'] = $related_tags;
        	}
            // fetch category list
            $all_category = Category::where('parent',0)->get();
            foreach ($all_category as $category) {
                    $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                }
            // echo "<pre>";
            // print_r($all_business);die();
        	return view('frontend.pages.viewbusiness',compact('all_business','all_category'));
        }
        else{
            $all_category = Category::where('parent',0)->get();
          
              foreach ($all_category as $category) {
                      $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                  }
        return view('error.businessNothingFound',compact('all_category'));
      }
    }
	// View Create Business page
    public function viewCreateBusiness(){
    	$state_model = new State();
        $data['all_country'] = Country::pluck('name','id');
        $data['all_category1'] = Category::pluck('name','category_id');
        $all_category = Category::where('parent',0)->get();

        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }

        $all_tag = Tag::pluck('tag_name','tag_id');
    	return view('frontend.pages.createbusiness',$data,compact('all_category','all_tag'));
    }
    // Save Business
    public function saveBusiness(Request $request){
    	$input = $request->input();
    	$all_files = $request->file();
    	$validation = $this->businessValidation($input);

    	if($validation->fails()){
            Session::flash('error', "Field is missing");
    		return redirect()->back()->withErrors($validation->errors())->withInput();
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
            // Saving address
	    	$address = Address::create([
	    					  'address_id' => uniqid(),
	                          'user_id' =>Auth::user()->user_id,
                              'country_id' => $input['country'],
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
                            'business_title' => $input['name'],
                            'business_location' => $address['address_id'],
                            'business_venue' => $input['venue'],
                            'business_lat' => $input['latitude'],
                            'business_long' => $input['longitude'],
                            'business_active_days' => 1,
                            'business_status' => 1,
                            'business_cost' => $input['costbusiness'],
                            'business_mobile' => $input['contactNo'],
                            'business_fb_link' => $input['fblink'],
                            'business_twitter_link' => $input['twitterlink'],
                            'business_website' => $input['websitelink'],
                            'business_email' => $input['email'],
                            'created_by' => Auth::User()->user_id,
                            'updated_by' => Auth::User()->user_id,
    	                    'category_id' => $input['category'],
    	                    'business_image' => $images_string,
	                    ]);


	    	BusinessOffer::create([
	    				          'business_offer_id' => uniqid(),
                                  'business_id' => $business['business_id'],
                                  'business_discount_rate' => $input['businessdiscount'],
                                  'business_discount_types' => $input['checkbox'],
                                  'business_offer_description' => 1,
                                  'business_wishlist_id' => 1,
                                  'created_by' => Auth::User()->user_id,
                                  'business_offer_status' => 1,
                                  'updated_by' => Auth::User()->user_id,
	                    	  ]);

            BusinessHoursOperation::create([
                    'business_id' => $business['business_id'],
                    'monday_start' => $input['monday_start'].",".$input['mon_start_hour'],
                    'monday_end' => $input['monday_end'].",".$input['mon_end_hour'],
                    'tuesday_start' => $input['tuesday_start'].",".$input['tue_start_hour'],
                    'tuesday_end' => $input['tuesday_end'].",".$input['tue_end_hour'],
                    'wednesday_start' => $input['wednessday_start'].",".$input['wed_start_hour'],
                    'wednesday_end' => $input['wednessday_start'].",".$input['wed_end_hour'],
                    'thursday_start' => $input['thursday_start'].",".$input['thurs_start_hour'],
                    'thursday_end' => $input['thursday_end'].",".$input['thurs_end_hour'],
                    'friday_start' => $input['friday_start'].",".$input['fri_start_hour'],
                    'friday_end' => $input['friday_end'].",".$input['fri_end_hour'],
                    'saturday_start' => $input['saturday_start'].",".$input['sat_start_hour'],
                    'saturday_end' => $input['saturday_end'].",".$input['sat_end_hour'],
                ]);

            AssociateTag::create([
                    'user_id' => Auth::User()->user_id,
                    'entity_id' => $business['business_id'],
                    'entity_type' => 1,
                    'tags_id' => serialize($input['tags']),
                ]);
            Session::flash('success', "Business create successfully.");
	    	return redirect()->back();
	    }
    }
    //Fetch State according to country
    public function fetchState(Request $request){
      $input = $request->input();
      $all_states = State::where('country_id',$input['data'])->pluck('name','id');
      return $all_states;
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
    // Getting more business
    public function getMoreBusiness(Request $request){
    	$input = $request->input();
        $all_tags_name = [];
    	$data = Business::where('business_id',$input['q'])->first();
    	$data['image'] = explode(',', $data['business_image']);
        $all_category = Category::where('parent',0)->get();
        $all_tags = AssociateTag::where('entity_id', $input['q'])->where('entity_type',1)->first();
        if(count($all_tags) > 0){
            foreach (unserialize($all_tags['tags_id']) as $value) {
              $all_tags_name[] = Tag::where('tag_id',$value)->pluck('tag_name');
            }
        }
        $data['all_tags'] = $all_tags_name;
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }
        // Recently viewed save
        $existOrNot = RecentlyViewed::where('entity_id',$input['q'])->first();
        if(empty($existOrNot)){
            RecentlyViewed::create([
                    'entity_id' => $input['q'],
                    'type' => 1,
                ]);
        }

        if(!empty($existOrNot)){
            $existOrNot->delete();
            RecentlyViewed::create([
                    'entity_id' => $input['q'],
                    'type' => 1,
                ]);
        }

    	return view('frontend.pages.morebusiness',compact('data','all_category'));
    }
    // Add to favourite
    public function addToFavourite(Request $request){
        $input = $request->input();
        if(Auth::User()){
            $data = MyFavorite::where('user_id',Auth::user()->user_id)->where('entity_type',1)->where('entity_id',$input['business_id'])->first();
            
            if(empty($data)){
                MyFavorite::create([
                        'entity_id' => $input['business_id'],
                        'user_id' => Auth::user()->user_id,
                        'entity_type' => 1,
                        'status' => 1,
                    ]);
                return ['status' => 1];
            }
            else{
                $data->status = 1;
                $data->save();
            }
        }
        else{
            return ['status' => 2];
        }

    }
    //Remove favorite
    public function removeFavorite(Request $request){
        $input = $request->input();
        $data = MyFavorite::where('user_id',Auth::user()->user_id)->where('entity_id',$input['business_id'])->where('entity_type',1)->first();
        $data->status = 0;
        $data->save();
        return ['status' => 1];
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
                                        'country' => 'required',
									    'city' => 'required',
									    'state' => 'required',
									    'zipcode' => 'required', 
									    'latitude'=> 'required',
									    'longitude' => 'required',  
									    'contactNo' => 'required|numeric',
									    'websitelink' => 'required',
                                        'email' => 'required|email',
									    'fblink' => 'required',
									    'twitterlink' => 'required'

                                    ]); 
    }
}
