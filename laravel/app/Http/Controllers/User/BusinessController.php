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
use App\Models\IAmAttending;
use Mail;
use App\Models\User;
use App\Models\EmailNotificationSettings;

class BusinessController extends Controller
{
    // Return business index page
	public function viewBusiness(){
		$all_business = Business::orderBy('id', 'DESC')->paginate(4);
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
        $data['all_states'] = State::where('country_id',231)->pluck('name', 'id');
        $data['all_category1'] = Category::where('category_status',1)->pluck('name','category_id');
        $all_category = Category::where('category_status',1)->where('parent',0)->get();

        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('category_status',1)->where('parent',$category['category_id'])->pluck('name','category_id');
            }

        $all_tag = Tag::where('status',1)->pluck('tag_name','tag_id');
    	return view('frontend.pages.createbusiness',$data,compact('all_category','all_tag'));
    }
    // Save Business
    public function saveBusiness(Request $request){
    	$input = $request->input();
      $all_files = $request->file();
      
      foreach ($all_files as $key => $image){ 
        foreach ($image as $k => $value) {
          $data[$key] = $value;
          $imageValidation = $this->imageValidator($data);
        }
      }

      $validation = $this->businessValidation($input);

      if($validation->fails()){
          Session::flash('error', "Field is missing");
          return redirect()->back()->withErrors($validation)->withInput();
      }
    	else{
    		$city_model = new City();
	    	$state_model = new State();

            if(!empty($all_files)){

              $files = $request->file('file'); 
              $input_data = $request->all(); 
              $imageValidation = Validator::make( 
              $input_data, [ 'file.*' => 'required|mimes:jpg,jpeg,png' ],[ 
                'file.*.required' => 'Please upload an image', 
                'file.*.mimes' => 'Only jpeg,png images are allowed' ] ); 
              if($imageValidation->fails()) { 
                Session::flash('error', 'Only jpeg,png images are allowed');
                return Redirect()->back()->withErrors($imageValidation)->withInput(); 
              } 
              else {
                foreach($all_files as $files){
                  foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = "business_".uniqid().".".$extension;
                    $destinationPath = public_path().'/images/business/';
                    $file->move($destinationPath, $picture);

                    //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                    $new_images[] = $picture;
                    $images_string = implode(',',$new_images);
                  }
                }
              } 
            }
            else{
                $images_string = '';
            }
            // Saving address
	    	$address = Address::create([
	    					  'address_id' => uniqid(),
	                          'user_id' =>Auth::user()->user_id,
                            'country_id' => 231,
	                          'city_id' => $input['city'],
	                          'state_id' => $input['state'],
	                          'address_1' => $input['address_line_1'],
	                          'address_2' => $input['address_line_2'],
	                          'pincode' => $input['zipcode'],
	                        ]);

	    	
	    	$business_model = new Business();
	    	$business_offer_model = new BusinessOffer();

            //Modification of facebook link
            if(strripos($input['fblink'], 'http://') == false){

                $final_fb_link = 'http://'.$input['fblink'];
            }
            else{
                $final_fb_link = $input['fblink'];
            }

            //Modification of twitter link
            if(strripos($input['twitterlink'], 'http://') == false){

                $final_twitter_link = 'http://'.$input['twitterlink'];
            }
            else{
                $final_twitter_link = $input['twitterlink'];
            }

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
                            'business_fb_link' => $final_fb_link,
                            'business_twitter_link' => $final_twitter_link,
                            'business_website' => $input['websitelink'],
                            'business_email' => $input['email'],
                            'created_by' => Auth::User()->user_id,
                            'updated_by' => Auth::User()->user_id,
    	                    'category_id' => $input['category'],
    	                    'business_image' => $images_string,
	                    ]);

        if(isset($input['checkbox'])){
          $checkbox = implode(',',$input['checkbox']);
        }
        else{
          $checkbox = 0;
        }

	    	BusinessOffer::create([
	    				          'business_offer_id' => uniqid(),
                                  'business_id' => $business['business_id'],
                                  'business_discount_rate' => $input['businessdiscount'],
                                  'business_discount_types' => $checkbox,
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

            if(array_key_exists('tags',$input)){
                AssociateTag::create([
                        'user_id' => Auth::User()->user_id,
                        'entity_id' => $business['business_id'],
                        'entity_type' => 1,
                        'tags_id' => serialize($input['tags']),
                    ]);
            }

                $first_name = Auth::user()->first_name;
                $email = Auth::user()->email;

                $data = Business::where('business_id',$business['business_id'])->first();

                Mail::send('email.create_business',['name' => 'Efungenda','first_name'=>$first_name,'data'=>$data],function($message) use($email,$first_name){
                  $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Create business');
                });

            Session::flash('success', "Business created successfully.");
	    	return redirect()->back();
	    }
    }

    //Fetch update page
    public function edit($id){

        $data['all_country'] = Country::pluck('name','id');
        $data['all_category1'] = Category::pluck('name','category_id');
        $data['all_tag'] = Tag::pluck('tag_name','tag_id');
        $data['business'] = Business::where('business_id',$id)->first();

        $image_string = $data['business']->business_image;
        $image_array = explode(',', $image_string);
        $data['business']['images'] = $image_array;
        $category = $data['business']->getCategory()->pluck('category_id');
        $data['business']['category'] = $category[0];
        $tags = $data['business']->getTags()->pluck('tags_id');

        $unserialized_tags = null;
        foreach ($tags as $key => $value) {
                $tag_val = $value;
        }
        if(!empty($tag_val)){

          $unserialized_tags = unserialize($tags[0]);

          foreach ($unserialized_tags as $value) {
            $tag_names[] = Tag::where('tag_id',$value)->pluck('tag_name','tag_id');
          }
          foreach ($tag_names as $key => $value) {
            foreach ($value as $key => $val) {
              $tag_name[$key] = $val;
            }
            
          } 
        }

        $image = explode(',', $data['business']['business_image']);
        $data['business']['files'] = $image[0];

        if(count($data['business']->getAddress) > 0){
          if(count($data['business']->getAddress->getCountry) > 0){
            $country = $data['business']->getAddress->getCountry->id;  
            $data['business']['respected_states'] = State::where('country_id',$country)->pluck('name','id');
          }
          if(count($data['business']->getAddress->getState) > 0){
            $state = $data['business']->getAddress->getState->id;
            $data['business']['respected_city'] = City::where('state_id',$state)->pluck('name','id');
          }
        }

        $data['all_business']['name'] = $data['business']['business_title'];
        $data['all_business']['category'] = $data['business']['category'];
        $data['all_business']['tags'] = $unserialized_tags;

        $data['all_business']['costbusiness'] = $data['business']['business_cost'];
        if(count($data['business']->getBusinessOffer) > 0){
          $data['all_business']['businessdiscount'] = $data['business']->getBusinessOffer->business_discount_rate;
        }
        if(count($data['business']->getBusinessOffer) > 0){
          $data['all_business']['checkbox'] = $data['business']->getBusinessOffer->business_discount_types;
        }
        if(count($data['business']->getBusinessOffer) > 0){
          $data['all_business']['comment'] = $data['business']->getBusinessOffer->offer_description;
        }

        $data['all_business']['venue'] = $data['business']['business_venue'];

        if(count($data['business']->getAddress) > 0){
          if(!empty($data['business']->getAddress->address_1)){
            $data['all_business']['address_line_1'] = $data['business']->getAddress->address_1;
          }
          if(!empty($data['business']->getAddress->address_2)){
            $data['all_business']['address_line_2'] = $data['business']->getAddress->address_2;
          }  
          if(!empty($data['business']->getAddress->getCountry)){
            $data['all_business']['country'] = $data['business']->getAddress->getCountry->id;
          }
          if(!empty($data['business']->getAddress->getState)){
            $data['all_business']['state'] = $data['business']->getAddress->getState->id;
          }
          if(!empty($data['business']->getAddress->getCity)){
            $data['all_business']['city'] = $data['business']->getAddress->getCity->id;
          }
          $data['all_business']['zipcode'] = $data['business']->getAddress->pincode;
        }


        if(!empty($data['business']->getBusinessHours->monday_start)){
          $data['all_business']['monday_start'] = explode(',', $data['business']->getBusinessHours->monday_start)[0];
          $data['all_business']['mon_start_hour'] = explode(',', $data['business']->getBusinessHours->monday_start)[1];
        }
        if(!empty($data['business']->getBusinessHours->monday_end)){
          $data['all_business']['monday_end'] = explode(',', $data['business']->getBusinessHours->monday_end)[0];
          $data['all_business']['mon_end_hour'] = explode(',', $data['business']->getBusinessHours->monday_end)[1];
        }

        if(!empty($data['business']->getBusinessHours->tuesday_start)){
          $data['all_business']['tuesday_start'] = explode(',', $data['business']->getBusinessHours->tuesday_start)[0];
          $data['all_business']['tue_start_hour'] = explode(',', $data['business']->getBusinessHours->tuesday_start)[1];
        } 
        if(!empty($data['business']->getBusinessHours->tuesday_end)){
          $data['all_business']['tuesday_end'] = explode(',', $data['business']->getBusinessHours->tuesday_end)[0];
          $data['all_business']['tue_end_hour'] = explode(',', $data['business']->getBusinessHours->tuesday_end)[1];
        } 

        if(!empty($data['business']->getBusinessHours->wednesday_start)){
          $data['all_business']['wednesday_start'] = explode(',', $data['business']->getBusinessHours->wednesday_start)[0];
          $data['all_business']['wed_start_hour'] = explode(',', $data['business']->getBusinessHours->wednesday_start)[1];
        } 
        if(!empty($data['business']->getBusinessHours->wednesday_end)){
          $data['all_business']['wednesday_end'] = explode(',', $data['business']->getBusinessHours->wednesday_end)[0];
          $data['all_business']['wed_end_hour'] = explode(',', $data['business']->getBusinessHours->wednesday_end)[1];
        } 

        if(!empty($data['business']->getBusinessHours->thursday_start)){
          $data['all_business']['thursday_start'] = explode(',', $data['business']->getBusinessHours->thursday_start)[0];
          $data['all_business']['thurs_start_hour'] = explode(',', $data['business']->getBusinessHours->thursday_start)[1];
        } 
        if(!empty($data['business']->getBusinessHours->thursday_end)){
          $data['all_business']['thursday_end'] = explode(',', $data['business']->getBusinessHours->thursday_end)[0];
          $data['all_business']['thurs_end_hour'] = explode(',', $data['business']->getBusinessHours->thursday_end)[1];
        } 

        if(!empty($data['business']->getBusinessHours->friday_start)){
          $data['all_business']['friday_start'] = explode(',', $data['business']->getBusinessHours->friday_start)[0];
          $data['all_business']['fri_start_hour'] = explode(',', $data['business']->getBusinessHours->friday_start)[1];
        } 
        if(!empty($data['business']->getBusinessHours->friday_end)){
          $data['all_business']['friday_end'] = explode(',', $data['business']->getBusinessHours->friday_end)[0];
          $data['all_business']['fri_end_hour'] = explode(',', $data['business']->getBusinessHours->friday_end)[1];
        } 

        if(!empty($data['business']->getBusinessHours->saturday_start)){
          $data['all_business']['saturday_start'] = explode(',', $data['business']->getBusinessHours->saturday_start)[0];
          $data['all_business']['sat_start_hour'] = explode(',', $data['business']->getBusinessHours->saturday_start)[1];
        } 
        if(!empty($data['business']->getBusinessHours->saturday_end)){
          $data['all_business']['saturday_end'] = explode(',', $data['business']->getBusinessHours->saturday_end)[0];
          $data['all_business']['sat_end_hour'] = explode(',', $data['business']->getBusinessHours->saturday_end)[1];
        } 


        $data['all_business']['latitude'] = $data['business']['business_lat'];
        $data['all_business']['longitude'] = $data['business']['business_long'];
        $data['all_business']['contactNo'] = $data['business']['business_mobile'];
        $data['all_business']['email'] = $data['business']['business_email'];
        if(!empty($data['business']['business_website'])){
          $data['all_business']['websitelink'] = $data['business']['business_website'];
        }
        if(!empty($data['business']['business_fb_link'])){
          $data['all_business']['fblink'] = $data['business']['business_fb_link'];
        }
        if(!empty($data['business']['business_twitter_link'])){
          $data['all_business']['twitterlink'] = $data['business']['business_twitter_link'];
        }
        if(!empty($data['business']['business_id'])){
          $data['all_business']['business_id'] = $data['business']['business_id'];
        }
        return view('frontend.pages.createbusiness',$data);
    }

    // Update business
    public function update(Request $request){

        $input = $request->input();

        $all_files = $request->file();
        $imageValidation = [];
      
        foreach ($all_files as $key => $image){ 
          foreach ($image as $k => $value) {
            $data[$key] = $value;
            $imageValidation = $this->imageValidator($data);
          }
        }

        $validation = $this->businessValidation($input);

      if($validation->fails()){
          Session::flash('error', "Field is missing");
          return redirect()->back()->withErrors($validation)->withInput();
      }
        else{

          $all_data_business = Business::where('business_id',$input['business_id'])->first();
          $all_data_address = Address::where('address_id',$all_data_business['business_location'])->first();
          $all_date_business_offer = BusinessOffer::where('business_id',$input['business_id'])->first();
          $all_data_business_hours = BusinessHoursOperation::where('business_id',$input['business_id'])->first();
          $all_data_associate_tag = AssociateTag::where('entity_id',$input['business_id'])->where('entity_type',1)->first();

          $image_already_exist = $all_data_business->business_image;
          $image_already_exist_array = explode(',', $image_already_exist);
          // print_r($image_already_exist_array);die;

          if(!empty($all_files)){

            $files = $request->file('file'); 
              $input_data = $request->all(); 
              $imageValidation = Validator::make( 
              $input_data, [ 'file.*' => 'required|mimes:jpg,jpeg,png' ],[ 
                'file.*.required' => 'Please upload an image', 
                'file.*.mimes' => 'Only jpeg,png images are allowed' ] ); 
              if($imageValidation->fails()) { 
                Session::flash('error', 'Only jpeg,png images are allowed');
                return Redirect()->back()->withErrors($imageValidation)->withInput(); 
              }
              else {
                foreach($all_files as $files){
                  foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = "business_".uniqid().".".$extension;
                    $destinationPath = public_path().'/images/business/';
                    $file->move($destinationPath, $picture);

                    //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                    $new_images[] = $picture;
                    $images_string = implode(',',$new_images);
                  }
                }
                if($image_already_exist_array[0] != ''){
                  $all_image_final = implode(',',array_merge($new_images,$image_already_exist_array));
                }
                else{
                  $all_image_final = implode(',',$new_images);
                }

              }

          }
          else{
            $all_image_final = $image_already_exist;
          }

          $all_data_address->update([
                              'country_id' => 231,
                              'city_id' => $input['city'],
                              'state_id' => $input['state'],
                              'address_1' => $input['address_line_1'],
                              'address_2' => $input['address_line_2'],
                              'pincode' => $input['zipcode'],
                            ]);

          $all_data_business->update([
                          'business_title' => $input['name'],
                          'business_venue' => $input['venue'],
                          'category_id' => $input['category'],
                          'business_lat' => $input['latitude'],
                          'business_long' => $input['longitude'],
                          'business_cost' => $input['costbusiness'],
                          'business_mobile' => $input['contactNo'],
                          'business_fb_link' => $input['fblink'],
                          'business_twitter_link' => $input['twitterlink'],
                          'business_website' => $input['websitelink'],
                          'business_email' => $input['email'],
                          'business_image' => $all_image_final,
                          ]);

          if(isset($input['checkbox'])){
            $checkbox = implode(',',$input['checkbox']);
          }
          else{
            $checkbox = 0;
          }

          $all_date_business_offer->update([
                          'business_discount_rate' => $input['businessdiscount'],
                          'business_discount_types' => $checkbox,
                              ]);

          $all_data_business_hours->update([
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

          if(array_key_exists('tags',$input)){
              if(count($all_data_associate_tag) > 0){
                  $all_data_associate_tag->update([
                        'tags_id' => serialize($input['tags']),
                    ]);
              }
              else{
                AssociateTag::create([
                      'user_id' => Auth::user()->user_id,
                      'entity_id' => $input['business_id'],
                      'entity_type' => 1,
                      'tags_id' => serialize($input['tags']),
                  ]);
              }
           
            }

            /* Mail sending section */
           $user_data_all = [];

           $my_fav_list = MyFavorite::where('entity_id',$input['business_id'])->where('entity_type',1)->get();

            foreach ($my_fav_list as $my_fav_single) {
              $notification = EmailNotificationSettings::where('user_id',$my_fav_single['user_id'])->first();
              $notification_have = 0;
              if(!empty($notification)){
                  $notification_have = $notification->notification_enabled;
                }
              if($notification_have == 1){
                $user_data = User::where('user_id',$my_fav_single['user_id'])->first();
                $user_data_all[] = $user_data;
              }
            }
            $business_data_array = [];
            $data = Business::where('business_id',$input['business_id'])->first();
            
            foreach ($user_data_all as $single_user) {

                $first_name = $single_user['first_name'];
                $email = $single_user['email'];

                Mail::send('email.edit_business',['name' => 'Efungenda','first_name'=>$first_name,'data'=>$data],function($message) use($email,$first_name){
                  $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Update business');
                });

              $business_data = $single_user->getEmailNotification->business_id;
              if(empty($business_data)){
                $single_user->getEmailNotification->update([ 'business_id'=> $input['business_id']]);
              }
              else{
                $business_data_array[] = $business_data;
                foreach ($business_data_array as $value) {
                  if($input['business_id'] != $value){
                    $business_data_array[] = $input['business_id'];
                  }
                }
               $business_data_string = implode(',', $business_data_array);
                $single_user->getEmailNotification->update([ 'business_id'=> $business_data_string]); 
              }
            }

            Session::flash('success','Business updated successfully');
            return redirect()->back();

        }
    }

    // Delete image
    public function deleteImage($id,$name){
        // echo $name;die();
      $business = Business::where('business_id',$id)->first();
      $all_image = Business::where('business_id',$id)->first()->business_image;
      $all_image_array = explode(',', $all_image);
      $new_image_array = [];
      $new_image_string = null;

      foreach ($all_image_array as $value) {
        if($value != $name){
          $new_image_array[] = $value;
        }
      }
      // echo "<pre>";print_r($new_image_array);die();

      if(!empty($new_image_array)){
        $new_image_string = implode(',', $new_image_array);
      }

      $business->update([
          'business_image' => $new_image_string,
        ]);

      
      return redirect()->back();
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
        if(empty($data)){
          Session::flash('error', "Url is not valid");
          return redirect('/');
        }
        else{
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

          $data['business_hours'] = $data->getBusinessHours;
          // echo "<pre>";print_r($data['image']);die;
          // echo explode(',',$data['business_hours']['wednesday_start'])[0];die();
          // echo "<pre>";print_r($data);die;
          return view('frontend.pages.morebusiness',compact('data','all_category'));  

        }
        
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

                $data = Business::where('business_id',$input['business_id'])->first();

                $all_fav_data = MyFavorite::where('entity_type',1)->where('entity_id',$input['business_id'])->get();

                $count = count($all_fav_data);

                $email = Auth::user()->email;
                $first_name = Auth::user()->first_name;

                Mail::send('email.business_email',['name' => 'Efungenda','first_name'=>$first_name,'data'=>$data],function($message) use($email,$first_name){
                  $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Add to favorite Successfull');
                });

                return ['status' => 1, 'count' => $count];
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
        // echo "<pre>";print_r($data);die;
        $data->delete();

        $all_fav_data = MyFavorite::where('entity_type',1)->where('entity_id',$input['business_id'])->get();

            $count = count($all_fav_data);

        $email = Auth::user()->email;
        $first_name = Auth::user()->first_name;

        $data = Business::where('business_id',$input['business_id'])->first();

        Mail::send('email.remove_business_email',['name' => 'Efungenda','first_name'=>$first_name,'data'=>$data],function($message) use($email,$first_name){
          $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Remove from favorite');
        });

        return ['status' => 1, 'count' => $count];
    }

    //I am attending method
    public function iAmAttending(Request $request){
        $input = $request->input();
        // echo $input['business_id'];die();
        $data = IAmAttending::where('user_id',Auth::user()->user_id)->where('entity_id',$input['business_id'])->where('entity_type',1)->where('status',1)->first(); 

        if(!empty($data)){

            return ['status' => 2,'msg' => 'You have already added this business'];
        }
        else{

            IAmAttending::create([
                'user_id' => Auth::user()->user_id,
                'entity_id' => $input['business_id'],
                'entity_type' => 1,
                'status' => 1,
            ]);

            return ['status' => 1, 'msg'=>'Thank you for adding'];

        }
        
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
									    'contactNo' => 'required|numeric',
                      'email' => 'required|email',

                                    ]); 
    }

    protected function imageValidator($request){
        return Validator::make($request,[  
                                    'file' => 'mimes:jpeg,jpg,png'     
                                ]); 
    }
}
