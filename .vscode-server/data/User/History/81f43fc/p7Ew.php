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
        $title ='About Us';
        // return view('pages.index' , compact ('title'));
        return view('pages.about')->with('title', $title);
        // return view('pages.about');
    }
    public function services(){
        $data =array(
            'title' => 'Services',
            'services' => ['Web design', 'Programming' , 'SEO' ]

        );
        //  return view('pages.services');
        return view('pages.services')->with($data);



        public function login(){
            $title ='Login';
            // return view('pages.index' , compact ('title'));
            return view('pages.about')->with('title', $title);
            // return view('pages.about');
        }








    }
}