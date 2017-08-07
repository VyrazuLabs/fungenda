<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\State;
use App\Models\City;
use App\Models\BusinessOffer;
use App\Models\Address;
use App\Models\Category;
use Auth;
use Validator;
use Session;
use Illuminate\Support\Facades\Input;
use GetLatitudeLongitude;


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
        $data['all_states'] = $state_model->where('country_id',101)->pluck('name','id');
        $data['all_category'] = Category::pluck('name','category_id');
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
            return redirect()->back()->withErrors($validation->errors());
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
                          'location' => $address['address_id'],
                          'venue' => $input['venue'],
                          'category_id' => $input['category'],
                          'business_image' => $images_string,
                        ]);


            BusinessOffer::create([
                          'business_offer_id' => uniqid(),
                          'business_id' => $business['business_id'],
                              ]);
             Session::flash('success', "Business create successfully.");
            return redirect('/business');
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
                                        'city' => 'required',
                                        'state' => 'required',
                                        'zipcode' => 'required', 
                                        'latitude'=> 'required',
                                        'longitude' => 'required',  
                                    ]); 
    }
}
