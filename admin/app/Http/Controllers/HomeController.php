<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Review;
use App\Client;
use App\NewsLetter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all()->count();
        $reviews = Review::all()->count();
        $projects = Project::all()->count();
        $newsletter = NewsLetter::all()->count();
        return view('dashboard' , compact('clients' , 'reviews' , 'projects' , 'newsletter'));
    }
}
