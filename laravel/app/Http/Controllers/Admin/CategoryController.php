<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;
use Session;

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
    public function destroy($id)
    {
        //
    }

    protected function categoryValidation($data){
        return Validator::make($data,[
                'category_name' => 'required',
                'parent_name' => 'required',
                'status_dropdown' => 'required'
            ]);
    }
}
