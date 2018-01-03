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
use Mail;

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
      
        foreach ($all_files as $key => $image){ 
            foreach ($image as $k => $value) {
            $data[$key] = $value;
            $imageValidation = $this->imageValidator($data);
            }
        }
        
        $validation = $this->validator($input);

        if($validation->fails() || $imageValidation->fails()){
            $validationMessages = array_merge_recursive($validation->messages()->toArray(), $imageValidation->messages()->toArray());
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validationMessages)->withInput();
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

            if(Auth::user()){
                $user_id = Auth::user()->user_id;
            }
            else{
                 $user_id = 123;
            }

            ShareLocation::create([
                'user_id' => $user_id,
                'shared_location_id' => uniqid(), 
                'location_name' => $input['location_name'],
                'status' => $input['radio'],
                'description' => $input['description'],
                'country' => 231,
                'state' => $input['state'],
                'state_name' => State::where('id',$input['state'])->first()->name,
                'city' => $input['city'],
                'city_name' => City::where('id',$input['city'])->first()->name,
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
        // echo $id;
        $data['location_data'] = ShareLocation::where('shared_location_id',$id)->first(); 
        if(empty($data['location_data'])){
            Session::flash('error', "Not a valid Shared location");
            return redirect('/');
        }
        else {
          $data['all_country'] = Country::pluck('name','id');
          $data['all_states'] = State::where('country_id',231)->pluck('name', 'id');
          $state = $data['location_data']['state'];
          $image_string = $data['location_data']['file'];
          $image_array = explode(',', $image_string); 
          $data['location_data']['images'] = $image_array;
          $data['location_data']['respected_city'] = City::where('state_id',$state)->pluck('name','id');
          // echo $data['location_data']['respected_city'];die;
          return view('frontend.pages.create-sharelocation',$data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $input = $request->input();
      $all_files = $request->file();
      $validation = $this->validator($input);
      if($validation->fails()){
        Session::flash('error', "Field is missing");
        return redirect()->back()->withErrors($validation->errors())->withInput();
      }
      else{
        $shared_location = ShareLocation::where('shared_location_id',$input['id'])->first();

        $image_already_exist = $shared_location['file'];
        $image_already_exist_array = explode(',', $image_already_exist);
        // print_r($image_already_exist_array);die;

        if(!empty($all_files)){
          foreach($all_files as $files){
            foreach ($files as $file) {
              $filename = $file->getClientOriginalName();
              $extension = $file->getClientOriginalExtension();
              $picture = "business_".uniqid().".".$extension;
              $destinationPath = public_path().'/images/share_location/';
              $file->move($destinationPath, $picture);

              //STORE NEW IMAGES IN THE ARRAY VARAIBLE
              $new_images[] = $picture;
              $images_string = implode(',',$new_images);
            }
          }
          if($image_already_exist_array[0] != ''){
            $all_image_final = implode(',',array_merge($new_images,$image_already_exist_array));
          }
          else{
            $all_image_final = implode(',',$new_images);
          }

        }
        else{
          $all_image_final = $image_already_exist;
        }
      } 

      $shared_location->update([
        'location_name' => $input['location_name'],
        'status' => $input['radio'],
        'description' => $input['description'],
        'country' => 231,
        'state' => $input['state'],
        'state_name' => State::where('id',$input['state'])->first()->name,
        'city' => $input['city'],
        'city_name' => City::where('id',$input['city'])->first()->name,
        'file' => $all_image_final
      ]);

      Session::flash('success','Location updated successfully');
      return redirect()->back();
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
        $data['all_states'] = State::where('country_id',231)->pluck('name', 'id');
        return view('frontend.pages.create-sharelocation',$data);
    }
    /* Return view of shared location public form */
    public function shareLocationFormPublic() {
        $data['all_country'] = Country::pluck('name','id');
        return view('frontend.pages.create-sharelocation-public',$data);
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
        if(empty($data)){
            Session::flash('error', "Not a valid Shared location");
            return redirect('/');
        }
        else{
            $data['images'] = explode(',',$data['file']);

            $data['state_name'] = State::where('id',$data['state'])->first()->name;
            $data['country_name'] = Country::where('id',$data['country'])->first()->name;
            $data['city_name'] = City::where('id',$data['city'])->first()->name;

            return view('frontend.pages.more-shared-location',compact('data'));
        }
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

            $data = ShareLocation::where('shared_location_id',$input['id'])->first();

            $email = Auth::user()->email;
            $first_name = Auth::user()->first_name;
            $last_name = Auth::user()->last_name;

            Mail::send('email.add_to_favourite_shared_location_email',['name' => 'Efungenda','first_name'=>$first_name,'last_name'=>$last_name,'share_location'=>$data],function($message) use($email,$first_name){
              $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Add to favorite Successfull');
            });

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

        $email = Auth::user()->email;
        $first_name = Auth::user()->first_name;

        $data = ShareLocation::where('shared_location_id',$input['id'])->first();

        Mail::send('email.remove_from_favourite_shared_location_email',['name' => 'Efungenda','first_name'=>$first_name,'share_location'=>$data],function($message) use($email,$first_name){
          $message->from('vyrazulabs@gmail.com', $name = null)->to($email,$first_name)->subject('Remove from favorite Successfull');
        });

        return ['status' => 1];
    }

    /* Function for search-searchfor */
    public function searchfor(Request $request){
        $input = $request->input();
        // print_r($input);die;
        if($input['search_hidden'] == 'public'){
            $all_search_events = ShareLocation::where('status',1)->where('location_name','like','%'.$input['data'].'%')->where('status',1)->get();
        }
        if($input['search_hidden'] == 'private'){
            $all_search_events = ShareLocation::where('status',2)->where('user_id',Auth::user()->user_id)->where('location_name','like','%'.$input['data'].'%')->where('status',2)->get();
        }

        foreach ($all_search_events as $search_event) {
               $city = City::where('id',$search_event['city'])->first()->name;
               $state = State::where('id',$search_event['state'])->first()->name;
               $country = Country::where('id',$search_event['country'])->first()->name;
               $search_event['city'] = $city;        
               $search_event['state'] = $state; 
               $search_event['country'] = $country;
               $search_event['location_name_first'] = explode(',',$search_event['location_name'])[0];   
        }
        // print_r($all_search_events);die;
        return $all_search_events;
        
    }

    /* Function for search-state */
    public function stateSearch(Request $request){
        $input = $request->input();
        // print_r($input);die;

         if($input['search_hidden'] == 'public'){
             $all_search_events = ShareLocation::where('state_name','like','%'.$input['data'].'%')->where('status',1)->get();
        }
        if($input['search_hidden'] == 'private'){
             $all_search_events = ShareLocation::where('state_name','like','%'.$input['data'].'%')->where('user_id',Auth::user()->user_id)->where('status',2)->get();
        }

         foreach ($all_search_events as $search_event) {
               $city = City::where('id',$search_event['city'])->first()->name;
               $state = State::where('id',$search_event['state'])->first()->name;
               $country = Country::where('id',$search_event['country'])->first()->name;
               $search_event['city'] = $city;        
               $search_event['state'] = $state; 
               $search_event['country'] = $country;  
               $search_event['location_name_first'] = explode(',',$search_event['location_name'])[0];     
        }
        return $all_search_events;
    }

    //function for search-city
    public function city(Request $request){
        $input = $request->input();

        if($input['search_hidden'] == 'public'){
            $all_search_events = ShareLocation::where('city_name','like','%'.$input['data'].'%')->where('status',1)->get();
        }
        if($input['search_hidden'] == 'private'){
            $all_search_events = ShareLocation::where('city_name','like','%'.$input['data'].'%')->where('user_id',Auth::user()->user_id)->where('status',2)->get();
        }

        foreach ($all_search_events as $search_event) {
               $city = City::where('id',$search_event['city'])->first()->name;
               $state = State::where('id',$search_event['state'])->first()->name;
               $country = Country::where('id',$search_event['country'])->first()->name;
               $search_event['city'] = $city;        
               $search_event['state'] = $state; 
               $search_event['country'] = $country;
               $search_event['location_name_first'] = explode(',',$search_event['location_name'])[0];       
        }
        return $all_search_events;
    }


    // Delete image
    public function deleteImage($id,$name){
        // echo $name;die();
      $shared_location = ShareLocation::where('shared_location_id',$id)->first();
      $all_image = ShareLocation::where('shared_location_id',$id)->first()->file;
      $all_image_array = explode(',', $all_image);
      $new_image_array = [];
      $new_image_string = null;

      foreach ($all_image_array as $value) {
        if($value != $name){
          $new_image_array[] = $value;
        }
      }
      // echo "<pre>";print_r($new_image_array);die();

      if(!empty($new_image_array)){
        $new_image_string = implode(',', $new_image_array);
      }

      $shared_location->update([
          'file' => $new_image_string,
        ]);

      
      return redirect()->back();
    }

    /**
    * Function for deleting Shared location 
    */
    public function delete($id) {
      $data = ShareLocation::where('shared_location_id', $id)->first();
      $data->delete();
      Session::flash('success', "Delete successfully");
      return redirect('/location');
    }

    /* Function for validate shared location form */
    protected function validator($request){
        return Validator::make($request,[
                                    'location_name' => 'required', 
                                    'state' => 'required',
                                    'city' => 'required',       
                                ]); 
    }

    protected function imageValidator($request){
        return Validator::make($request,[  
                                    'file' => 'mimes:jpeg,jpg,png'     
                                ]); 
    }
}
