<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
// use Image;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all_post()
    {
    	$posts = Post::with('user', 'category')->orderBy('id', 'desc')->get();//all()
    	return response()->json([
    		'posts' => $posts
    	], 200);
    	
    }
    public function save_post(Request $request)
    {
    	$this->validate($request, [
            'title'       => 'required|min:3|max:60',
            'description' => 'required|min:3|max:1000'
        ]);
        
        $imgstrpos = strpos($request->photo, ';');
        $imgsubstr = substr($request->photo, 0,$imgstrpos);
        $imgexplod = explode('/', $imgsubstr)[1];
        $img_name  = time().".".$imgexplod;
        // return $imgexplod;
        $imgmake = \Image::make($request->photo)->resize(200, 200);
        $imgupload_path = public_path()."/images/uploadimage/";
        $imgmake->save($imgupload_path.$img_name);

    	$post = new Post();
    	$post->title = $request->title; 
    	$post->description = $request->description; 
        $post->cat_id = $request->cat_id;
    	$post->photo = $img_name;
    	$post->user_id = \Auth::user()->id;
    	$post->save();
    	
    }
    public function delete_post($id)
    {
        $post = Post::find($id);
        $img_path = public_path()."/images/uploadimage/";
        $image = $img_path. $post->photo;
        if (file_exists($image)) {
            // return $image;
            @unlink($image);
        }
        $post->delete();
    }
    public function edit_post($id)
    {
        $post = Post::find($id);
        return response()->json([
            'post' => $post
        ], 200);
    }
    public function update_post(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request, [
            'title'       => 'required|min:3|max:60',
            'description' => 'required|min:3|max:1000'
        ]);

        if ($request->photo != $post->photo) {
            $imgstrpos = strpos($request->photo, ';');
            $imgsubstr = substr($request->photo, 0,$imgstrpos);
            $imgexplod = explode('/', $imgsubstr)[1];
            $img_name  = time().".".$imgexplod;
            $imgmake = \Image::make($request->photo)->resize(200, 200);
            $imgupload_path = public_path()."/images/uploadimage/";
            $image = $imgupload_path. $post->photo;
            $imgmake->save($imgupload_path.$img_name);
            if (file_exists($image)) {
                @unlink($image);
            }            
        }else{
            $img_name = $post->photo;
        }
        $post->title = $request->title; 
        $post->description = $request->description; 
        $post->cat_id = $request->cat_id;
        $post->photo = $img_name;
        $post->user_id = \Auth::user()->id;
        $post->save();
    }
}
