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
use App\Models\SharedLocationMyFavorite;

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

    /* Return more shared location page */
    public function moreSharedLocation($id){
        $data = ShareLocation::where('shared_location_id',$id)->first(); 

        $data['images'] = explode(',',$data['file']);

        $data['state_name'] = State::where('id',$data['state'])->first()->name;
        $data['country_name'] = Country::where('id',$data['country'])->first()->name;
        $data['city_name'] = City::where('id',$data['city'])->first()->name;

        return view('frontend.pages.more-shared-location',compact('data'));
    }

    /* Add to favorite */
    public function addToFavorite(Request $request){
        $input = $request->input();
        // echo $input['id'];
        
        if(Auth::User()){
            $data = SharedLocationMyFavorite::where('user_id',Auth::user()->user_id)->where('shared_location_id',$input['id'])->first();

            if(empty($data)){
                SharedLocationMyFavorite::create([
                        'shared_location_id' => $input['id'],
                        'user_id' => Auth::user()->user_id,
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

    /* Remove from favorite */
    public function removeFromFavorite(Request $request){
        $input = $request->input();
        // echo $input['id'];
        $data = SharedLocationMyFavorite::where('user_id',Auth::user()->user_id)->where('shared_location_id',$input['id'])->first();
        $data->delete();

        return ['status' => 1];
    }

    //function for search-searchfor
    public function searchfor(Request $request){
        $input = $request->input();
        // echo $input['data'];
        
        $all_search_events = ShareLocation::where('location_name','like','%'.$input['data'].'%')->where('status',1)->get();
        // print_r($all_search_events);die;
        foreach ($all_search_events as $search_event) {
               $city = City::where('id',$search_event['city'])->first()->name;
               $state = State::where('id',$search_event['state'])->first()->name;
               $country = Country::where('id',$search_event['country'])->first()->name;
               $search_event['city'] = $city;        
               $search_event['state'] = $state; 
               $search_event['country'] = $country;       
        }
        // print_r($all_search_events);die;
        return $all_search_events;
        
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
