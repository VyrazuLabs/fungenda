<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\SharedLocationMyFavorite;
use App\Models\ShareLocation;
use App\Models\State;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Validator;

class SharedLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = Category::where('parent', 0)->get();

        foreach ($all_category as $category) {
            $category['sub_category'] = Category::where('parent', $category['category_id'])->pluck('name', 'category_id');
        }

        $shared_locations = ShareLocation::where('status', 1)->get();
        $ar = [];

        foreach ($shared_locations as $value) {
            // print_r($value);die;
            if (!array_key_exists($value->state, $ar)) {
                $ar[$value->state]['state_name'] = $value->getState->name;
            }

            if (!empty($value->city)) {
                if (!array_key_exists($value->city, $ar)) {
                    $ar[$value->state]['cities'][$value->city]['city_name'] = $value->getCity->name;
                }
            } else {
                $ar[$value->state]['cities'][$value->city]['city_name'] = '';

            }

            if (!array_key_exists($value->shared_location_id, $ar)) {
                $ar[$value->state]['cities'][$value->city]['locations'][$value->shared_location_id] = $value->given_name;
            }
        }
        $type = 'public';
        return view('frontend.pages.shared-location', compact('all_category', 'ar', 'type'));
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
        $validation = $this->validator($input);

        // if(!empty($all_files)) {
        //   foreach ($all_files as $key => $image){
        //     foreach ($image as $k => $value) {
        //     $data[$key] = $value;
        //     $imageValidation = $this->imageValidator($data);
        //     }
        //   }
        // }
        // if($validation->fails() || $imageValidation->fails()){
        //     $validationMessages = array_merge_recursive($validation->messages()->toArray(), $imageValidation->messages()->toArray());
        //     Session::flash('error', "Field is missing");
        //     return redirect()->back()->withErrors($validationMessages)->withInput();
        // }
        // else{
        //     if(!empty($all_files)){
        //         foreach($all_files as $files){
        //             foreach ($files as $file) {
        //               $filename = $file->getClientOriginalName();
        //               $extension = $file->getClientOriginalExtension();
        //               $picture = "shared_location_".uniqid().".".$extension;
        //               $destinationPath = public_path().'/images/share_location/';
        //               $file->move($destinationPath, $picture);

        //               //STORE NEW IMAGES IN THE ARRAY VARAIBLE
        //               $new_images[] = $picture;
        //               $images_string = implode(',',$new_images);
        //             }
        //         }
        //     }
        //     else{
        //       $images_string = '';
        //     }

        if (Auth::user()) {
            $user_id = Auth::user()->user_id;
        } else {
            $user_id = '';
        }

        if (isset($input['city'])) {
            Session::put('city_id', $input['city']);
            $cityId = $input['city'];
            $cityName = City::where('id', $input['city'])->first()->name;
        } else {
            $cityId = '';
            $cityName = '';
        }

        if (isset($input['location_data'])) {
            Session::put('locationData', $input['location_data']);
        }

        if ($validation->fails()) {
            Session::flash('error', "please fill the form properly");
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            // print_r($request->file('file'));die;

            /* code for image uploading */
            // if ($request->hasFile('file')) {
            if (!empty($request->hasFile('file')) {
                echo "has file";die;

                $files = $request->file('file');
                $input_data = $request->all();
                $imageValidation = Validator::make(
                    $input_data, ['file.*' => 'required|mimes:jpg,jpeg,png|max:10240'], [
                        'file.*.required' => 'Please upload an image',
                        'file.*.mimes' => 'Only jpeg,png images are allowed']);
                if ($imageValidation->fails()) {
                    Session::flash('error', 'Only jpeg,png images are allowed. Image size should not be greater than 10 MB');
                    return Redirect()->back()->withErrors($imageValidation)->withInput();
                } else {
                    $shareLocation = ShareLocation::create([
                        'user_id' => $user_id,
                        'shared_location_id' => uniqid(),
                        'given_name' => $input['given_name'],
                        'location_name' => $input['location_name'],
                        'status' => $input['radio'],
                        'description' => $input['description'],
                        'country' => 231,
                        'state' => $input['state'],
                        'state_name' => State::where('id', $input['state'])->first()->name,
                        'city' => $cityId,
                        'city_name' => $cityName,
                    ]);

                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $picture = "shared_location_" . uniqid() . "." . $extension;
                        $destinationPath = public_path() . '/images/share_location/';
                        $file->move($destinationPath, $picture); //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                        $new_images[] = $picture; // UNSERIALIZE EXISTING IMAGES
                    }
                    $shareLocation->update(['file' => implode(',', $new_images)]);
                }
            } else {
                echo "no file";die;

                ShareLocation::create([
                    'user_id' => $user_id,
                    'shared_location_id' => uniqid(),
                    'given_name' => $input['given_name'],
                    'location_name' => $input['location_name'],
                    'status' => $input['radio'],
                    'description' => $input['description'],
                    'country' => 231,
                    'state' => $input['state'],
                    'state_name' => State::where('id', $input['state'])->first()->name,
                    'city' => $cityId,
                    'city_name' => $cityName,
                ]);
            }
            Session::flash('success', "Location shared successfully");
        }
        return redirect()->back();
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
        $data['location_data'] = ShareLocation::where('shared_location_id', $id)->first();
        if (empty($data['location_data'])) {
            Session::flash('error', "Not a valid Shared location");
            return redirect('/');
        } else {
            $data['all_country'] = Country::pluck('name', 'id');
            $data['all_states'] = State::where('country_id', 231)->pluck('name', 'id');
            $state = $data['location_data']['state'];
            $image_string = $data['location_data']['file'];
            $image_array = explode(',', $image_string);
            $data['location_data']['images'] = $image_array;
            $data['location_data']['respected_state'] = State::where('country_id', 231)->pluck('name', 'id');
            $data['location_data']['respected_city'] = City::where('state_id', $state)->pluck('name', 'id');
            // echo $data['location_data']['respected_city'];die;
            // echo "<pre>";print_r($data);die;
            return view('frontend.pages.create-sharelocation', $data);
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

        if (isset($input['city'])) {
            Session::put('city_id', $input['city']);
            $cityId = $input['city'];
            $cityName = City::where('id', $input['city'])->first()->name;
        } else {
            $cityId = '';
            $cityName = '';

        }

        $validation = $this->validator($input);
        if ($validation->fails()) {
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation->errors())->withInput();
        } else {
            $shared_location = ShareLocation::where('shared_location_id', $input['id'])->first();

            $image_already_exist = $shared_location['file'];
            $image_already_exist_array = explode(',', $image_already_exist);
            // print_r($image_already_exist_array);die;
            $input_data = $request->all();
            $imageValidation = Validator::make(
                $input_data, ['file.*' => 'required|mimes:jpg,jpeg,png|max:10240'], [
                    'file.*.required' => 'Please upload an image',
                    'file.*.mimes' => 'Only jpeg,png images are allowed']);
            if ($imageValidation->fails()) {
                Session::flash('error', 'Only jpeg,png images are allowed. Image size should not be greater than 10 MB');
                return Redirect()->back()->withErrors($imageValidation)->withInput();
            }

            if (!empty($all_files)) {
                foreach ($all_files as $files) {
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $picture = "business_" . uniqid() . "." . $extension;
                        $destinationPath = public_path() . '/images/share_location/';
                        $file->move($destinationPath, $picture);

                        //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                        $new_images[] = $picture;
                        $images_string = implode(',', $new_images);
                    }
                }
                if ($image_already_exist_array[0] != '') {
                    $all_image_final = implode(',', array_merge($new_images, $image_already_exist_array));
                } else {
                    $all_image_final = implode(',', $new_images);
                }

            } else {
                $all_image_final = $image_already_exist;
            }
        }

        $shared_location->update([
            'given_name' => $input['given_name'],
            'location_name' => $input['location_name'],
            'status' => $input['radio'],
            'description' => $input['description'],
            'country' => 231,
            'state' => $input['state'],
            'state_name' => State::where('id', $input['state'])->first()->name,
            'city' => $cityId,
            'city_name' => $cityName,
            'file' => $all_image_final,
        ]);

        Session::flash('success', 'Location updated successfully');
        return redirect()->route('frontend_more_shared_location', ['id' => $input['id']]);
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
    public function shareLocationForm()
    {
        $data['all_country'] = Country::pluck('name', 'id');
        $data['all_states'] = State::where('country_id', 231)->pluck('name', 'id');
        return view('frontend.pages.create-sharelocation', $data);
    }

    public function getStateName(Request $request)
    {
        $input = Input::all();
        $getState = [];

        if (!empty($input['state_name'])) {
            $getState = State::where('name', 'LIKE', '%' . $input['state_name'] . '%')->get();
        }
        return $getState;
    }

    /* Return view of shared location public form */
    public function shareLocationFormPublic()
    {
        $data['all_country'] = Country::pluck('name', 'id');
        return view('frontend.pages.create-sharelocation-public', $data);
    }

    /* Function for fetch privately saved share locations */
    public function privatelySavedFetch(Request $request)
    {
        // echo Auth::User();
        if (empty(Auth::User())) {
            Session::flash('error', 'You have to login first');
            return redirect()->back();
        } else {

            $all_category = Category::where('parent', 0)->get();

            foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent', $category['category_id'])->pluck('name', 'category_id');
            }

            $shared_locations = ShareLocation::where('status', 2)->where('user_id', Auth::user()->user_id)->get();
            $ar = [];

            foreach ($shared_locations as $value) {
                if (!array_key_exists($value->state, $ar)) {
                    $ar[$value->state]['state_name'] = $value->getState->name;
                }

                if (!empty($value->city)) {
                    if (!array_key_exists($value->city, $ar)) {
                        $ar[$value->state]['cities'][$value->city]['city_name'] = $value->getCity->name;
                    }
                } else {
                    $ar[$value->state]['cities'][$value->city]['city_name'] = '';

                }

                if (!array_key_exists($value->shared_location_id, $ar)) {
                    $ar[$value->state]['cities'][$value->city]['locations'][$value->shared_location_id] = $value->given_name;
                }
            }
            $type = 'private';
            // echo "<pre>";print_r($ar);die;
            return view('frontend.pages.shared-location', compact('all_category', 'ar', 'type'));

        }
    }

    /* Return more shared location page */
    public function moreSharedLocation($id)
    {
        $data = ShareLocation::where('shared_location_id', $id)->first();
        if (empty($data)) {
            Session::flash('error', "Not a valid Shared location");
            return redirect('/');
        } else {
            $data['images'] = explode(',', $data['file']);

            $data['state_name'] = State::where('id', $data['state'])->first()->name;
            $data['country_name'] = Country::where('id', $data['country'])->first()->name;

            $getCityName = City::where('id', $data['city'])->first();
            if (!empty($getCityName)) {
                $data['city_name'] = $getCityName->name;
            } else {
                $data['city_name'] = '';
            }

            return view('frontend.pages.more-shared-location', compact('data'));
        }
    }

    /* Add to favorite */
    public function addToFavorite(Request $request)
    {
        $input = $request->input();
        // echo $input['id'];

        if (Auth::User()) {
            $data = SharedLocationMyFavorite::where('user_id', Auth::user()->user_id)->where('shared_location_id', $input['id'])->first();

            if (empty($data)) {
                SharedLocationMyFavorite::create([
                    'shared_location_id' => $input['id'],
                    'user_id' => Auth::user()->user_id,
                    'status' => 1,
                ]);

                $data = ShareLocation::where('shared_location_id', $input['id'])->first();

                $email = Auth::user()->email;
                $first_name = Auth::user()->first_name;
                $last_name = Auth::user()->last_name;

                Mail::send('email.add_to_favourite_shared_location_email', ['name' => 'Efungenda', 'first_name' => $first_name, 'last_name' => $last_name, 'share_location' => $data], function ($message) use ($email, $first_name) {
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Add to favorite Successfull');
                });

                return ['status' => 1];
            } else {
                $data->status = 1;
                $data->save();
            }
        } else {
            return ['status' => 2];
        }

    }

    /* Remove from favorite */
    public function removeFromFavorite(Request $request)
    {
        $input = $request->input();
        // echo $input['id'];
        $data = SharedLocationMyFavorite::where('user_id', Auth::user()->user_id)->where('shared_location_id', $input['id'])->first();

        $data->delete();

        $email = Auth::user()->email;
        $first_name = Auth::user()->first_name;

        $data = ShareLocation::where('shared_location_id', $input['id'])->first();

        Mail::send('email.remove_from_favourite_shared_location_email', ['name' => 'Efungenda', 'first_name' => $first_name, 'share_location' => $data], function ($message) use ($email, $first_name) {
            $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Remove from favorite Successfull');
        });

        return ['status' => 1];
    }

    /* Function for search-searchfor */
    public function searchfor(Request $request)
    {
        $input = $request->input();
        // print_r($input);die;
        if ($input['search_hidden'] == 'public') {
            $all_search_events = ShareLocation::where('status', 1)->where('given_name', 'like', '%' . $input['data'] . '%')->where('status', 1)->get();
        }
        if ($input['search_hidden'] == 'private') {
            $all_search_events = ShareLocation::where('status', 2)->where('user_id', Auth::user()->user_id)->where('given_name', 'like', '%' . $input['data'] . '%')->where('status', 2)->get();
        }

        $ar = [];

        foreach ($all_search_events as $value) {
            if (!array_key_exists($value->state, $ar)) {
                $ar[$value->state]['state_name'] = $value->getState->name;
            }

            if (!array_key_exists($value->city, $ar)) {
                $ar[$value->state]['cities'][$value->city]['city_name'] = $value->getCity->name;
            }

            if (!array_key_exists($value->shared_location_id, $ar)) {
                $ar[$value->state]['cities'][$value->city]['locations'][$value->shared_location_id] = $value->given_name;
            }
        }
        // print_r($ar);die;
        return $ar;

    }

    /* Function for search-state */
    public function stateSearch(Request $request)
    {
        $input = $request->input();
        // print_r($input);die;

        if ($input['search_hidden'] == 'public') {
            $all_search_events = ShareLocation::where('state_name', 'like', '%' . $input['data'] . '%')->where('status', 1)->get();
        }
        if ($input['search_hidden'] == 'private') {
            $all_search_events = ShareLocation::where('state_name', 'like', '%' . $input['data'] . '%')->where('status', 2)->where('user_id', Auth::user()->user_id)->get();
        }

        $ar = [];

        foreach ($all_search_events as $value) {
            if (!array_key_exists($value->state, $ar)) {
                $ar[$value->state]['state_name'] = $value->getState->name;
            }

            if (!array_key_exists($value->city, $ar)) {
                $ar[$value->state]['cities'][$value->city]['city_name'] = $value->getCity->name;
            }

            if (!array_key_exists($value->shared_location_id, $ar)) {
                $ar[$value->state]['cities'][$value->city]['locations'][$value->shared_location_id] = $value->given_name;
            }
        }
        // print_r($ar);die;
        return $ar;
        // return $all_search_events;
    }

    //function for search-city
    public function city(Request $request)
    {
        $input = $request->input();
        // print_r($input);die;

        if ($input['search_hidden'] == 'public') {
            $all_search_events = ShareLocation::where('city_name', 'like', '%' . $input['data'] . '%')->where('status', 1)->get();
        }
        if ($input['search_hidden'] == 'private') {
            $all_search_events = ShareLocation::where('city_name', 'like', '%' . $input['data'] . '%')->where('user_id', Auth::user()->user_id)->where('status', 2)->get();
        }

        $ar = [];

        foreach ($all_search_events as $value) {
            if (!array_key_exists($value->state, $ar)) {
                $ar[$value->state]['state_name'] = $value->getState->name;
            }

            if (!array_key_exists($value->city, $ar)) {
                $ar[$value->state]['cities'][$value->city]['city_name'] = $value->getCity->name;
            }

            if (!array_key_exists($value->shared_location_id, $ar)) {
                $ar[$value->state]['cities'][$value->city]['locations'][$value->shared_location_id] = $value->given_name;
            }
        }
        // print_r($ar);die;

        return $ar;
    }

    // Delete image
    public function deleteImage($id, $name)
    {
        // echo $name;die();
        $shared_location = ShareLocation::where('shared_location_id', $id)->first();
        $all_image = ShareLocation::where('shared_location_id', $id)->first()->file;
        $all_image_array = explode(',', $all_image);
        $new_image_array = [];
        $new_image_string = null;

        foreach ($all_image_array as $value) {
            if ($value != $name) {
                $new_image_array[] = $value;
            }
        }
        // echo "<pre>";print_r($new_image_array);die();

        if (!empty($new_image_array)) {
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
    public function delete($id)
    {
        $data = ShareLocation::where('shared_location_id', $id)->first();
        $data->delete();

        $favorite_data = SharedLocationMyFavorite::where('shared_location_id', $id)->get();

        $favorite_data_array = $favorite_data->toArray();

        if (count($favorite_data_array) > 0) {
            foreach ($favorite_data as $key => $favorite) {
                $favorite->delete();
            }
        }

        Session::flash('success', "Delete successfully");
        return redirect('/location');
    }

    /* Delete from Members home page */
    public function memberDelete($id)
    {
        $data = ShareLocation::where('shared_location_id', $id)->first();
        $data->delete();

        $favorite_data = SharedLocationMyFavorite::where('shared_location_id', $id)->get();

        $favorite_data_array = $favorite_data->toArray();

        if (count($favorite_data_array) > 0) {
            foreach ($favorite_data as $key => $favorite) {
                $favorite->delete();
            }
        }

        Session::flash('success', "Delete successfully");
        return redirect('/members-home-page');
    }

    /* Function for validate shared location form */
    protected function validator($request)
    {
        return Validator::make($request, [
            'given_name' => 'required',
            'location_name' => 'required',
            'state' => 'required',
            // 'city' => 'required',
        ]);
    }

    protected function imageValidator($request)
    {
        return Validator::make($request, [
            'file' => 'mimes:jpeg,jpg,png',
        ]);
    }

    public function sharedLocationSearch(Request $request)
    {
        $input = Input::all();
        $search_results = [];

        if ($input['type'] == 'public') {
            $shared_location = ShareLocation::where('status', 1);
            if (!empty($input['term'])) {
                $shared_location = $shared_location->where('given_name', 'like', '%' . $input['term'] . '%');
            }
            if (!empty($input['city_name'])) {
                $shared_location = $shared_location->where('city_name', 'like', '%' . $input['city_name'] . '%');
            }
            if (!empty($input['state_name'])) {
                $shared_location = $shared_location->where('state_name', 'like', '%' . $input['state_name'] . '%');
            }
            $search_results = $shared_location->get();
        }
        if ($input['type'] == 'private') {
            $shared_location = ShareLocation::where('status', 2)->where('user_id', Auth::user()->user_id);
            if (!empty($input['term'])) {
                $shared_location = $shared_location->where('given_name', 'like', '%' . $input['term'] . '%');
            }
            if (!empty($input['city_name'])) {
                $shared_location = $shared_location->where('city_name', 'like', '%' . $input['city_name'] . '%');
            }
            if (!empty($input['state_name'])) {
                $shared_location = $shared_location->where('state_name', 'like', '%' . $input['state_name'] . '%');
            }
            $search_results = $shared_location->get();
        }

        $ar = [];

        if (!empty($search_results)) {
            foreach ($search_results as $value) {
                if (!array_key_exists($value->state, $ar)) {
                    $ar[$value->state]['state_name'] = $value->getState->name;
                }

                if (!empty($value->city)) {
                    if (!array_key_exists($value->city, $ar)) {
                        $ar[$value->state]['cities'][$value->city]['city_name'] = $value->getCity->name;
                    }
                } else {
                    $ar[$value->state]['cities'][$value->city]['city_name'] = '';
                }

                if (!array_key_exists($value->shared_location_id, $ar)) {
                    $ar[$value->state]['cities'][$value->city]['locations'][$value->shared_location_id] = $value->given_name;
                }
            }
        }
        return $ar;

    }
}
