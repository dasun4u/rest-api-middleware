<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApplicationRequest;
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
        return view('pages.admin.application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationRequest $request)
    {
        $application = new Application();
        $application->name = $request->input('name');
        $application->description = $request->input('description');
        $application->token_validity = $request->input('token_validity');
        $application->active = ($request->input('active')=="on")?1:0;
        $application->approved = ($request->input('approved')=="on")?1:0;
        $application->approved_by = ($request->input('approved')=="on")?Auth::user()->id:0;
        $application->created_by = Auth::user()->id;
        $application->production_key = $request->input('production_key');
        $application->production_secret = $request->input('production_secret');
        $application->sandbox_key = $request->input('sandbox_key');
        $application->sandbox_secret = $request->input('sandbox_secret');
        if($application->save()){
            createSessionFlash('Application Create','SUCCESS','Application create successfully');
        } else {
            createSessionFlash('Application Create','FAIL','Error in Application create');
        }
        return redirect('admin/applications');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::find($id);
        return view('pages.admin.application.show', ['application' => $application]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::find($id);
        return view('pages.admin.application.edit', ['application' => $application]);
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
        $application = Application::find($id);
        if($application!=null) {
            $application->name = $request->input('name');
            $application->description = $request->input('description');
            $application->token_validity = $request->input('token_validity');
            $application->active = ($request->input('active') == "on") ? 1 : 0;
            $application->approved = ($request->input('approved') == "on") ? 1 : 0;
            $application->approved_by = ($request->input('approved') == "on") ? Auth::user()->id : 0;
            if ($application->save()) {
                createSessionFlash('Application Update','SUCCESS','Application update successfully');
            } else {
                createSessionFlash('Application Update','FAIL','Error in Application update');
            }
        } else {
            createSessionFlash('Application Update','FAIL','Invalid Application');
        }
        return redirect('admin/applications');
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

    public function generateKeys($scope)
    {
        $upper_scope = strtoupper($scope);
        $key = applicationKeyGenerate($upper_scope);
        $secret = str_random(40);
        return response()->json(["status" => "SUCCESS", "message" => $upper_scope." token generate successful", "key" => $key, "secret" => $secret]);
    }
}
