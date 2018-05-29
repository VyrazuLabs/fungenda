<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\BusinessOffer;
use App\Models\BusinessHoursOperation;
use App\Models\Address;
use App\Models\Category;
use Auth;
use Validator;
use Session;
use Illuminate\Support\Facades\Input;
use GetLatitudeLongitude;
use App\Models\Tag;
use App\Models\AssociateTag;
use App\Models\MyFavorite;
use Mail;
use App\Models\User;
use App\Models\EmailNotificationSettings;
use App\Models\RecentlyViewed;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Business::orderBy('id', 'DESC')->paginate(10);
        foreach ($data as $value) {
            $value['image'] = explode(',',$value['business_image']);
        }

        return view('admin.business.show-business',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state_model = new State();
        $data['all_country'] = Country::pluck('name','id');
        $data['all_category'] = Category::where('category_status',1)->pluck('name','category_id');
        $data['all_tag'] = Tag::where('status',1)->pluck('tag_name','tag_id');
        return view('admin.business.create-business',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

            $address = Address::create([
                              'address_id' => uniqid(),
                              'user_id' => uniqid(),
                              'country_id' => $input['country'],
                              'city_id' => $input['city'],
                              'state_id' => $input['state'],
                              'address_1' => $input['address_line_1'],
                              // 'address_2' => $input['address_line_2'],
                              'pincode' => $input['zipcode'],
                            ]);

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
                          'business_description' =>$input['business_description'],
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
                    'wednesday_end' => $input['wednessday_end'].",".$input['wed_end_hour'],
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
              $tag_name = '';
              foreach ($input['tags'] as $value) {
                $tag_data = Tag::where('tag_id', $value)->first();
                if(!empty($tag_data)) {
                  $tag_name .= ','.$tag_data->tag_name;
                }
              }

              $business->update(['tag_id' => $tag_name]);
            }  

            Session::flash('success', "Business created successfully.");
            return redirect('admin/business');           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          
        $data['all_country'] = Country::pluck('name','id');
        $data['all_category'] = Category::pluck('name','category_id');
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
          $data['all_business']['wednessday_start'] = explode(',', $data['business']->getBusinessHours->wednesday_start)[0];
          $data['all_business']['wed_start_hour'] = explode(',', $data['business']->getBusinessHours->wednesday_start)[1];
        } 
        if(!empty($data['business']->getBusinessHours->wednesday_end)){
          $data['all_business']['wednessday_end'] = explode(',', $data['business']->getBusinessHours->wednesday_end)[0];
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
        $data['all_business']['business_description'] = $data['business']['business_description'];
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

        return view('admin.business.create-business',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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

              $all_image_final = implode(',',array_merge($new_images,$image_already_exist_array));;
            }
          }
          else{
            $all_image_final = $image_already_exist;
          }

          $all_data_address->update([
                              'country_id' => $input['country'],
                              'city_id' => $input['city'],
                              'state_id' => $input['state'],
                              'address_1' => $input['address_line_1'],
                              // 'address_2' => $input['address_line_2'],
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
                          'business_description' =>$input['business_description'],
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
                    'wednesday_end' => $input['wednessday_end'].",".$input['wed_end_hour'],
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

    //For delete image
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $input = $request->input();
        // echo $input['data'];die;
        $business = Business::where('business_id',$input['data'])->first();
        // $event['event_location'];

        $my_favorite = MyFavorite::where('entity_id',$input['data'])->where('entity_type',1)->get();
        if(!empty($my_favorite)){
          foreach ($my_favorite as $value) {
            $value->delete();
          }
        }
        $recently_viewed = RecentlyViewed::where('entity_id',$input['data'])->where('type',1)->first();
        if(!empty($recently_viewed)){
          $recently_viewed->delete();
        }

        $address = Address::where('address_id',$business['business_location'])->first();
        $address->delete();
        $business_offer = BusinessOffer::where('business_id',$input['data'])->first();
        $business_offer->delete();
        $associate_tags = AssociateTag::where('entity_id',$input['data'])->where('entity_type',1)->first();
        if(!empty($associate_tags)){
          $associate_tags->delete();
        }
        $business_hours_operation = BusinessHoursOperation::where('business_id',$input['data'])->first();
        if(!empty($business_hours_operation)){
          $business_hours_operation->delete();
        } 
        $business->delete();
        return(['status'=>1]);    
    }
    //Fetch State according to country
    public function fetchState(Request $request){
      $input = $request->input();
      $all_states = State::where('country_id',$input['data'])->pluck('name','id');
      return $all_states;
    }
    // Fetch country according to state
    public function getCity(Request $request){
        $input = $request->input();
        $all_cities = City::where('state_id',$input['data'])->pluck('name','id');
        return $all_cities;
    }
    // Validation of create-business-form-field
    protected function businessValidation($request){
        return Validator::make($request,[
                                      'name' => 'required',
                                      'category' => 'required',
                                      'address_line_1' => 'required',
                                      // 'address_line_2' => 'required',
                                      'country' => 'required',
                                      'city' => 'required',
                                      'state' => 'required',
                                      'zipcode' => 'required', 
                                      'latitude'=> 'required',
                                      'longitude' => 'required'
                                    ]); 
    }

    protected function imageValidator($request){
        return Validator::make($request,[  
                                    'file' => 'mimes:jpeg,jpg,png'     
                                ]); 
    }
}
