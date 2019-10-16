<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function add_category(Request $request)
    {
    	$this->validate($request, [
            'catname' => 'required|string|min:3|max:191'
        ]);

    	$category = new Category();
    	$category->catname = $request->catname;
    	$category->save();
    	return ['message' => 'Data Created Successfully !!'];
    }
    public function all_category()
    {
    	$categories = Category::all();
    	return response()->json([
    		'categories' => $categories
    	], 200);
    }
    public function delete_category($id){
        // return $id;
        $category = Category::findOrFail($id);
        $category->delete();
    }
    public function edit_category($id){
        $category = Category::find($id);
    	return response()->json([
            'category'=>$category
        ], 200);
    	
    }
    public function update_category(Request $request,$id)
    {
        // return $id;
        $category = Category::find($id);
        $category->catname = $request->catname;
        $category->save();
    }
    public function selected_category($ids)
    {
        $all_id = explode(',', $ids);
        foreach ($all_id as $id) {
            $category = Category::find($id);
            $category->delete();
        }
    }

}
