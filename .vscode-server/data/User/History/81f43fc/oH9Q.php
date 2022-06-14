<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to laravel';
        //return view('pages.index')->with('title', $title);
        return Post::count();
    }
}