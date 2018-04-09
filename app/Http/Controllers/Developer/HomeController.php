<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Application;
use App\Service;
use App\Subscription;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending_applications = Application::where('approved',0)->where('created_by',Auth::user()->id)->get();
        $pending_services = Service::where('approved',0)->get();
        $pending_subscriptions = Subscription::where('approved',0)->where('subscribed_by',Auth::user()->id)->get();
        return view('pages.developer.home', ['applications' => $pending_applications,  'services' => $pending_services, 'subscriptions' => $pending_subscriptions]);
    }
}
