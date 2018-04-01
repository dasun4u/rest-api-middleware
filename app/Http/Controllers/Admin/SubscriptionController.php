<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;
use App\Service;
use App\ServiceGroup;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::paginate(10);
        return view('pages.admin.subscription.list', ['subscriptions' => $subscriptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applications = Application::all();
        $services = Service::all();
        $service_groups = ServiceGroup::all();
        return view('pages.admin.subscription.create', ['applications' => $applications, 'services' => $services, 'service_groups' => $service_groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {
        $inputs = $request->input();
        $application_id = $inputs["application"];
        $service_group_id = $inputs["service_group"];
        $service_id = $inputs["service"];
        $approved = ($request->input('approved') == "on") ? 1 : 0;
        $approved_by = ($request->input('approved') == "on") ? Auth::user()->id : null;
        $approved_at = ($request->input('approved') == "on") ? Carbon::now()->toDateTimeString() : null;
        $subscribed_by = Auth::user()->id;

        if ($service_id == 0) {
            if ($service_group_id == 0) {
                // Subscribe for all services
                $all_service_ids = Service::pluck('id');
            } else {
                // Subscribe for all services in specific group
                $all_service_ids = Service::where('service_group_id',$service_group_id)->pluck('id');
            }

            $all_created = true;
            $subscription_array = [];
            $subscription_data =[];

            foreach ($all_service_ids as $one_service_id) {
                $already_created = Subscription::where('application_id', $application_id)->where('service_id', $one_service_id)->first();
                if ($already_created != null) {
                    $all_created = false;
                } else {
                    $subscription_data["application_id"] = intval($application_id);
                    $subscription_data["service_id"] = $one_service_id;
                    $subscription_data["approved"] = $approved;
                    $subscription_data["approved_by"] = $approved_by;
                    $subscription_data["approved_at"] = $approved_at;
                    $subscription_data["subscribed_by"] = $subscribed_by;
                    $subscription_data["created_at"] = Carbon::now()->toDateTimeString();
                    $subscription_data["updated_at"] = Carbon::now()->toDateTimeString();
                    array_push($subscription_array,$subscription_data);
                }
            }
            $create_all = Subscription::insert($subscription_array);
            if($create_all){
                if($all_created){
                    createSessionFlash('Subscription Create', 'SUCCESS', 'All Subscription create successfully');
                } else {
                    createSessionFlash('Subscription Create', 'SUCCESS', 'Some subscriptions already created. Others created successfully');
                }
            } else {
                createSessionFlash('Subscription Create', 'FAIL', 'Error in Subscription create');
            }

        } else {
            // Subscribe for one service
            $already_created = Subscription::where('application_id', $application_id)->where('service_id', $service_id)->first();
            if ($already_created != null) {
                // already created one
                createSessionFlash('Subscription Create', 'FAIL', 'This subscription already created');
            } else {
                // new subscription
                $subscription = new Subscription();
                $subscription->application_id = $application_id;
                $subscription->service_id = $service_id;
                $subscription->approved = $approved;
                $subscription->approved_by = $approved_by;
                $subscription->approved_at = $approved_at;
                $subscription->subscribed_by = $subscribed_by;
                if ($subscription->save()) {
                    createSessionFlash('Subscription Create', 'SUCCESS', 'Subscription create successfully');
                } else {
                    createSessionFlash('Subscription Create', 'FAIL', 'Error in Subscription create');
                }
            }
        }

        return redirect('admin/subscriptions');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Subscription::find($id)->delete();
        if ($delete) {
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);
    }

    public function changeApprove($id, $status)
    {
        $subscription = Subscription::find($id);
        if ($subscription != null) {
            $subscription->approved = $status;
            if ($subscription->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Changed"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }

}
