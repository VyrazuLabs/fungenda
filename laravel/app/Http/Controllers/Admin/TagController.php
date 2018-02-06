<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Tag;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.tag.show-tag',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create-tag');
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
        $validation = $this->tagValidation($input);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
            $tags = Tag::pluck('tag_name');
            $input_name_modified = trim(strtolower($input['tag']));

            //define the tag variable
            $is_tag_exist = false;

            foreach ($tags as $value) {
                $tag_modified = trim(strtolower($value));
                $flag = strcmp($input_name_modified,$tag_modified);
                
                if($flag === 0){
                    $is_tag_exist = true;
                } 
            }
            if(!$is_tag_exist){
                Tag::create([
                        'tag_id' => uniqid(),
                        'tag_name' => $input['tag'],
                        'description' => $input['description'],
                        'status' => $input['status_dropdown'],
                        'created_by' => Auth::User()->user_id,
                        'updated_by' => Auth::User()->user_id,
                    ]);
                Session::flash('success', "Tag created successfully.");
                return redirect('admin/tags');
            }
            else{
               Session::flash('error', "Tag Already exist."); 
               return redirect()->back()->withInput();
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
    public function edit(Request $id)
    {
        $input = $id->input();
        $data['tag'] = Tag::where('tag_id',$input['q'])->first();
        return view('admin.tag.edit-tag',$data);
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
        // echo "<pre>";
        // print_r($input);die;
        $validation = $this->tagEditValidation($input);
        //define the tag variable
        $is_tag_exist = false;
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
            $tags = Tag::where('tag_id','!=',$input['id'])->pluck('tag_name');
            // $same_tag = Tag::where('tag_id',$input['id'])->pluck('tag_name');
            $input_name_modified = trim(strtolower($input['tag_name']));
            foreach ($tags as $value) {
                $tag_modified = trim(strtolower($value));
                $flag = strcmp($input_name_modified,$tag_modified);
                
                if($flag === 0){
                    $is_tag_exist = true;
                }     
            }
            if(!$is_tag_exist){
                $tag = Tag::where('tag_id',$input['id'])->first(); 
                $tag->update([
                        'tag_name' => $input['tag_name'],
                        'description' => $input['description'],
                        'status' => $input['status'],
                        'updated_by' => Auth::User()->user_id,
                    ]);
                Session::flash('success', "Tag Edited Successfully.");
                return redirect('/admin/tags');
            }
            else{
               Session::flash('error', "Tag Already exist."); 
               return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $input = $id->input();
        // echo $input['q'];
        $tag = Tag::where('tag_id',$input['q'])->delete();
        return ['status'=>1];
    }
    // tag validation
     protected function tagValidation($request){
        return Validator::make($request,[
                                       'tag' => 'required',
                                       'status_dropdown' => 'required', 
                                    ]); 
    }
    // edit validation
    protected function tagEditValidation($request){
        return Validator::make($request,[
                                       'tag_name' => 'required',
                                       'status' => 'required', 
                                    ]); 
    }
}
