<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Application;
use App\Service;
use App\Subscription;
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
        $pending_services = Service::where('approved',0)->get();
        $pending_subscriptions = Subscription::where('approved',0)->get();
        return view('pages.admin.home', ['users' => $inactive_users, 'applications' => $pending_applications,  'services' => $pending_services, 'subscriptions' => $pending_subscriptions]);
    }
}
