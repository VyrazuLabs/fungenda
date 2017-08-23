<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    	$data['all_states'] = $state_model->where('country_id',101)->pluck('name','id');
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
	    	$city_model = new City();
	    	$state_model = new State();

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

         	AssociateTag::create([
                    'user_id' => Auth::User()->user_id,
                    'entity_id' => $event['event_id'],
                    'entity_type' => 2,
                    'tags_id' => serialize($input['tags']),
                ]);
        	Session::flash('success', "Event created successfully.");
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
        $data = MyFavorite::where('user_id',Auth::user()->user_id)->where('entity_id',$input['event_id'])->where('entity_type',2)->first();
        $data->status = 0;
        $data->save();
        return ['status' => 1];
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
