<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;
use Session;
use App\Models\Business;
use App\Models\Event;
use App\Models\Address;
use App\Models\EventOffer;
use App\Models\AssociateTag;
use App\Models\MyFavorite;
use App\Models\User;
use App\Models\EmailNotificationSettings;
use App\Models\RecentlyViewed;
use App\Models\BusinessOffer;
use App\Models\BusinessHoursOperation;
use App\Models\Tag;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::paginate(4);
        return view('admin.category.show-category',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_category'] = Category::pluck('name','category_id');
        foreach ($data as $value) {
            $value[null] = 'Root';
        }
        foreach ($data['all_category'] as $key => $value) {
            $var[$key] = $value;
        }
        ksort($var);

        return view('admin.category.create-category',compact('var'));
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
        $validation = $this->categoryValidation($input);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors());
        }
        else{
            if($input['submit'] == 'Submit'){
                Category::create([
                            'category_id' => uniqid(),
                            'name' => $input['category_name'],
                            'parent' => $input['parent_name'],
                            'description' => $input['description'],
                            'category_status' => $input['status_dropdown']
                        ]);

                Session::flash('success', "Category create successfully.");
                return redirect()->back();
            }
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

        $category_details = Category::where('category_id',$id)->first();

        $parent_id = $category_details->parent;

        $data['all_category'] = Category::pluck('name','category_id');

        foreach ($data as $value) {
            $value[null] = 'Root';
        }
        foreach ($data['all_category'] as $key => $value) {
            $var[$key] = $value;
        }

        ksort($var);

        if($parent_id == 0){
            $parent_name = ['Root'];
        }
        else{
            $parent_names = Category::where('category_id',$parent_id)->pluck('name');
            $parent_name = $parent_names[0];
        }

        $category_details['category_name'] = $category_details['name'];
        $category_details['parent_name'] = $parent_id;

        if($category_details['category_status'] == 1){

            $category_details['status_dropdown'] = $category_details['category_status'];
        }
        else{

            $category_details['status_dropdown'] = $category_details['category_status'];
        }

        return view('admin.category.edit-category',compact('var','category_details'));
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
        $category = Category::where('category_id',$input['category_id'])->first();

        $validation = $this->categoryValidation($input);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors());
        }
        else{

            $category->update([
                    'name' => $input['category_name'],
                    'parent' => $input['parent_name'],
                    'description' => $input['description'],
                    'category_status' => $input['status_dropdown']
                ]);

            Session::flash('success', "Category updated successfully.");

            return redirect('/admin/category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $data)
    {
        $input = $data->input();
        $all_business = Business::where('category_id',$input['data'])->get();
        if(!empty($all_business)){
            foreach ($all_business as $business) {

                $my_favorite = MyFavorite::where('entity_id',$business['business_id'])->where('entity_type',1)->get();
                if(!empty($my_favorite)){
                  foreach ($my_favorite as $value) {
                    $value->delete();
                  }
                }
                $recently_viewed = RecentlyViewed::where('entity_id',$business['business_id'])->where('type',1)->first();
                if(!empty($recently_viewed)){
                  $recently_viewed->delete();
                }

                $address = Address::where('address_id',$business['business_location'])->first();
                $address->delete();
                $business_offer = BusinessOffer::where('business_id',$business['business_id'])->first();
                $business_offer->delete();
                $associate_tags = AssociateTag::where('entity_id',$business['business_id'])->where('entity_type',1)->first();
                if(!empty($associate_tags)){
                  $associate_tags->delete();
                }
                $business_hours_operation = BusinessHoursOperation::where('business_id',$business['business_id'])->first();
                if(!empty($business_hours_operation)){
                  $business_hours_operation->delete();
                } 
                $business->delete();
            }
        }

        $all_events = Event::where('category_id',$input['data'])->get();
        if(!empty($all_events)){
            foreach ($all_events as $event) {
                
                $event = Event::where('event_id',$event['event_id'])->first();
                // $event['event_location'];

                $my_favorite = MyFavorite::where('entity_id',$event['event_id'])->where('entity_type',2)->get();
                if(!empty($my_favorite)){
                  foreach ($my_favorite as $value) {
                    $value->delete();
                  }
                }

                $recently_viewed = RecentlyViewed::where('entity_id',$event['event_id'])->where('type',2)->first();
                if(!empty($recently_viewed)){
                  $recently_viewed->delete();
                }

                $address = Address::where('address_id',$event['event_location'])->first();
                $address->delete();
                $event_offer = EventOffer::where('event_id',$event['event_id'])->first();
                $event_offer->delete();
                $associate_tags = AssociateTag::where('entity_id',$event['event_id'])->where('entity_type',2)->first();
                if(!empty($associate_tags)){
                  $associate_tags->delete();
                }  
                $event->delete();

            }
        }

        $specific_category = Category::where('category_id',$input['data'])->first();
        $all_sub_categories = Category::where('parent',$input['data'])->get();
        $specific_category->delete();
        if(!empty($all_sub_categories)){
            foreach ($all_sub_categories as $sub_category) { //dddd
                
                $all_business = Business::where('category_id',$sub_category['category_id'])->get();
                if(!empty($all_business)){
                    foreach ($all_business as $business) {

                        $my_favorite = MyFavorite::where('entity_id',$business['business_id'])->where('entity_type',1)->get();
                        if(!empty($my_favorite)){
                          foreach ($my_favorite as $value) {
                            $value->delete();
                          }
                        }
                        $recently_viewed = RecentlyViewed::where('entity_id',$business['business_id'])->where('type',1)->first();
                        if(!empty($recently_viewed)){
                          $recently_viewed->delete();
                        }

                        $address = Address::where('address_id',$business['business_location'])->first();
                        $address->delete();
                        $business_offer = BusinessOffer::where('business_id',$business['business_id'])->first();
                        $business_offer->delete();
                        $associate_tags = AssociateTag::where('entity_id',$business['business_id'])->where('entity_type',1)->first();
                        if(!empty($associate_tags)){
                          $associate_tags->delete();
                        }
                        $business_hours_operation = BusinessHoursOperation::where('business_id',$business['business_id'])->first();
                        if(!empty($business_hours_operation)){
                          $business_hours_operation->delete();
                        } 
                        $business->delete();
                    }
                }

                $all_events = Event::where('category_id',$sub_category['category_id'])->get();
                if(!empty($all_events)){
                    foreach ($all_events as $event) {
                        
                        $event = Event::where('event_id',$event['event_id'])->first();
                        // $event['event_location'];

                        $my_favorite = MyFavorite::where('entity_id',$event['event_id'])->where('entity_type',2)->get();
                        if(!empty($my_favorite)){
                          foreach ($my_favorite as $value) {
                            $value->delete();
                          }
                        }

                        $recently_viewed = RecentlyViewed::where('entity_id',$event['event_id'])->where('type',2)->first();
                        if(!empty($recently_viewed)){
                          $recently_viewed->delete();
                        }

                        $address = Address::where('address_id',$event['event_location'])->first();
                        $address->delete();
                        $event_offer = EventOffer::where('event_id',$event['event_id'])->first();
                        $event_offer->delete();
                        $associate_tags = AssociateTag::where('entity_id',$event['event_id'])->where('entity_type',2)->first();
                        if(!empty($associate_tags)){
                          $associate_tags->delete();
                        }  
                        $event->delete();

                    }
                }

                $sub_category->delete();

            }
        }
    }

    protected function categoryValidation($data){
        return Validator::make($data,[
                'category_name' => 'required',
                'parent_name' => 'required',
                'status_dropdown' => 'required'
            ]);
    }
}
