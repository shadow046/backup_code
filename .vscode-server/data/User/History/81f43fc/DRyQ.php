<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index(){
      ;
        return view('pages.index');
    }

    public function about(){
        
        return view('pages.about');
    }
    public function services(){
        
        return view('pages.services');
    }
}