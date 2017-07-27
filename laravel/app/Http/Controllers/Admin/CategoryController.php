<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('admin.category.show-category',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create-category');
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
            if($input['submit'] == 'submit'){
                Category::create([
                            'category_id' => uniqid(),
                            'name' => $input['category_name'],
                            'parent' => $input['parent_name'],
                            'description' => $input['description'],
                            'category_status' => $input['status_dropdown']
                        ]);

                return redirect()->back()->with('msg',1);
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
    public function edit($id = 1)
    {
        return view('admin.category.edit-category');
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

    protected function categoryValidation($data){
        return Validator::make($data,[
                'category_name' => 'required',
                'parent_name' => 'required',
                'description' => 'required',
                'status_dropdown' => 'required'
            ]);
    }
}
