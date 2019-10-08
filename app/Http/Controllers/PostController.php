<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all_post()
    {
    	// $posts = Post::with('category', 'user')->get();
    	// return $posts; //return category and user by post all this oneToMany Relashionship example
    	$category = Category::with('posts')->get();
    	return $category; //return posts by category id
    }
}
