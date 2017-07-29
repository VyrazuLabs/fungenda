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

class EventController extends Controller
{
    public function viewEvent(){
    	$all_events = Event::paginate(4);
    	foreach ($all_events as $event) {
    		$img = explode(',',$event['event_image']);
    		$event['image'] = $img;
    	}
        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }
    	return view('frontend.pages.viewevents',compact('all_events','all_category'));
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

    	// print_r($all_states);die();
    	return view('frontend.pages.createevent', $data,compact('all_category'));
    }
    
    // Save Events
    public function saveEvent(Request $request){
    	$input = $request->input();
    	$all_files = $request->file();
    	$validation = $this->eventValidation($input);
    	if($validation->fails()){
    		return redirect()->back()->withErrors($validation->errors());
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
	                      'location' => $address['address_id'],
	                      'venue' => $input['venue'],
	                      'category_id' => $input['category'],
	                      'event_image' => $images_string,
	                      'event_start_date' => $modified_start_date,
	                      'event_end_date' => $modified_end_date,
	                      'event_active_days' => $diff->format("%R%a days")
	                    ]);


	    	EventOffer::create([
	    				  'event_offer_id' => uniqid(),
	                      'offer_description' => $input['comment'],
	                      'event_id' => $event['event_id'],
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

    // Getting more event
    public function getMoreEvent(Request $request){
    	$input = $request->input();
    	$data = Event::where('event_id',$input['q'])->first();
    	$data['image'] = explode(',',$data['event_image']);
        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }
    	return view('frontend.pages.moreevent',compact('data','all_category'));
    }

    // Validation of create-event-form-field
    protected function eventValidation($request){
    	return Validator::make($request,[
                                      	'name' => 'required',
                                      	'category' => 'required',
                                      	'costevent' => 'required',
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
                                    ]); 
    }
}
