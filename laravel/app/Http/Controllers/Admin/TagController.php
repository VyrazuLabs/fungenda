<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::paginate(5);
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
            return redirect()->back()->withErrors($validation->errors());
        }
        else{
            Tag::create([
                    'tag_id' => uniqid(),
                    'tag_name' => $input['tag'],
                    'description' => $input['description'],
                    'status' => $input['status_dropdown'],
                    'created_by' => Auth::User()->user_id,
                    'updated_by' => Auth::User()->user_id,
                ]);
            return redirect()->back()->with('status', 'Inserted successfully');
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
        $tag = Tag::where('tag_id',$input['id'])->first(); 
        $tag->update([
                'tag_name' => $input['tag_name'],
                'description' => $input['description'],
                'status' => $input['status'],
                'updated_by' => Auth::User()->user_id,
            ]);
        return redirect()->back()->with('status', 'Update successfully');
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
        return redirect()->back()->with('status', 'Delete successfully');
    }
    // tag validation
     protected function tagValidation($request){
        return Validator::make($request,[
                                       'tag' => 'required',
                                       'description' => 'required',
                                       'status_dropdown' => 'required', 
                                    ]); 
    }
}
