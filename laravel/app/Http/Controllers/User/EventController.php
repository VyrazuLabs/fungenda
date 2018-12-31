<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AssociateTag;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\EmailNotificationSettings;
use App\Models\Event;
use App\Models\EventOffer;
use App\Models\FlagAsInAppropriate;
use App\Models\IAmAttending;
use App\Models\MyFavorite;
use App\Models\RecentlyViewed;
use App\Models\State;
use App\Models\Tag;
use App\Models\User;
use Auth;
use GetLatitudeLongitude;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Validator;

class EventController extends Controller
{

    public function viewEvent()
    {

        $all_events = Event::orderBy('id', 'DESC')->get();
        $current_date = date("Y-m-d");
        $total_events = [];
        $totalEvents = [];

        if (!empty($all_events)) {
            foreach ($all_events as $event) {
                $event_count = count($event->getFavorite()->where('status', 1)->get());
                $event['fav_count'] = $event_count;
                $img = explode(',', $event['event_image']);
                $event['image'] = $img;
                $related_tags = $event->getTags()->where('entity_type', 2)->get();
                $event['tags'] = $related_tags;
                $event_discount = $event->getEventOffer()->first()->discount_types;
                $event['discount'] = $event_discount;
                $event['discount_rate'] = $event->getEventOffer->discount_rate;
                $event['start_dates'] = explode(',', $event['event_start_date']);

                if (!empty($event['start_dates'])) {
                    foreach ($event['start_dates'] as $key => $start_date) {
                        /*  check wheather the date has passed away or not
                         * and set status
                         */
                        if ($start_date >= $current_date) {
                            $event['show_event_status'] = 1; // within date range
                        } else {
                            $event['show_event_status'] = 0; // date passed away
                        }
                    }
                }

            }

            /* make an array of upcoming events */
            foreach ($all_events as $get_event) {
                if ($get_event['show_event_status'] == 1) {
                    $total_events[] = $get_event;
                }
            }

            $totalEvents = $total_events;

            // Custom pagination //
            //Get current page form url e.g. &page=6
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            //Create a new Laravel collection from the array data
            $collection = new Collection($total_events);

            //Define how many items we want to be visible in each page
            $perPage = 4;

            //Slice the collection to get the items to display in current page
            $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

            //Create our paginator and pass it to the view
            $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);

            $total_events = $paginatedSearchResults;

            $all_category = Category::where('parent', 0)->get();
            foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent', $category['category_id'])->pluck('name', 'category_id');
            }

