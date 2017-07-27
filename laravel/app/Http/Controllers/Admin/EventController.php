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
        foreach ($data as $value) {
            $value['image'] = explode(',',$value['event_image']);
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
