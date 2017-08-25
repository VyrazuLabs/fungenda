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

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Business::paginate(4);
        foreach ($data as $value) {
            $value['image'] = explode(',',$value['business_image']);
        }
        // echo "<pre>";
        // print_r($value);die();
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
        $data['all_category'] = Category::pluck('name','category_id');
        $data['all_tag'] = Tag::pluck('tag_name','tag_id');
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
        $validation = $this->businessValidation($input);
        if($validation->fails()){
          Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
            $city_model = new City();
            $state_model = new State();

            foreach($all_files as $files){
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = "business_".uniqid().".".$extension;
                    $destinationPath = public_path().'/images/business/';
                    $file->move($destinationPath, $picture);

                    //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                    $new_images[] = $picture;
                }
            }

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

            $images_string = implode(',',$new_images);
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
                          'created_by' => Auth::User()->user_id,
                          'updated_by' => Auth::User()->user_id,
                          'category_id' => $input['category'],
                          'business_image' => $images_string,
                          ]);

            BusinessOffer::create([
                          'business_offer_id' => uniqid(),
                          'business_id' => $business['business_id'],
                          'business_discount_rate' => $input['businessdiscount'],
                          'business_discount_types' => $input['checkbox'],
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

            Session::flash('success', "Business create successfully.");
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
    public function edit()
    {
        return view('admin.business.edit-business');
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
                                      'costbusiness' => 'required',
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
                                      'websitelink' => 'required',
                                      'email' => 'required|email',
                                      'fblink' => 'required',
                                      'twitterlink' => 'required' 
                                    ]); 
    }
}
