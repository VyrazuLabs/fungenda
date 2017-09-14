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

class SearchController extends Controller
{
    public function search(Request $request){
    	$input = $request->input();

    	if($input['radio'] == 1){

            if(isset($input['location'])){
                $location_array = explode(',',$input['location']);
                    foreach ($location_array as $location) {
                        $search_by_location[] = Business::where('business_venue','like','%'.$location.'%')->get();
                        $all_search_business =  $search_by_location;
                    }
                // echo "<pre>";
                // print_r($all_search_business);die;
                foreach ($all_search_business as $business_search) {
                    foreach ($business_search as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                     }       
                }
            }
            if(isset($input['tags'])){

                $tag_id_all = [];
                $tag_details_all = [];
                $all_user_id = [];
                $all_tag_user_details = [];
                $final_tags_array = [];
                $final_unique_value_tags_array_business_id = [];
                $all_search_tags = [];

                foreach ($input['tags'] as $tag) {
                    $tag_details = Tag::where('tag_name',$tag)->first();
                    if(!empty($tag_details)){
                        $tag_id = $tag_details->tag_id;  
                        $tag_id_all[] = $tag_id;
                    } 
                }
                foreach ($tag_id_all as $tag_id) {
                    $tag_user_details = AssociateTag::where('tags_id','like','%'.$tag_id.'%')->where('entity_type',1)->get();
                    $all_tag_user_details[] = $tag_user_details;
                }
                foreach ($all_tag_user_details as $single_tag_user_details) {
                    foreach ($single_tag_user_details as $key => $value) {
                        $final_tags_array[] = $value;
                    }
                }
                $final_unique_value_tags_array = array_unique($final_tags_array);
                foreach ($final_unique_value_tags_array as $final_unique_value_tags_user_id) {
                    $final_unique_value_tags_array_business_id[] = $final_unique_value_tags_user_id['entity_id'];
                }
                foreach ($final_unique_value_tags_array_business_id as $business_id) {
                    $search_by_tag = Business::where('business_id',$business_id)->first();
                    $all_search_business[] = $search_by_tag;
                }
            }

            $all_category = Category::where('parent',0)->get();
                foreach ($all_category as $category) {
                        $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                    }
            return view('frontend.pages.index',compact('all_search_business','all_category'));
    	}
    	else{
    		$location_array = explode(',',$input['location']);
                foreach ($location_array as $location) {
                    $search_by_location = Event::where('event_venue','like','%'.$location.'%')->get();
                    $all_search_location[] =  $search_by_location;
    	   }
        }
    }
}
