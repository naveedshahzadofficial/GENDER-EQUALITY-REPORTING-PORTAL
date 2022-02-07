<?php

namespace App\Http\Controllers;

use App\Models\electronicMediaReporting;
use App\Models\printMediaReporting;
use App\Models\SocialMediaReporting;
use App\Models\User;
use Illuminate\Http\Request;

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
        if(auth()->user()->isDepartment()){

            return view('dashboard');

        }else{
            return view('dashboard');
        }
    }
}
