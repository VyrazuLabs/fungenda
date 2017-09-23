<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Address;
use App\Models\State;
use App\Models\Event;
use App\Models\Business;
use App\Models\City;
use App\Models\Country;
use Validator;
use App\Models\ShareLocation;
use Auth;
use Session;

class SharedLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = Category::where('parent',0)->get();

        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }
            // echo "<pre>";
            $all_share_location = ShareLocation::where('status',1)->get();
            foreach ($all_share_location as $value) {
                $value['state_name'] = State::where('id',$value['state'])->first()->name;
                $value['city_name'] = City::where('id',$value['city'])->first()->name;
            }  
            
            $all_all_share_location_last = [];
            for ($i= 0; $i <= count($all_share_location)-1 ; $i++) {
                 $value1 = []; 
                foreach ($all_share_location as $key => $value) {
                    if($all_share_location[$i]['state_name'] == $all_share_location[$key]['state_name']){
                        $value1[] = $all_share_location[$key];
                        $all_all_share_location_last[$all_share_location[$i]['state_name']] = $value1;
                    }
                }
            }   
            // echo "<pre>";
            // print_r($all_all_share_location_last);
            // die;
        return view('frontend.pages.shared-location',compact('all_category','all_all_share_location_last'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // echo "<pre>";
        // print_r($input);die;
        $validation = $this->validator($input);

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
                      $picture = "shared_location_".uniqid().".".$extension;
                      $destinationPath = public_path().'/images/share_location/';
                      $file->move($destinationPath, $picture);

                      //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                      $new_images[] = $picture;
                      $images_string = implode(',',$new_images);
                    }
                }
            }
            else{    
              $images_string = '';
            }

            ShareLocation::create([
                'user_id' => Auth::user()->user_id,
                'shared_location_id' => uniqid(), 
                'location_name' => $input['location_name'],
                'status' => $input['radio'],
                'description' => $input['description'],
                'country' => $input['country'],
                'state' => $input['state'],
                'city' => $input['city'],
                'file' => $images_string
            ]);

            Session::flash('success', "Location shared successfully");
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
    public function edit($id)
    {
        //
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
    /* Return view of shared location form */ 
    public function shareLocationForm(){
        $data['all_country'] = Country::pluck('name','id');
        return view('frontend.pages.create-sharelocation',$data);
    }

    /* Function for fetch privately saved share locations */
    public function privatelySavedFetch(Request $request){
        // echo Auth::User();
        if(empty(Auth::User())){
            Session::flash('error','You have to login first');
            return redirect()->back();
        }
        else{
            
            $all_category = Category::where('parent',0)->get();

            foreach ($all_category as $category) {
                    $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                }
                // echo "<pre>";
                $all_share_location = ShareLocation::where('user_id',Auth::User()->user_id)->where('status',2)->get();
                foreach ($all_share_location as $value) {
                    $value['state_name'] = State::where('id',$value['state'])->first()->name;
                    $value['city_name'] = City::where('id',$value['city'])->first()->name;
                }  
                
                $all_all_share_location_last = [];
                for ($i= 0; $i <= count($all_share_location)-1 ; $i++) {
                     $value1 = []; 
                    foreach ($all_share_location as $key => $value) {
                        if($all_share_location[$i]['state_name'] == $all_share_location[$key]['state_name']){
                            $value1[] = $all_share_location[$key];
                            $all_all_share_location_user_last[$all_share_location[$i]['state_name']] = $value1;
                        }
                    }
                }   
                // echo "<pre>";
                // print_r($all_all_share_location_last);
                // die;
            return view('frontend.pages.shared-location',compact('all_category','all_all_share_location_user_last'));

        }
    }

    //function for search-searchfor
    public function searchfor(Request $request){
        $input = $request->input();
        // echo $input['data'];
        
        $all_search_events = Event::where('event_title','like','%'.$input['data'].'%')->get();
        foreach ($all_search_events as $search_event) {
            foreach ($search_event as $event) {
               $event_address_details = Address::where('address_id',$search_event['event_location'])->first();
               $city = City::where('id',$event_address_details['city_id'])->first()->name;
               $state = State::where('id',$event_address_details['state_id'])->first()->name;
               $country = Country::where('id',$event_address_details['country_id'])->first()->name;
               $search_event['event_address_details'] = $event_address_details;
               $search_event['city'] = $city;        
               $search_event['state'] = $state; 
               $search_event['country'] = $country;       
            }
        }
        // die;
        $all_search_business = Business::where('business_title','like','%'.$input['data'].'%')->get();
        foreach ($all_search_business as $search_business) {
            foreach ($search_business as $business) {
               $business_address_details = Address::where('address_id',$search_business['business_location'])->first();
               $city = City::where('id',$business_address_details['city_id'])->first()->name;
               $state = State::where('id',$business_address_details['state_id'])->first()->name;
               $country = Country::where('id',$business_address_details['country_id'])->first()->name;
               $search_business['business_address_details'] = $business_address_details;
               $search_business['city'] = $city;        
               $search_business['state'] = $state;
               $search_event['country'] = $country;        
            }
        }
        $all_search_events_array[] = $all_search_events;
        $all_search_business_array[] = $all_search_business; 
        $all_search_result = array_merge($all_search_events_array,$all_search_business_array);
        return $all_search_result;
        
    }

    //function for search-city
    public function city(Request $request){
        $input = $request->input();

        // echo $input['data'];
        // $city_details = City::where('name','like','%'.$input['data'].'%')->get();

        // print_r($city_details);die;

        // foreach ($city_details as $key => $value) {
            
        // }
    }

    /* Function for validate shared location form */
    protected function validator($request){
        return Validator::make($request,[
                                    'location_name' => 'required', 
                                    'country' => 'required',
                                    'state' => 'required',
                                    'city' => 'required',       
                                ]); 
    }
}
