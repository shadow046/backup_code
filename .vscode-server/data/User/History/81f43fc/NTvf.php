<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index(){
        // $title = 'Welcome to laravel';
        // $count = Post::count();
        // return view('posts.index')->with('id' , $id)->with('title', $title)->with('count', $count);
        // return Post::count();
        return 'INDEX';
    }
}