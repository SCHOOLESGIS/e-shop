<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.home.index');
    }

    public function about()
    {
        return view('front.home.about');
    }

    public function blog()
    {
        return view('front.home.blog');
    }

    public function contact()
    {
        return view('front.home.contact');
    }
}
