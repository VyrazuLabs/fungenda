<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use App\Models\Event;
use App\Models\EventOffer;
use App\Models\Address;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use GetLatitudeLongitude;

class EventController extends Controller
{
    public function viewEvent(){
    	return view('frontend.pages.viewevents');
    }
    // view Create event page
    public function viewCreateEvent(){
    	$state_model = new State();
    	$data['all_states'] = $state_model->where('country_id',101)->pluck('name','id');

    	// print_r($all_states);die();
    	return view('frontend.pages.createevent', $data);
    }
    
    // Save Events
    public function saveEvent(Request $request){
    	$input = $request->input();
    	$validation = $this->eventValidation($input);
    	if($validation->fails()){
    		return redirect()->back()->withErrors($validation->errors());
    	}
    	else{
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

	    	$images_string = implode(',',$input['file']);
	    	$event_model = new Event();
	    	$event_offer_model = new EventOffer();
	    	$modified_start_date = date("Y-m-d", strtotime($input['startdate']));
	    	$modified_end_date = date("Y-m-d", strtotime($input['enddate']));

	    	$date1=date_create($modified_end_date);
			$date2=date_create($modified_start_date);
			$diff=date_diff($date2,$date1);

	    	$event = Event::create([
	                      'event_id' =>uniqid(),
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

    // Validation of create-event-form-field
    protected function eventValidation($request){
    	return Validator::make($request,[
                                      	'name' => 'required',
                                      	'category' => 'required',
                                      	'file' => 'required',
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
									    'contactNo' => 'required',
									    'websitelink' => 'required',
									    'fblink' => 'required',
									    'twitterlink' => 'required'

                                    ]); 
    }
}
