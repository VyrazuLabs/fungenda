<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Event;
use App\Models\EventOffer;
use App\Models\Address;
use App\Models\Category;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use GetLatitudeLongitude;
use App\Models\MyFavorite;
use App\Models\RecentlyViewed;
use App\Models\Tag;
use App\Models\AssociateTag;
use Session;
use App\Models\IAmAttending;

class EventController extends Controller
{

    public function viewEvent(){
    	$all_events = Event::paginate(4);

      if(!empty($all_events[0])){
      	foreach ($all_events as $event) {
          $event_count = count($event->getFavorite()->where('status',1)->get());
          $event['fav_count'] = $event_count;
          $img = explode(',',$event['event_image']);
      	  $event['image'] = $img;
          $related_tags = $event->getTags()->where('entity_type',2)->get();
          $event['tags'] = $related_tags;
      	}
          $all_category = Category::where('parent',0)->get();
          
              foreach ($all_category as $category) {
                      $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                  }

          	return view('frontend.pages.viewevents',compact('all_events','all_category'));
      }
      else{
            $all_category = Category::where('parent',0)->get();
          
              foreach ($all_category as $category) {
                      $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                  }
        return view('error.nothingFound',compact('all_category'));
      }
        
    }
    // view Create event page
    public function viewCreateEvent(){
    	$state_model = new State();

      $data['all_country'] = Country::pluck('name','id');
        $data['all_category1'] = Category::pluck('name','category_id');
        $all_category = Category::where('parent',0)->get();

        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }

        $all_tag = Tag::pluck('tag_name','tag_id');
            
    	return view('frontend.pages.createevent', $data,compact('all_category','all_tag'));
    }
    
    // Save Events
    public function saveEvent(Request $request){
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
	                          'user_id' =>Auth::user()->user_id,
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
                          'updated_by' => Auth::User()->user_id
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
	    	return redirect()->back();
    	}
    	
    }
    //Fetch State according to country
    public function fetchState(Request $request){
      $input = $request->input();
      $all_states = State::where('country_id',$input['data'])->pluck('name','id');
      return $all_states;
    }

    // Fetch Country according to state
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

    // Getting more event
    public function getMoreEvent(Request $request){
        $input = $request->input();
        $all_tags_name = [];
        $data = Event::where('event_id',$input['q'])->first();
        $data['image'] = explode(',',$data['event_image']);

        $data['start_date'] = explode(' ',$data['event_start_date']);
        $data['end_date'] = explode(' ',$data['event_end_date']);
        $data['date_in_words'] = date('M d, Y',strtotime($data['start_date'][0]));
        $all_category = Category::where('parent',0)->get();
        $all_tags = AssociateTag::where('entity_id', $input['q'])->where('entity_type',2)->first();
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
                    'type' => 2,
                ]);
        }

        if(!empty($existOrNot)){
            $existOrNot->delete();
            RecentlyViewed::create([
                    'entity_id' => $input['q'],
                    'type' => 2,
                ]);
        }

      return view('frontend.pages.moreevent',compact('data','all_category'));
    }

    //Return edit page
    public function edit($id){
      // echo $id;die();
      $data['all_country'] = Country::pluck('name','id');
        $data['all_category1'] = Category::pluck('name','category_id');
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
        if(count($country = $data['event']->getAddress) > 0){
          $country = $data['event']->getAddress->getCountry->id;  
          $data['event']['respected_states'] = State::where('country_id',$country)->pluck('name','id');
        }

        $state = $data['event']->getAddress->getState->id;
        $data['event']['respected_city'] = City::where('state_id',$state)->pluck('name','id');

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
        $data['all_event']['startdate'] = date("m/d/y",strtotime($data['event']['event_start_date']));
        $data['all_event']['starttime'] = explode(' ', $data['event']['event_start_time'])[0];
        $data['all_event']['enddate'] = date("m/d/y",strtotime($data['event']['event_end_date']));
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
        return view('frontend.pages.createevent',$data);

    }
    //Delete image
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
    //Update event
    public function update(Request $request){
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

            Session::flash('success','Event update successfully');
            return redirect()->back();

        }
    }
    // Add to favourite
    public function addToFavourite(Request $request){
        $input = $request->input();

        if(Auth::User()){
            $data = MyFavorite::where('user_id',Auth::user()->user_id)->where('entity_type',2)->where('entity_id',$input['event_id'])->first();

            if(empty($data)){
                MyFavorite::create([
                        'entity_id' => $input['event_id'],
                        'user_id' => Auth::user()->user_id,
                        'entity_type' => 2,
                        'status' => 1,
                    ]);

              $all_fav_data = MyFavorite::where('entity_type',2)->where('entity_id',$input['event_id'])->get();
              $count = count($all_fav_data);

              return ['status' => 1,'count' => $count];
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
        $data = MyFavorite::where('user_id',Auth::user()->user_id)->where('entity_id',$input['event_id'])->where('entity_type',2)->first();
        $data->delete();

        $all_fav_data = MyFavorite::where('entity_type',2)->where('entity_id',$input['event_id'])->get();
              $count = count($all_fav_data);

        return ['status' => 1, 'count' => $count];
    }

    //I am attending section
    public function iAmAttending(Request $request){
        $input = $request->input();

        $data = IAmAttending::where('user_id',Auth::user()->user_id)->where('entity_id',$input['event_id'])->where('entity_type',2)->where('status',1)->first();

        if(!empty($data)){

            return ['status' => 2,'msg' => 'You have already added this business'];
        }
        else{

            IAmAttending::create([
                'user_id' => Auth::user()->user_id,
                'entity_id' => $input['event_id'],
                'entity_type' => 2,
                'status' => 1,
            ]);

            return ['status' => 1, 'msg'=>'Thank you for adding'];

        }

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
                                    ]); 
    }
}
