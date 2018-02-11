<?php

namespace App\Http\Controllers;

use App\Application;
use App\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inactive_users = User::where('username','!=','admin')->where('active',0)->get();
        $pending_applications = Application::where('approved',0)->get();
        return view('pages.admin.home', ['users' => $inactive_users, 'applications' => $pending_applications]);
    }
}
