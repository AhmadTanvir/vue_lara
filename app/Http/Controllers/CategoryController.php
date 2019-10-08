<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
}
