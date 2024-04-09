<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        return view('home');
    }
}
