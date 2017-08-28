<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use Auth;
use Session;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['user_details'] = User::where('user_id',Auth::user()->user_id)->where('type',2)->first();
        $image = $data['user_details']->getUserDetails()->pluck('user_image');

        if(!empty($image)){

            $data['user_details']['user_image'] = $image[0];
        }
        else{

            $data['user_details']['user_image'] = 'personicon.png';
        }

        $address = $data['user_details']->getUserDetails()->pluck('user_address');

        if(!empty($address)){

            $data['user_details']['address'] = $address[0];
        }
        else{

            $data['user_details']['address'] = null;
        }

       $phone_number = $data['user_details']->getUserDetails()->pluck('user_phone_number');
       
       if (!empty($phone_number)) {
            
            $data['user_details']['phone_number'] = $phone_number[0];
        } 
        else{

            $data['user_details']['phone_number'] = null;
        }

        return view('admin.profile.show-profile',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profile.create-profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $data['user'] = User::where('user_id',$id)->first();
        $data['user']['phone_number'] = User::where('user_id',$id)->first()->getUserDetails()->first()->user_phone_number;
        $data['user']['address'] = User::where('user_id',$id)->first()->getUserDetails()->first()->user_address;
        $data['user']['file'] = User::where('user_id',$id)->first()->getUserDetails()->first()->user_image;
        return view('admin.profile.edit-profile',$data);
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
        // echo "<pre>";print_r($input);die();
        $files = $request->file();

        $validation = $this->updateValidation($input);

        if($validation->fails()){
            Session::flash('error', "Field is missing");
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        else{
        
            $user = User::where('user_id',$input['user_id'])->where('type',2)->first();
            $user_details = UserDetails::where('user_id',$input['user_id'])->first();

            if(!empty($files)){
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = "user_".uniqid().".".$extension;
                    $destinationPath = public_path().'/images/user/';
                    $file->move($destinationPath, $picture);

                    $new_image = $picture;
                }
            }
            else{

                $user_image = UserDetails::where('user_id',$input['user_id'])->first()->user_image;

                if(!empty($user_image)){

                    $new_image = $user_image;
                }
                else{
                    $new_image = 'personicon.png';
                }
            }

            $user->update([
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'email' => $input['email']
                ]);

            $user_details->update([
                    'user_image' => $new_image,
                    'user_phone_number' => $input['phone_number'],
                    'user_address' => $input['address'],
                    'updated_by' => Auth::user()->user_id,
                ]);

            Session::flash('success', "User Updated successfully.");
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

    //Update validation
    protected function updateValidation($request){

        return Validator::make($request,[

                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'address' => 'required'
            ]);

    }
}
