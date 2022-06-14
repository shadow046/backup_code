<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index(){
        $title ='Welcome To Laravel !';
        // return view('pages.index' , compact ('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        
        return view('pages.about');
    }
    public function services(){
        
         return view('pages.services');
    }
}