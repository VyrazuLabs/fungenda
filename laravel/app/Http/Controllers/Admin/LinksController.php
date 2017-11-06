<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;
use Validator;
use Session;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Link::first();
        return view('admin.links.show-link',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.create-link');
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

        $validation = $this->Validation($input);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{

           $links = Link::first();

           if(empty($links)){

               Link::create([
                    'facebook' => $input['facebook'],
                    'twitter' => $input['twitter'],
                    'linkedin' => $input['linkedin'],
                    'google_plus' => $input['google_plus'],
                    'pinterest' => $input['pinterest'],
                    'mail_id' => $input['mail_id']
               ]);

               Session::flash('success', "Links created successfully.");
               return redirect('admin/links');
            }
            else{

               Session::flash('error', "Links already created");
               return redirect('admin/links');  
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = Link::first();
        return view('admin.links.create-link',compact('data'));
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

        $validation = $this->Validation($input);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
            $data = Link::first();
            $data->update([
                'facebook' => $input['facebook'],
                'twitter' => $input['twitter'],
                'linkedin' => $input['linkedin'],
                'google_plus' => $input['google_plus'],
                'pinterest' => $input['pinterest'],
                'mail_id' => $input['mail_id']
            ]);

            Session::flash('success', "Links Edited Successfully.");
            return redirect()->back();
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

    /* validation of links */
     protected function Validation($request){
        return Validator::make($request,[
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'google_plus' => 'required',
            'pinterest' => 'required',
            'mail_id' => 'required'
        ]); 
    }
}
