<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class AdminController extends Controller
{
	// return admin dashboard page
    public function viewAdminPannel(){
    	return view('admin.Master.master');
    }
    // return admin catigory page
    public function getCategory(){
    	return view('admin.insert_category');
    }
    // save category
    public function saveCategory(Request $request){
    	$input = $request->input();
    	// echo "<pre>";
    	// print_r($input);
    	Category::create([
    			'category_id' => uniqid(),
    			'name' => $input['category_name'],
    			'description' => $input['description'],
    			'category_status' => $input['status']
    		]);
    }
}
