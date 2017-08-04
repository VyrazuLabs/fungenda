<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Event;
use App\Models\EventOffer;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use GetLatitudeLongitude;
use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::paginate(4);
        // echo "<pre>";
        // print_r($data);die();
        foreach ($data as $value) {
            $value['image'] = explode(',',$value['event_image']);
            $value['start_date'] = explode(' ', $value['event_start_date']);
            $value['end_date'] = explode(' ',$value['event_end_date']);
            $value['discountRate'] = $value->getEventOffer()->first()['discount_rate'];
            $value['discountType'] = $value->getEventOffer()->first()['discount_types'];
            $value['offerDescription'] = $value->getEventOffer()->first()['offer_description'];
            $value['address_array'] = $value->getAddress()->first();
            $value['city'] = $value['address_array']->getCity()->first()->name;
            $value['state'] = $value['address_array']->getState()->first()->name;
        }
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
        $data['all_states'] = $state_model->where('country_id',101)->pluck('name','id');
        $data['all_category'] = Category::pluck('name','category_id');

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
                              'user_id' => uniqid(),
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
            Session::flash('success', "Event successfully inserted.");
            return redirect()->back();
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
    public function edit()
    {
        return view('admin.event.edit-event');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
