<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class AdminController extends Controller
{
	// return admin dashboard page
    public function viewAdminPannel(){
    	return view('admin.layouts.master');
    }
    // return admin catigory page
    public function getCategory(){
        $data = Category::all();
    	return view('admin.category.show-category',['data' => $data]);
    }
    // Return create category page
    public function createCategory(){
        return view('admin.category.create-category');
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