            return view('frontend.pages.viewevents', compact('total_events', 'all_category'));
        } else {
            $all_category = Category::where('parent', 0)->get();

            foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent', $category['category_id'])->pluck('name', 'category_id');
            }
            return view('error.nothingFound', compact('all_category'));
        }

    }
    // view Create event page
    public function viewCreateEvent()
    {
        $state_model = new State();

        $data['all_country'] = Country::pluck('name', 'id');
        $data['all_states'] = State::where('country_id', 231)->pluck('name', 'id');
        $data['all_category1'] = Category::where('category_status', 1)->pluck('name', 'category_id');
        $all_category = Category::where('category_status', 1)->where('parent', 0)->get();

        foreach ($all_category as $category) {
            $category['sub_category'] = Category::where('category_status', 1)->where('parent', $category['category_id'])->pluck('name', 'category_id');
        }

        $all_tag = Tag::where('status', 1)->pluck('tag_name', 'tag_id');

        return view('frontend.pages.createevent', $data, compact('all_category', 'all_tag'));
    }

    // Save Events
    public function saveEvent(Request $request)
    {
        $input = $request->input();
        $all_files = $request->file();

        if (isset($input['city'])) {
            Session::put('city_id', $input['city']);
            $cityId = $input['city'];

        } else {
            $cityId = '';

        }

        foreach ($all_files as $key => $image) {
            foreach ($image as $k => $value) {
                $data[$key] = $value;
                $imageValidation = $this->imageValidator($data);
            }
        }

        /* this code is to return the input event date time when validations fails */
        $startDateArray = [];
        $startTimeArray = [];
        $endTimeArray = [];
        $modified_start_date = '';
        $modified_start_time = '';
        $modified_end_time = '';
        $fromDate = '';
        $toDate = '';

        /* make 3 array of all start date, start time and end time */
        foreach ($input as $key => $value) {
            if (substr($key, 0, 8) == 'startdat') {
                $modified_start_date = $value;
                $startDateArray[] = $modified_start_date;
            }
            if (substr($key, 0, 8) == 'starttim') {
                $modified_start_time = $value;
                $startTimeArray[] = $modified_start_time;
            }
            if (substr($key, 0, 6) == 'endtim') {
                $modified_end_time = $value;
                $endTimeArray[] = $modified_end_time;
            }
        }

        $eventDateTimeArray = [];
        $finalArray = [];
        $i = 0;
        foreach ($startDateArray as $key => $value) {
            if (!empty($value)) {
                $eventDateTimeArray[$key]['startdate'] = $value;
                foreach ($startTimeArray as $key1 => $value1) {
                    if ($key == $key1) {
                        $eventDateTimeArray[$key1]['starttime'] = $value1;
                    }
                }
                foreach ($endTimeArray as $key2 => $value2) {
                    if ($key == $key2) {
                        $eventDateTimeArray[$key2]['endtime'] = $value2;
                    }
                }
            }
        }

        /* if there is any field missing(i.e. start date, start time, end time) remove that particular array element from the whole array */
        foreach ($eventDateTimeArray as $key => $value) {
            if (empty($value['starttime'])) {
                unset($eventDateTimeArray[$key]);
            }
            if (empty($value['endtime'])) {
                unset($eventDateTimeArray[$key]);
            }
        }

        $validation = $this->eventValidation($input);

        if ($validation->fails()) {
            /* store all the date time in session to show in the form */
            Session::put('event_date_time_array', $eventDateTimeArray);
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            foreach ($input as $key => $value) {
                if (substr($key, 0, 8) == 'startdat') {
                    $modified_start_date = date("Y-m-d", strtotime($value));
                    $start_date[] = $modified_start_date;
                }
                if (substr($key, 0, 8) == 'starttim') {
                    $start_time[] = $value;
                }
                if (substr($key, 0, 6) == 'enddat') {
                    $modified_end_date = date("Y-m-d", strtotime($value));
                    $end_date[] = $modified_end_date;
                }
                if (substr($key, 0, 6) == 'endtim') {
                    $end_time[] = $value;
                }
            }

            $start_date_string = implode(',', $start_date);
            $start_time_string = implode(',', $start_time);
            // $end_date_string = implode(',',$end_date);
            $end_time_string = implode(',', $end_time);

            $start_date_array = explode(',', $start_date_string);

            /* Returns the value of the first array element */
            $fromDate = array_shift($start_date_array);
            /* Returns the value of the last element */
            $toDate = array_pop($start_date_array);
            /* when end date is not specified make the start date as end date */
            if (empty($toDate)) {
                $toDate = $fromDate;
            }

            // print_r($toDate);die;

            if (!empty($all_files)) {

                $files = $request->file('file');
                $input_data = $request->all();
                // $imageValidation = Validator::make(
                //     $input_data, ['file.*' => 'required|mimes:jpg,jpeg,png'], [
                //         'file.*.required' => 'Please upload an image',
                //         'file.*.mimes' => 'Only jpg,jpeg,png images are allowed']);

                $imageValidation = Validator::make(
                    $input_data, [
                        'file.*' => 'required|mimes:jpg,jpeg,png|max:10000',
                    ], [
                        'file.*.required' => 'Please upload an image',
                        'file.*.mimes' => 'Only jpeg,png images are allowed',
                        'file.*.max' => 'Sorry! Maximum allowed size for an image is 50kb',
                    ]
                );

                // $mainImageValidation = Validator::make(
                //     $input_data, ['main_file.*' => 'required|mimes:jpg,jpeg,png'], [
                //         'main_file.*.required' => 'Please upload an image',
                //         'main_file.*.mimes' => 'Only jpg,jpeg,png images are allowed']);

                $mainImageValidation = Validator::make(
                    $input_data, [
                        'main_file.*' => 'required|mimes:jpg,jpeg,png|max:10000',
                    ], [
                        'main_file.*.required' => 'Please upload an image',
                        'main_file.*.mimes' => 'Only jpeg,png images are allowed',
                        'main_file.*.max' => 'Sorry! Maximum allowed size for an image is 50kb',
                    ]
                );

                if ($imageValidation->fails() || $mainImageValidation->fails()) {
                    Session::flash('error', 'Only jpeg,png images are allowed');
                    return Redirect()->back()->withErrors($imageValidation)->withInput();
                } else {
                    // foreach ($all_files as $files) {
                    //     foreach ($files as $file) {
                    //         $filename = $file->getClientOriginalName();
                    //         $extension = $file->getClientOriginalExtension();
                    //         $picture = "event_" . uniqid() . "." . $extension;
                    //         $destinationPath = public_path() . '/images/event/';
                    //         $file->move($destinationPath, $picture);

                    //         //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                    //         $new_images[] = $picture;
                    //         $images_string = implode(',', $new_images);
                    //     }
                    // }

                    $images_string = null;
                    if (isset($all_files['file'])) {
                        foreach ($all_files['file'] as $file) {

                            $image = \Image::make($file);
                            $extension = $file->getClientOriginalExtension();
                            // perform orientation using intervention
                            $image->orientate();
                            $imageName = "event_" . uniqid() . "." . $extension;
                            $destinationPath = public_path() . '/images/event/';
                            // save image
                            $image->save($destinationPath . $imageName);

                            // foreach ($files as $file) {
                            // $filename = $file->getClientOriginalName();
                            // $extension = $file->getClientOriginalExtension();
                            // $picture = "event_" . uniqid() . "." . $extension;
                            // $destinationPath = public_path() . '/images/event/';
                            // $file->move($destinationPath, $picture);

                            //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                            $new_images[] = $imageName;
                            $images_string = implode(',', $new_images);
                            // }
                        }
                    }

                    $picture = null;

                    if (isset($all_files['main_file'])) {

                        foreach ($all_files['main_file'] as $file) {
                            // foreach ($files as $file) {
                            // $filename = $file->getClientOriginalName();
                            // $extension = $file->getClientOriginalExtension();
                            // $picture = "event_" . uniqid() . "." . $extension;
                            // $destinationPath = public_path() . '/images/event/';
                            // $file->move($destinationPath, $picture);

                            $image = \Image::make($file);
                            $extension = $file->getClientOriginalExtension();
                            // perform orientation using intervention
                            $image->orientate();
                            $picture = "event_" . uniqid() . "." . $extension;
                            $destinationPath = public_path() . '/images/event/';
                            // save image
                            $image->save($destinationPath . $picture);

                            //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                            // }
                        }
                    }

                }
            } else {

                $images_string = '';
                $picture = '';
            }

            $city_model = new City();
            $state_model = new State();

            $address = Address::create([
                'address_id' => uniqid(),
                'user_id' => Auth::user()->user_id,
                'country_id' => 231,
                'city_id' => $cityId,
                'state_id' => $input['state'],
                'address_1' => $input['address_line_1'],
                'pincode' => $input['zipcode'],
            ]);

            $event_model = new Event();
            $event_offer_model = new EventOffer();

            $event = Event::create([
                'event_id' => uniqid(),
                'event_title' => $input['name'],
                'event_location' => $address['address_id'],
                'event_venue' => $input['venue'],
                'category_id' => $input['category'],
                'event_cost' => $input['costevent'],
                'event_image' => $images_string,
                'event_main_image' => $picture,
                'event_description' => $input['event_description'],
                'event_start_date' => $start_date_string,
                // 'event_end_date' => $end_date_string,
                'event_start_time' => $start_time_string,
                'event_end_time' => $end_time_string,
                // 'event_active_days' => $diff_final,
                'event_lat' => $input['latitude'],
                'event_long' => $input['longitude'],
                'event_mobile' => $input['contactNo'],
                'event_fb_link' => $input['fblink'],
                'event_twitter_link' => $input['twitterlink'],
                'event_website' => $input['websitelink'],
                'event_email' => $input['email'],
                'event_status' => 1,
                'created_by' => Auth::User()->user_id,
                'updated_by' => Auth::User()->user_id,
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ]);

            if (isset($input['checkbox'])) {
                $checkbox = implode(',', $input['checkbox']);
            } else {
                $checkbox = 0;
            }

            EventOffer::create([
                'event_offer_id' => uniqid(),
                'offer_description' => $input['comment'],
                'event_id' => $event['event_id'],
                'discount_rate' => $input['eventdiscount'],
                'discount_types' => $checkbox,
                'created_by' => Auth::User()->user_id,
                'event_offer_status' => 1,
            ]);
            if (array_key_exists('tags', $input)) {
                AssociateTag::create([
                    'user_id' => Auth::User()->user_id,
                    'entity_id' => $event['event_id'],
                    'entity_type' => 2,
                    'tags_id' => serialize($input['tags']),
                ]);
                $tag_name = '';
                foreach ($input['tags'] as $value) {
                    $tag_data = Tag::where('tag_id', $value)->first();
                    if (!empty($tag_data)) {
                        $tag_name .= ',' . $tag_data->tag_name;
                    }
                }

                $event->update(['tag_id' => $tag_name]);
            }

            $first_name = Auth::user()->first_name;
            $email = Auth::user()->email;

            $data = Event::where('event_id', $event['event_id'])->first();

            Mail::send('email.create_event', ['name' => 'Efungenda', 'first_name' => $first_name, 'data' => $data], function ($message) use ($email, $first_name) {
                $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Create Event');
            });

            Session::flash('success', "Event created successfully.");
            return redirect()->back();
        }

    }
    //Fetch State according to country
    public function fetchState(Request $request)
    {
        $input = $request->input();
        $all_states = State::where('country_id', $input['data'])->pluck('name', 'id');
        return $all_states;
    }

    // Fetch Country according to state
    public function fetchCountry(Request $request)
    {
        $input = $request->input();
        $all_cities = City::where('state_id', $input['data'])->pluck('name', 'id');
        return $all_cities;
    }

    // Getting longitude latitude of specific address
    public function getLongitudeLatitude(Request $request)
    {
        $input = $request->input();
        $city = $input['data'];
        $latLong = GetLatitudeLongitude::getLatLong($city);
        return $latLong;
    }

    // Getting more event
    public function getMoreEvent(Request $request)
    {
        $input = $request->input();

        if (!isset($input['q'])) {
            Session::flash('error', "Url is not valid");
            return redirect('/');
        }

        $all_tags_name = [];
        $data = Event::where('event_id', $input['q'])->first();
        if (empty($data)) {
            Session::flash('error', "Url is not valid");
            return redirect('/');
        } else {

            $data['event_offer'] = $data->getEventOffer;

            $address_data = $data->getAddress;
            $data['address_data'] = '';
            if (!empty($address_data)) {
                $data['address_data'] = $address_data->address_1;
            }

            $data['event_images'] = explode(',', $data['event_image']);
            if (!empty($data['event_main_image'])) {
                $data['all_images'] = Arr::prepend($data['event_images'], $data['event_main_image']);
            } else {
                $data['all_images'] = $data['event_images'];
            }

            $data['image'] = array_filter($data['all_images']);

            $start_date_array = explode(',', $data['event_start_date']);
            $data['start_date'] = $start_date_array;
            foreach ($data['start_date'] as $key => $value) {
                $time_array[] = date('M d, Y', strtotime($value));
                $data['date_in_words'] = $time_array;
            }

            foreach (explode(',', $data['event_end_date']) as $key => $value) {
                $end_array[] = date('M d, Y', strtotime($value));
            }

            $start_time_array = explode(',', $data['event_start_time']);
            $end_time_array = explode(',', $data['event_end_time']);

            foreach ($data['date_in_words'] as $key => $val) {
                $val2 = $start_time_array[$key];
                $val3 = $end_time_array[$key];

                $single_array = [
                    'date' => $val,
                    'start_time' => $val2,
                    'end_time' => $val3,
                ];

                $hours_array[] = $single_array;
            }

            $data['date_in_words'] = $hours_array;

            $all_category = Category::where('parent', 0)->get();
            $all_tags = AssociateTag::where('entity_id', $input['q'])->where('entity_type', 2)->first();

            if (!empty($all_tags)) {
                foreach (unserialize($all_tags['tags_id']) as $value) {
                    $all_tags_name[] = Tag::where('tag_id', $value)->pluck('tag_name')->toArray();
                }
            }
            // $data['all_tags'] = $all_tags_name;

            /* get all tags in comma separated format */
            $data['all_tags'] = implode(", ", array_map(function ($a) {
                return implode(" ", $a);
            }, $all_tags_name));

            // echo "<pre>";
            // print_r($data['all_tags']);die;

            foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent', $category['category_id'])->pluck('name', 'category_id');
            }
            // Recently viewed save
            $existOrNot = RecentlyViewed::where('entity_id', $input['q'])->first();
            if (empty($existOrNot)) {
                RecentlyViewed::create([
                    'entity_id' => $input['q'],
                    'type' => 2,
                ]);
            }

            if (!empty($existOrNot)) {
                $existOrNot->delete();
                RecentlyViewed::create([
                    'entity_id' => $input['q'],
                    'type' => 2,
                ]);
            }

            return view('frontend.pages.moreevent', compact('data', 'all_category'));
        }

    }

    //Return edit page
    public function edit($id)
    {
        // echo $id;die();
        $data['all_country'] = Country::pluck('name', 'id');
        $data['all_category1'] = Category::pluck('name', 'category_id');
        $data['all_tag'] = Tag::pluck('tag_name', 'tag_id');
        $data['event'] = Event::where('event_id', $id)->first();

        $image_string = $data['event']->event_image;
        $image_array = explode(',', $image_string);
        $data['event']['images'] = $image_array;
        $category = $data['event']->getCategory()->pluck('category_id');
        $data['event']['category'] = $category[0];
        $tags = $data['event']->getTags()->pluck('tags_id');

        $unserialized_tags = null;
        foreach ($tags as $key => $value) {
            $tag_val = $value;
        }
        if (!empty($tag_val)) {

            $unserialized_tags = unserialize($tags[0]);

            foreach ($unserialized_tags as $value) {
                $tag_names[] = Tag::where('tag_id', $value)->pluck('tag_name', 'tag_id');
            }
            foreach ($tag_names as $key => $value) {
                foreach ($value as $key => $val) {
                    $tag_name[$key] = $val;
                }

            }
        }

        $image = explode(',', $data['event']['event_image']);
        $data['event']['files'] = $image[0];
        // print_r($data['event']->getAddress);die;
        if (!empty($data['event']->getAddress)) {
            if (!empty($data['event']->getAddress->getCountry)) {
                $country = $data['event']->getAddress->getCountry->id;
                $data['event']['respected_states'] = State::where('country_id', $country)->pluck('name', 'id');
            }
            if (!empty($data['event']->getAddress->getState)) {
                $state = $data['event']->getAddress->getState->id;
                $data['event']['respected_city'] = City::where('state_id', $state)->pluck('name', 'id');
            }
        }

        $data['all_event']['name'] = $data['event']['event_title'];
        $data['all_event']['category'] = $data['event']['category'];
        $data['all_event']['tags'] = $unserialized_tags;
        $data['all_event']['event_description'] = $data['event']['event_description'];

        $data['all_event']['costevent'] = $data['event']['event_cost'];
        if (!empty($data['event']->getEventOffer)) {
            $data['all_event']['eventdiscount'] = $data['event']->getEventOffer->discount_rate;
        }
        if (!empty($data['event']->getEventOffer)) {
            $data['all_event']['checkbox'] = $data['event']->getEventOffer->discount_types;
        }

        if (!empty($data['event']->getEventOffer)) {
            $data['all_event']['comment'] = $data['event']->getEventOffer->offer_description;
        }
        $data['all_event']['startdate'] = explode(',', $data['event']['event_start_date']);
        // print_r($data['all_event']['startdate']);die;
        $data['all_event']['starttime'] = explode(',', $data['event']['event_start_time']);
        $data['all_event']['enddate'] = explode(',', $data['event']['event_end_date']);
        $data['all_event']['endtime'] = explode(',', $data['event']['event_end_time']);

        $array = [];
        $final_array = [];
        foreach ($data['all_event']['startdate'] as $key => $value) {
            $value2 = $data['all_event']['starttime'][$key];
            // $value3 = $data['all_event']['enddate'][$key];
            $value4 = $data['all_event']['endtime'][$key];
            $array['startdate'] = date('m/d/y', strtotime($value));
            $array['starttime'] = date('h:i A', strtotime($value2));
            // $array['enddate'] = date('m/d/y', strtotime($value3));
            $array['endtime'] = date('h:i A', strtotime($value4));
            // date('l dS \o\f F Y h:i:s A', $timestamp)
            $final_array[] = $array;
        }
        $data['all_event']['all_date'] = $final_array;
        // echo "<pre>";
        // print_r($data['all_event']['all_date']);die;

        $data['all_event']['venue'] = $data['event']['event_venue'];

        if (!empty($data['event']->getAddress)) {
            if (!empty($data['event']->getAddress->address_1)) {
                $data['all_event']['address_line_1'] = $data['event']->getAddress->address_1;
            }
            if (!empty($data['event']->getAddress->address_2)) {
                $data['all_event']['address_line_2'] = $data['event']->getAddress->address_2;
            }
            if (!empty($data['event']->getAddress->getCountry)) {
                $data['all_event']['country'] = $data['event']->getAddress->getCountry->id;
            }
            if (!empty($data['event']->getAddress->getState)) {
                $data['all_event']['state'] = $data['event']->getAddress->getState->id;
            }
            if (!empty($data['event']->getAddress->getCity)) {
                $data['all_event']['city'] = $data['event']->getAddress->getCity->id;
                Session::put('city_id', $data['all_event']['city']);
            }
            $data['all_event']['zipcode'] = $data['event']->getAddress->pincode;
        }

        // print_r($data);die;

        $data['all_event']['latitude'] = $data['event']['event_lat'];
        $data['all_event']['longitude'] = $data['event']['event_long'];
        $data['all_event']['contactNo'] = $data['event']['event_mobile'];
        $data['all_event']['email'] = $data['event']['event_email'];

        if (!empty($data['event']['event_website'])) {
            $data['all_event']['websitelink'] = $data['event']['event_website'];
        }
        if (!empty($data['event']['event_fb_link'])) {
            $data['all_event']['fblink'] = $data['event']['event_fb_link'];
        }
        if (!empty($data['event']['event_twitter_link'])) {
            $data['all_event']['twitterlink'] = $data['event']['event_twitter_link'];
        }
        if (!empty($data['event']['event_id'])) {
            $data['all_event']['event_id'] = $data['event']['event_id'];
        }
        // echo "<pre>";
        return view('frontend.pages.createevent', $data);

    }
    //Delete image
    public function deleteImage($id, $name)
    {
        // echo $id;die();
        $event = Event::where('event_id', $id)->first();
        $all_image = Event::where('event_id', $id)->first()->event_image;

        $all_image_array = explode(',', $all_image);
        $new_image_array = [];
        $new_image_string = null;

        foreach ($all_image_array as $value) {
            if ($value != $name) {
                $new_image_array[] = $value;
            }
        }

        if (!empty($new_image_array)) {
            $new_image_string = implode(',', $new_image_array);
        }

        $event->update([
            'event_image' => $new_image_string,
        ]);

        return redirect()->back();
    }

    public function deleteMainImage($id, $name)
    {
        // echo $id;die();
        $event = Event::where('event_id', $id)->first();
        $main_image = null;
        if ($event['event_main_image']) {
            $main_image = Event::where('event_id', $id)->first()->event_main_image;
        }

        if (!empty($main_image)) {
            $event->update([
                'event_main_image' => null,
            ]);
        }
        return redirect()->back();
    }
    //Update event
    public function update(Request $request)
    {
        $input = $request->input();
        $all_files = $request->file();
        $imageValidation = [];
        $fromDate = '';
        $toDate = '';

        foreach ($all_files as $key => $image) {
            foreach ($image as $k => $value) {
                $data[$key] = $value;
                $imageValidation = $this->imageValidator($data);

            }
        }

        if (isset($input['city'])) {
            Session::put('city_id', $input['city']);
            $cityId = $input['city'];
        } else {
            $cityId = '';
        }

        $validation = $this->eventValidation($input);

        if ($validation->fails()) {
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            $all_data_event = Event::where('event_id', $input['event_id'])->first();
            $all_data_address = Address::where('address_id', $all_data_event['event_location'])->first();
            $all_date_event_offer = EventOffer::where('event_id', $input['event_id'])->first();

            $all_data_associate_tag = AssociateTag::where('entity_id', $input['event_id'])->where('entity_type', 2)->first();

            $image_already_exist = $all_data_event->event_image;
            $image_already_exist_array = explode(',', $image_already_exist);

            if (!empty($all_files)) {

                $files = $request->file('file');
                $input_data = $request->all();
                // $imageValidation = Validator::make(
                //     $input_data, ['file.*' => 'required|mimes:jpg,jpeg,png'], [
                //         'file.*.required' => 'Please upload an image',
                //         'file.*.mimes' => 'Only jpeg,png images are allowed']);

                $imageValidation = Validator::make(
                    $input_data, [
                        'file.*' => 'required|mimes:jpg,jpeg,png|max:10000',
                    ], [
                        'file.*.required' => 'Please upload an image',
                        'file.*.mimes' => 'Only jpeg,png images are allowed',
                        'file.*.max' => 'Sorry! Maximum allowed size for an image is 50kb',
                    ]
                );

                // $mainImageValidation = Validator::make(
                //     $input_data, ['main_file.*' => 'required|mimes:jpg,jpeg,png'], [
                //         'main_file.*.required' => 'Please upload an image',
                //         'main_file.*.mimes' => 'Only jpeg,png images are allowed']);

                $mainImageValidation = Validator::make(
                    $input_data, [
                        'main_file.*' => 'required|mimes:jpg,jpeg,png|max:10000',
                    ], [
                        'main_file.*.required' => 'Please upload an image',
                        'main_file.*.mimes' => 'Only jpeg,png images are allowed',
                        'main_file.*.max' => 'Sorry! Maximum allowed size for an image is 50kb',
                    ]
                );

                if ($imageValidation->fails() || $mainImageValidation->fails()) {
                    Session::flash('error', 'Only jpeg,png images are allowed');
                    return Redirect()->back()->withInput();
                } else {

                    $all_image_final = null;
                    if (isset($all_files['file'])) {
                        foreach ($all_files['file'] as $file) {

                            $image = \Image::make($file);
                            $extension = $file->getClientOriginalExtension();
                            // perform orientation using intervention
                            $image->orientate();
                            $picture = "event_" . uniqid() . "." . $extension;
                            $destinationPath = public_path() . '/images/event/';
                            // save image
                            $image->save($destinationPath . $picture);

                            // foreach ($files as $file) {
                            // $filename = $file->getClientOriginalName();
                            // $extension = $file->getClientOriginalExtension();
                            // $picture = "event_" . uniqid() . "." . $extension;
                            // $destinationPath = public_path() . '/images/event/';
                            // $file->move($destinationPath, $picture);

                            //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                            $new_images[] = $picture;
                            // }
                        }

                        if ($image_already_exist_array[0] != '') {
                            $all_image_final = implode(',', array_merge($new_images, $image_already_exist_array));
                        } else {
                            $all_image_final = implode(',', $new_images);
                        }
                    }

                    $picture = null;

                    if (isset($all_files['main_file'])) {

                        foreach ($all_files['main_file'] as $file) {

                            $image = \Image::make($file);
                            $extension = $file->getClientOriginalExtension();
                            // perform orientation using intervention
                            $image->orientate();
                            $picture = "event_" . uniqid() . "." . $extension;
                            $destinationPath = public_path() . '/images/event/';
                            // save image
                            $image->save($destinationPath . $picture);

                            // foreach ($files as $file) {
                            // $filename = $file->getClientOriginalName();
                            // $extension = $file->getClientOriginalExtension();
                            // $picture = "event_" . uniqid() . "." . $extension;
                            // $destinationPath = public_path() . '/images/event/';
                            // $file->move($destinationPath, $picture);

                            //STORE NEW IMAGES IN THE ARRAY VARAIBLE
                            // }
                        }
                    }
                }
            } else {

                $all_image_final = $image_already_exist;
            }

            $all_data_address->update([
                'country_id' => 231,
                'city_id' => $cityId,
                'state_id' => $input['state'],
                'address_1' => $input['address_line_1'],
                // 'address_2' => $input['address_line_2'],
                'pincode' => $input['zipcode'],
            ]);

            foreach ($input as $key => $value) {
                if (substr($key, 0, 8) == 'startdat') {
                    $modified_start_date = date("Y-m-d", strtotime($value));
                    $start_date[] = $modified_start_date;
                }
                if (substr($key, 0, 8) == 'starttim') {
                    $start_time[] = $value;
                }
                if (substr($key, 0, 6) == 'enddat') {
                    $modified_end_date = date("Y-m-d", strtotime($value));
                    $end_date[] = $modified_end_date;
                }
                if (substr($key, 0, 6) == 'endtim') {
                    $end_time[] = $value;
                }
            }

            $start_date_string = implode(',', $start_date);
            $start_time_string = implode(',', $start_time);
            $end_time_string = implode(',', $end_time);

            $start_date_array = explode(',', $start_date_string);
            /* Returns the value of the first array element */
            $fromDate = array_shift($start_date_array);
            /* Returns the value of the last element */
            $toDate = array_pop($start_date_array);

            /* when end date is not specified make the start date as end date */
            if (empty($toDate)) {
                $toDate = $fromDate;
            }

            $all_data_event->update([
                'event_title' => $input['name'],
                'event_venue' => $input['venue'],
                'category_id' => $input['category'],
                'event_cost' => $input['costevent'],
                'event_start_date' => $start_date_string,
                'event_start_time' => $start_time_string,
                'event_end_time' => $end_time_string,
                'event_lat' => $input['latitude'],
                'event_long' => $input['longitude'],
                'event_mobile' => $input['contactNo'],
                'event_fb_link' => $input['fblink'],
                'event_twitter_link' => $input['twitterlink'],
                'event_website' => $input['websitelink'],
                'event_email' => $input['email'],
                'event_description' => $input['event_description'],
                'event_status' => 1,
                'created_by' => Auth::User()->user_id,
                'updated_by' => Auth::User()->user_id,
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ]);

            if (!empty($picture)) {
                $all_data_event->update([
                    'event_main_image' => $picture,
                ]);
            }

            if (!empty($all_image_final)) {
                $all_data_event->update([
                    'event_image' => $all_image_final,
                ]);
            }

            if (isset($input['checkbox'])) {
                $checkbox = implode(',', $input['checkbox']);
            } else {
                $checkbox = 0;
            }

            $all_date_event_offer->update([
                'offer_description' => $input['comment'],
                'discount_rate' => $input['eventdiscount'],
                'discount_types' => $checkbox,
                'created_by' => Auth::User()->user_id,
                'event_offer_status' => 1,

            ]);

            if (array_key_exists('tags', $input)) {
                if (!empty($all_data_associate_tag)) {
                    $all_data_associate_tag->update([
                        'tags_id' => serialize($input['tags']),
                    ]);
                } else {
                    AssociateTag::create([
                        'user_id' => Auth::user()->user_id,
                        'entity_id' => $input['event_id'],
                        'entity_type' => 2,
                        'tags_id' => serialize($input['tags']),
                    ]);
                }

            }

            /* Mail sending section */
            $user_data_all = [];

            $my_fav_list = MyFavorite::where('entity_id', $input['event_id'])->where('entity_type', 2)->get();

            foreach ($my_fav_list as $my_fav_single) {
                $notification = EmailNotificationSettings::where('user_id', $my_fav_single['user_id'])->first();
                $notification_have = 0;
                if (!empty($notification)) {
                    $notification_have = $notification->notification_enabled;
                }
                if ($notification_have == 1) {
                    $user_data = User::where('user_id', $my_fav_single['user_id'])->first();
                    $user_data_all[] = $user_data;
                }
            }

            $event_data_array = [];
            $data = Event::where('event_id', $input['event_id'])->first();

            foreach ($user_data_all as $single_user) {

                $first_name = $single_user['first_name'];
                $email = $single_user['email'];
                Mail::send('email.edit_event', ['name' => 'Efungenda', 'first_name' => $first_name, 'data' => $data], function ($message) use ($email, $first_name) {
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Update event');
                });

                $event_data = $single_user->getEmailNotification->event_id;
                if (empty($event_data)) {
                    $single_user->getEmailNotification->update(['event_id' => $input['event_id']]);
                } else {
                    $event_data_array[] = $event_data;
                    foreach ($event_data_array as $value) {
                        if ($input['event_id'] != $value) {
                            $event_data_array[] = $input['event_id'];
                        }
                    }
                    $event_data_string = implode(',', $event_data_array);
                    $single_user->getEmailNotification->update(['event_id' => $event_data_string]);
                }
            }

            Session::flash('success', 'Event updated successfully');
            return redirect()->back();

        }
    }
    // Add to favourite
    public function addToFavourite(Request $request)
    {
        $input = $request->input();

        if (Auth::User()) {
            $data = MyFavorite::where('user_id', Auth::user()->user_id)->where('entity_type', 2)->where('entity_id', $input['event_id'])->first();

            if (empty($data)) {
                MyFavorite::create([
                    'entity_id' => $input['event_id'],
                    'user_id' => Auth::user()->user_id,
                    'entity_type' => 2,
                    'status' => 1,
                ]);

                $all_fav_data = MyFavorite::where('entity_type', 2)->where('entity_id', $input['event_id'])->get();
                $count = count($all_fav_data);

                $email = Auth::user()->email;
                $first_name = Auth::user()->first_name;

                $data = Event::where('event_id', $input['event_id'])->first();

                Mail::send('email.event_email', ['name' => 'Efungenda', 'first_name' => $first_name, 'data' => $data], function ($message) use ($email, $first_name) {
                    $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Add to favorite Successfully');
                });

                return ['status' => 1, 'count' => $count];
            } else {
                $data->status = 1;
                $data->save();
            }
        } else {
            return ['status' => 2];
        }

    }
    //Remove favorite
    public function removeFavorite(Request $request)
    {
        $input = $request->input();
        if (Auth::User()) {
            $data = MyFavorite::where('user_id', Auth::user()->user_id)->where('entity_id', $input['event_id'])->where('entity_type', 2)->first();
            $data->delete();

            $all_fav_data = MyFavorite::where('entity_type', 2)->where('entity_id', $input['event_id'])->get();
            $count = count($all_fav_data);

            $email = Auth::user()->email;
            $first_name = Auth::user()->first_name;

            $data = Event::where('event_id', $input['event_id'])->first();

            Mail::send('email.remove_event_email', ['name' => 'Efungenda', 'first_name' => $first_name, 'data' => $data], function ($message) use ($email, $first_name) {
                $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Remove from favorite');
            });
            return ['status' => 1, 'count' => $count];
        } else {
            return ['status' => 2, 'count' => 0];
        }

    }

    //I am attending section
    public function iAmAttending(Request $request)
    {
        $input = $request->input();

        $data = IAmAttending::where('user_id', Auth::user()->user_id)->where('entity_id', $input['event_id'])->where('entity_type', 2)->where('status', 1)->first();

        if (!empty($data)) {

            return ['status' => 2, 'msg' => 'You have already added this event'];
        } else {

            IAmAttending::create([
                'user_id' => Auth::user()->user_id,
                'entity_id' => $input['event_id'],
                'entity_type' => 2,
                'status' => 1,
            ]);

            return ['status' => 1, 'msg' => 'Thank you for adding'];

        }

    }

    //I am attending section
    public function flagAsInappropriate(Request $request)
    {
        $input = $request->input();

        $data = FlagAsInAppropriate::where('user_id', Auth::user()->user_id)->where('entity_id', $input['event_id'])->where('entity_type', 2)->where('status', 1)->first();

        if (!empty($data)) {

            return ['status' => 2, 'msg' => 'You have already added this event'];
        } else {

            FlagAsInAppropriate::create([
                'user_id' => Auth::user()->user_id,
                'entity_id' => $input['event_id'],
                'entity_type' => 2,
                'status' => 1,
            ]);

            $data = Event::where('event_id', $input['event_id'])->first();

            $admin_details = User::where('type', 2)->first();

            $first_name = '';
            $email = '';
            if (!empty($admin_details)) {
                $first_name = $admin_details->first_name;
                $email = $admin_details->email;
            }

            Mail::send('email.flag_as_inappropriate', ['name' => 'Efungenda', 'first_name' => $first_name, 'data' => $data], function ($message) use ($email, $first_name) {
                $message->from('vyrazulabs@gmail.com', $name = null)->to($email, $first_name)->subject('Flag As Inappropriate');
            });

            return ['status' => 1, 'msg' => 'You have added this event to flag as inappropriate'];

        }

    }

    // Validation of create-event-form-field
    protected function eventValidation($request)
    {
        return Validator::make($request, [
            'name' => 'required',
            'category' => 'required',
            'startdate' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'address_line_1' => 'required',
            // 'city' => 'required',
            'state' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ])
            ->setAttributeNames([
                'startdate' => 'Start date',
                'starttime' => 'Start time',
                'endtime' => 'End time',
            ]);
    }

    protected function imageValidator($request)
    {
        return Validator::make($request, [
            'file' => 'mimes:jpg,jpeg,png,bmp',
        ]);
    }

    /* Delete event */
    public function destroy(Request $request)
    {
        $input = $request->input();
        // echo $input['data'];
        $event = Event::where('event_id', $input['data'])->first();
        // $event['event_location'];

        $my_favorite = MyFavorite::where('entity_id', $input['data'])->where('entity_type', 2)->get();
        if (!empty($my_favorite)) {
            foreach ($my_favorite as $value) {
                $value->delete();
            }
        }

        $recently_viewed = RecentlyViewed::where('entity_id', $input['data'])->where('type', 2)->first();
        if (!empty($recently_viewed)) {
            $recently_viewed->delete();
        }

        $address = Address::where('address_id', $event['event_location'])->first();
        $address->delete();
        $event_offer = EventOffer::where('event_id', $input['data'])->first();
        $event_offer->delete();
        $associate_tags = AssociateTag::where('entity_id', $input['data'])->where('entity_type', 2)->first();
        if (!empty($associate_tags)) {
            $associate_tags->delete();
        }
        $event->delete();
        return (['status' => 1]);
    }
}
