<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Event;
use App\Models\EventOffer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use Session;
use GetLatitudeLongitude;
use App\Models\Tag;
use App\Models\AssociateTag;
use App\Models\MyFavorite;
use Mail;
use App\Models\User;
use App\Models\EmailNotificationSettings;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::paginate(10);

        return view('admin.event.show-event',compact('data'));
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
        $data['all_category'] = Category::pluck('name','category_id');
        $data['all_tag'] = Tag::pluck('tag_name','tag_id');
        // echo "<pre>";
        // print_r($data);die();

        return view('admin.event.create-event',$data);
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
        $validation = $this->eventValidation($input);
        if($validation->fails()){
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
            if(!empty($all_files)){
              foreach($all_files as $files){
                  foreach ($files as $file) {
                      $filename = $file->getClientOriginalName();
                      $extension = $file->getClientOriginalExtension();
                      $picture = "event_".uniqid().".".$extension;
                      $destinationPath = public_path().'/images/event/';
                      $file->move($destinationPath, $picture);

                      //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                      $new_images[] = $picture;
                      $images_string = implode(',',$new_images);
                  }
              }
            }
            else{
              $images_string = 'placeholder.svg';
            }

            $city_model = new City();
            $state_model = new State();

            $address = Address::create([
                              'address_id' => uniqid(),
                              'user_id' => uniqid(),
                              'country_id' => $input['country'],
                              'city_id' => $input['city'],
                              'state_id' => $input['state'],
                              'address_1' => $input['address_line_1'],
                              'address_2' => $input['address_line_2'],
                              'pincode' => $input['zipcode'],
                            ]);

            
            $event_model = new Event();
            $event_offer_model = new EventOffer();
            $modified_start_date = date("Y-m-d", strtotime($input['startdate']));
            $modified_end_date = date("Y-m-d", strtotime($input['enddate']));

            $date1=date_create($modified_end_date);
            $date2=date_create($modified_start_date);
            $diff=date_diff($date2,$date1);

            $event = Event::create([
                          'event_id' =>uniqid(),
                          'event_title' => $input['name'],
                          'event_location' => $address['address_id'],
                          'event_venue' => $input['venue'],
                          'category_id' => $input['category'],
                          'event_cost' => $input['costevent'],
                          'event_image' => $images_string,
                          'event_start_date' => $modified_start_date,
                          'event_end_date' => $modified_end_date,
                          'event_start_time' => $input['starttime'],
                          'event_end_time' => $input['endtime'],
                          'event_active_days' => $diff->format("%R%a days"),
                          'event_lat' => $input['latitude'],
                          'event_long' => $input['longitude'],
                          'event_mobile' => $input['contactNo'],
                          'event_fb_link' => $input['fblink'],
                          'event_twitter_link' => $input['twitterlink'],
                          'event_website' => $input['websitelink'],
                          'event_email' => $input['email'],
                          'event_status' => 1,
                          'created_by' => Auth::User()->user_id,
                          'updated_by' => Auth::User()->user_id,
                        ]);


            EventOffer::create([
                          'event_offer_id' => uniqid(),
                          'offer_description' => $input['comment'],
                          'event_id' => $event['event_id'],
                          'discount_rate' => $input['eventdiscount'],
                          'discount_types' => $input['checkbox'],
                          'created_by' => Auth::User()->user_id,
                          'event_offer_status' => 1,
                              ]);

            if(array_key_exists('tags',$input)){
              AssociateTag::create([
                      'user_id' => Auth::User()->user_id,
                      'entity_id' => $event['event_id'],
                      'entity_type' => 2,
                      'tags_id' => serialize($input['tags']),
                  ]);
            }
            
            Session::flash('success', "Event created successfully.");
            return redirect('admin/event');

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
        $data['event'] = Event::where('event_id',$id)->first();

        $image_string = $data['event']->event_image;
        $image_array = explode(',', $image_string);
        $data['event']['images'] = $image_array;
        $category = $data['event']->getCategory()->pluck('category_id');
        $data['event']['category'] = $category[0];
        $tags = $data['event']->getTags()->pluck('tags_id');

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

        $image = explode(',', $data['event']['event_image']);
        $data['event']['files'] = $image[0];
        
        if(count($data['event']->getAddress) > 0){
          if(count($data['event']->getAddress->getCountry) > 0){
            $country = $data['event']->getAddress->getCountry->id;  
            $data['event']['respected_states'] = State::where('country_id',$country)->pluck('name','id');
          }
          if(count($data['event']->getAddress->getState)){
            $state = $data['event']->getAddress->getState->id;
            $data['event']['respected_city'] = City::where('state_id',$state)->pluck('name','id');
          }
        }


        $data['all_event']['name'] = $data['event']['event_title'];
        $data['all_event']['category'] = $data['event']['category'];
        $data['all_event']['tags'] = $unserialized_tags;

        $data['all_event']['costevent'] = $data['event']['event_cost'];
        if(count($data['event']->getEventOffer) > 0){
          $data['all_event']['eventdiscount'] = $data['event']->getEventOffer->discount_rate;
        }
        if(count($data['event']->getEventOffer) > 0){
          $data['all_event']['checkbox'] = $data['event']->getEventOffer->discount_types;
        }
        if(count($data['event']->getEventOffer) > 0){
          $data['all_event']['comment'] = $data['event']->getEventOffer->offer_description;
        }
        $data['all_event']['startdate'] = date("m/d/y",strtotime(explode(',',$data['event']['event_start_date'])[0]));
        $data['all_event']['starttime'] = explode(' ', $data['event']['event_start_time'])[0];
        $data['all_event']['enddate'] = date("m/d/y",strtotime(explode(',',$data['event']['event_end_date'])[0]));
        $data['all_event']['endtime'] = explode(' ', $data['event']['event_end_time'])[0];

        $data['all_event']['venue'] = $data['event']['event_venue'];

        if(count($data['event']->getAddress) > 0){
          if(!empty($data['event']->getAddress->address_1)){
            $data['all_event']['address_line_1'] = $data['event']->getAddress->address_1;
          }
          if(!empty($data['event']->getAddress->address_2)){
            $data['all_event']['address_line_2'] = $data['event']->getAddress->address_2;
          }  
          if(!empty($data['event']->getAddress->getCountry)){
            $data['all_event']['country'] = $data['event']->getAddress->getCountry->id;
          }
          if(!empty($data['event']->getAddress->getState)){
            $data['all_event']['state'] = $data['event']->getAddress->getState->id;
          }
          if(!empty($data['event']->getAddress->getCity)){
            $data['all_event']['city'] = $data['event']->getAddress->getCity->id;
          }
          $data['all_event']['zipcode'] = $data['event']->getAddress->pincode;
        }

        $data['all_event']['latitude'] = $data['event']['event_lat'];
        $data['all_event']['longitude'] = $data['event']['event_long'];
        $data['all_event']['contactNo'] = $data['event']['event_mobile'];
        $data['all_event']['email'] = $data['event']['event_email'];
        if(!empty($data['event']['event_website'])){
          $data['all_event']['websitelink'] = $data['event']['event_website'];
        }
        if(!empty($data['event']['event_fb_link'])){
          $data['all_event']['fblink'] = $data['event']['event_fb_link'];
        }
        if(!empty($data['event']['event_twitter_link'])){
          $data['all_event']['twitterlink'] = $data['event']['event_twitter_link'];
        }
        if(!empty($data['event']['event_id'])){
          $data['all_event']['event_id'] = $data['event']['event_id'];
        }

        return view('admin.event.create-event',$data);
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
        // echo "<pre>";
        // print_r($input);die();
        $validation = $this->eventValidation($input);

        if($validation->fails()){
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
          $all_data_event = Event::where('event_id',$input['event_id'])->first();
          $all_data_address = Address::where('address_id',$all_data_event['event_location'])->first();
          $all_date_event_offer = EventOffer::where('event_id',$input['event_id'])->first();

          $all_data_associate_tag = AssociateTag::where('entity_id',$input['event_id'])->where('entity_type',2)->first();

           $image_already_exist = $all_data_event->event_image;
           $image_already_exist_array = explode(',', $image_already_exist);

            if(!empty($all_files)){
              foreach($all_files as $files){
                  foreach ($files as $file) {
                      $filename = $file->getClientOriginalName();
                      $extension = $file->getClientOriginalExtension();
                      $picture = "event_".uniqid().".".$extension;
                      $destinationPath = public_path().'/images/event/';
                      $file->move($destinationPath, $picture);

                      //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                      $new_images[] = $picture;
                  }
              }
              // echo "<pre>";print_r($all_data_event->event_image);die();
              

              $all_image_final = implode(',',array_merge($new_images,$image_already_exist_array));;
            }
            else{
              
              $all_image_final = $image_already_exist;
            }

            $all_data_address->update([

                              'country_id' => $input['country'],
                              'city_id' => $input['city'],
                              'state_id' => $input['state'],
                              'address_1' => $input['address_line_1'],
                              'address_2' => $input['address_line_2'],
                              'pincode' => $input['zipcode'],

              ]);

            $modified_start_date = date("Y-m-d", strtotime($input['startdate']));
            $modified_end_date = date("Y-m-d", strtotime($input['enddate']));

            $date1=date_create($modified_end_date);
            $date2=date_create($modified_start_date);
            $diff=date_diff($date2,$date1);

            $all_data_event->update([
                          'event_title' => $input['name'],
                          'event_venue' => $input['venue'],
                          'category_id' => $input['category'],
                          'event_cost' => $input['costevent'],
                          'event_image' => $all_image_final,
                          'event_start_date' => $modified_start_date,
                          'event_end_date' => $modified_end_date,
                          'event_start_time' => $input['starttime'],
                          'event_end_time' => $input['endtime'],
                          'event_active_days' => $diff->format("%R%a days"),
                          'event_lat' => $input['latitude'],
                          'event_long' => $input['longitude'],
                          'event_mobile' => $input['contactNo'],
                          'event_fb_link' => $input['fblink'],
                          'event_twitter_link' => $input['twitterlink'],
                          'event_website' => $input['websitelink'],
                          'event_email' => $input['email'],
                          'event_status' => 1,
                          'created_by' => Auth::User()->user_id,
                          'updated_by' => Auth::User()->user_id,
              ]);

            $all_date_event_offer->update([
                          'offer_description' => $input['comment'],
                          'discount_rate' => $input['eventdiscount'],
                          'discount_types' => $input['checkbox'],
                          'created_by' => Auth::User()->user_id,
                          'event_offer_status' => 1,

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
                      'entity_id' => $input['event_id'],
                      'entity_type' => 2,
                      'tags_id' => serialize($input['tags']),
                  ]);
              }
           
            }

             /* Mail sending section */
             $user_data_all = [];

             $my_fav_list = MyFavorite::where('entity_id',$input['event_id'])->where('entity_type',2)->get();

              foreach ($my_fav_list as $my_fav_single) {
                $notification = EmailNotificationSettings::where('user_id',$my_fav_single['user_id'])->first();
                $notification_have = 0;
                if(!empty($notification)){
                  $notification_have = $notification->notification_enabled;
                }
                if($notification_have == 1){
                  $user_data = User::where('user_id',$my_fav_single['user_id'])->pluck('email','first_name');
                  $user_data_all[] = $user_data;
                }
              }
              
              foreach ($user_data_all as $single_user) {
                foreach ($single_user as $first_name => $email) {
                  Mail::send('email.edit_event',['name' => 'Efungenda'],function($message) use($email,$first_name){
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Update event');
                  });
                }
              }

            Session::flash('success','Event update successfully');
            return redirect()->back();

        }
    }

    //For delete image
    public function deleteImage($id,$name){
      // echo $id;die();
      $event = Event::where('event_id',$id)->first();
      $all_image = Event::where('event_id',$id)->first()->event_image;
      $all_image_array = explode(',', $all_image);
      $new_image_array = [];
      $new_image_string = null;

      foreach ($all_image_array as $value) {
        if($value != $name){
          $new_image_array[] = $value;
        }
      }

      if(!empty($new_image_array)){
        $new_image_string = implode(',', $new_image_array);
      }

      $event->update([
          'event_image' => $new_image_string,
        ]);

      
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //Fetch State according to country
    public function fetchState(Request $request){
      $input = $request->input();
      $all_states = State::where('country_id',$input['data'])->pluck('name','id');
      return $all_states;
    }

    // Getting required cities
    public function getCity(Request $request){
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
    
    // Validation of create-event-form-field
    protected function eventValidation($request){
        return Validator::make($request,[
                                        'name' => 'required',
                                        'category' => 'required',
                                        'costevent' => 'required',
                                        'comment' => 'required',
                                        'startdate' => 'required',
                                        'starttime' => 'required',
                                        'enddate' => 'required',
                                        'endtime' => 'required',
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
                                        'email' => 'required|email',
                                        'websitelink' => 'required',
                                        'fblink' => 'required',
                                        'twitterlink' => 'required'  
                                    ]); 
    }
}
