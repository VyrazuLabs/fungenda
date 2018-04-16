<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Business;
use App\Models\Address;
use App\Models\Tag;
use App\Models\AssociateTag;
use App\Models\Category;
use Session;


class SearchController extends Controller
{
    public function getSearch(){
        $all_events = Event::paginate(4);
        foreach ($all_events as $event) {
            $event_count = count($event->getFavorite()->where('status',1)->get());
            $event['fav_count'] = $event_count;
            $img = explode(',',$event['event_image']);
            $event['image'] = $img;
            $related_tags = $event->getTags()->where('entity_type',2)->get();
            $event['tags'] = $related_tags;
            $event_discount = $event->getEventOffer()->first()->discount_types;
            $event['discount'] = $event_discount;
        }
        $all_business = Business::paginate(4);
        foreach ($all_business as $business) {
            $business_count = count($business->getFavorite()->where('status',1)->get());
            $business['fav_count'] = $business_count;
            $img = explode(',',$business['business_image']);
            $business['image'] = $img;
            $related_tags = $business->getTags()->where('entity_type',1)->get();
            $business['tags'] = $related_tags;
            $business_discount = $business->getBusinessOffer()->first()->business_discount_types;
            $business['discount'] = $business_discount;
        }
        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }

        return view('frontend.pages.index',compact('all_events','all_business','all_category'));
    }
    public function search(Request $request){
        $input = $request->input();

        // echo "<pre>";
        // print_r($input);die;

        Session::put('input',$input);

        //CATEGORY SECTION
        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
            $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
        }

        $data_all = [];
        $all_search_events = [];
        $all_search_business = [];

        if($input['radio'] == 2) {

            if(!empty($input['tags'])) {

                foreach ($input['tags'] as $value) {
                    $all_events = '';
                    $all_events = Event::join('event_offer', 'events.event_id', '=', 'event_offer.event_id');
                    $all_events = $all_events->where('tag_id', 'like', '%'.$value.'%');

                    if(!empty($input['fromdate'])) {
                        $res = explode("/", $input['fromdate']);            
                        $changedDate = $res[2]."-".$res[0]."-".$res[1];
                        $all_events = $all_events->where('event_start_date', 'like', '%'.$changedDate.'%');
                    }
                    if(!empty($input['todate'])) {
                        $res = explode("/", $input['todate']);            
                        $changedDate = $res[2]."-".$res[0]."-".$res[1];
                        $all_events = $all_events->where('event_end_date', 'like', '%'.$changedDate.'%');
                    }
                    if(isset($input['checkbox1'])) {
                        $all_events = $all_events->where('discount_types', 'like', '%'.$input['checkbox1'].'%');
                    }
                    if(isset($input['checkbox2'])) {
                        $all_events = $all_events->where('discount_types', 'like', '%'.$input['checkbox2'].'%');
                    }
                    if(isset($input['checkbox3'])) {
                        $all_events = $all_events->where('discount_types', 'like', '%1%')
                                                 ->orWhere('discount_types', 'like', '%2%');
                    }

                    $data_all[] = $all_events->get();
                }

            }
            else {
                $all_events = Event::join('event_offer', 'events.event_id', '=', 'event_offer.event_id');

                if(!empty($input['fromdate'])) {
                    $res = explode("/", $input['fromdate']);            
                    $changedDate = $res[2]."-".$res[0]."-".$res[1];
                    $all_events = $all_events->where('event_start_date', 'like', '%'.$changedDate.'%');
                }
                if(!empty($input['todate'])) {
                    $res = explode("/", $input['todate']);            
                    $changedDate = $res[2]."-".$res[0]."-".$res[1];
                    $all_events = $all_events->where('event_end_date', 'like', '%'.$changedDate.'%');
                }
                if(isset($input['checkbox1'])) {
                    $all_events = $all_events->where('discount_types', 'like', '%'.$input['checkbox1'].'%');
                }
                if(isset($input['checkbox2'])) {
                    $all_events = $all_events->where('discount_types', 'like', '%'.$input['checkbox2'].'%');
                }
                if(isset($input['checkbox3'])) {
                    $all_events = $all_events->where('discount_types', 'like', '%1%')
                                                 ->orWhere('discount_types', 'like', '%2%');
                }

                $all_events = $all_events->get();

                $data_all[] = $all_events;
            }
        }
        if($input['radio'] == 1) {

            if(!empty($input['tags'])) {

                foreach ($input['tags'] as $value) {
                    $all_business = '';
                    $all_business = Business::join('business_offer', 'business.business_id', '=', 'business_offer.business_id');
                    $all_business = $all_business->where('tag_id', 'like', '%'.$value.'%');

                    if(isset($input['checkbox1'])) {
                        $all_business = $all_business->where('business_discount_types', 'like', '%'.$input['checkbox1'].'%');
                    }
                    if(isset($input['checkbox2'])) {
                        $all_business = $all_business->where('business_discount_types', 'like', '%'.$input['checkbox2'].'%');
                    }
                    if(isset($input['checkbox3'])) {
                        $all_business = $all_business->where('business_discount_types', 'like', '%1%')->orWhere('business_discount_types', 'like', '%2%');
                    }

                    $data_all[] = $all_business->get();
                }
            }
            else {
                $all_business = Business::join('business_offer', 'business.business_id', '=', 'business_offer.business_id');

                if(isset($input['checkbox1'])) {
                    $all_business = $all_business->where('business_discount_types', 'like', '%'.$input['checkbox1'].'%');
                }
                if(isset($input['checkbox2'])) {
                    $all_business = $all_business->where('business_discount_types', 'like', '%'.$input['checkbox2'].'%');
                }
                if(isset($input['checkbox3'])) {
                    $all_business = $all_business->where('business_discount_types', 'like', '%1%')->orWhere('business_discount_types', 'like', '%2%');
                }

                $all_business = $all_business->get();

                $data_all[] = $all_business;
            }

        }

        if(!empty($input['radius'])) {

            if(empty($input['location'])) {
                Session::flash('error', "Pleace set your location first");
                return redirect('/');
            }

            // $modified_address = str_replace(' ','%',$input['location']);
            // echo $modified_address

            $user_latlong = $this->getLatLong($input['location']);

            if($user_latlong == 1) {
                Session::flash('error', "Please enter valid address");
                return redirect('/');
            }
            if($user_latlong == 2) {
                Session::flash('error', "Please try again");
                return redirect('/');
            }

            $user_latitude = explode(',',$user_latlong)[0];
            $user_longitude = explode(',',$user_latlong)[1];

            if($input['radio'] == 2) {
                $all_search_events = [];
                foreach ($data_all as $array_data) {
                    foreach ($array_data as $data) {

                        // convert from degrees to radians
                        $latFrom = deg2rad($user_latitude);
                        $lonFrom = deg2rad($user_longitude);
                        $latTo = deg2rad($data['event_lat']);
                        $lonTo = deg2rad($data['event_long']);

                        $latDelta = $latTo - $latFrom;
                        $lonDelta = $lonTo - $lonFrom;

                        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                        $distance = $angle * 3959;

                        if($distance <= $input['location']) {
                            $all_search_events[] = $data;
                        }
                    }
                }
            }
            if($input['radio'] == 1) {
                $all_search_business = [];
                foreach ($data_all as $array_data) {
                    foreach ($array_data as $data) {

                        // convert from degrees to radians
                        $latFrom = deg2rad($user_latitude);
                        $lonFrom = deg2rad($user_longitude);
                        $latTo = deg2rad($data['business_lat']);
                        $lonTo = deg2rad($data['business_long']);

                        $latDelta = $latTo - $latFrom;
                        $lonDelta = $lonTo - $lonFrom;

                        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                        $distance = $angle * 3959;

                        if($distance <= $input['location']) {
                            $all_search_business[] = $data;
                        }
                    }
                }
            }

        }
        else {
            foreach ($data_all as $array_data) {
                foreach ($array_data as $data) {
                    if($input['radio'] == 1) {
                        $all_search_business[] = $data;
                    }
                    if($input['radio'] == 2) {
                        $all_search_events[] = $data;
                    }
                }
            }
        }


        if($input['radio'] == 1) {
            $all_search_business = array_map("unserialize", array_unique(array_map("serialize", $all_search_business)));
            foreach ($all_search_business as $business) {
                $business_count = count($business->getFavorite()->where('status',1)->get());
                $business['fav_count'] = $business_count;
                $img = explode(',',$business['business_image']);
                $business['image'] = $img;
                $related_tags = $business->getTags()->where('entity_type',1)->get();
                $business['tags'] = $related_tags; 
                $business_discount = $business->getBusinessOffer()->first()->business_discount_types;
                $business['discount'] = $business_discount;    
            }

            return view('frontend.pages.index',compact('all_search_business','all_category'));
        }

        if($input['radio'] == 2) {
            $all_search_events = array_map("unserialize", array_unique(array_map("serialize", $all_search_events)));
            foreach ($all_search_events as $event) {
                $business_count = count($event->getFavorite()->where('status',1)->get());
                $event['fav_count'] = $business_count;
                $img = explode(',',$event['event_image']);
                $event['image'] = $img;
                $related_tags = $event->getTags()->where('entity_type',2)->get();
                $event['tags'] = $related_tags;
                $event_discount = $event->getEventOffer()->first()->discount_types;
                $event['discount'] = $event_discount;
            }
            return view('frontend.pages.index',compact('all_search_events','all_category'));
        }
    }

    // Set session for getting latitude and longitude
    public function session(Request $request){
        $input = $request->input();
        $latitude = $input['latitude'];
        $longitude = $input['longitude'];
        Session::put('user_latitude',$latitude);
        Session::put('user_longitude',$longitude);
    }

    // GET LAT LONG OF ADDRESS
    public function getLatLong($address) {
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyBlmxfYLHB9mW6gpPHLmSUMjq8JzMPi824');

        $geo = json_decode($geo, true);

        if ($geo['status'] == 'OK') {
            $latitude = $geo['results'][0]['geometry']['location']['lat'];                  
            $longitude = $geo['results'][0]['geometry']['location']['lng'];
            return $latitude.','.$longitude;
        }
        else if($geo['status'] == 'ZERO_RESULTS') {
            return 1;

        } else {
            return 2;
        }

    }
}
