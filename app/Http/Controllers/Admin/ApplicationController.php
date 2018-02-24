<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::paginate(10);
        return view('pages.admin.application.list', ['applications' => $applications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Application::find($id)->delete();
        if ($delete) {
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);
    }

    public function changeStatus($id, $status)
    {
        $application = Application::find($id);
        if ($application != null) {
            $application->active = $status;
            if ($application->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Change the status"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }

    public function changeApprove($id, $status)
    {
        $application = Application::find($id);
        if ($application != null) {
            $application->approved = $status;
            $application->approved_by = Auth::user()->id;
            if ($application->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Changed"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }
}
