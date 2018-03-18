<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServiceRequest;
use App\Service;
use App\ServiceGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(10);
        return view('pages.admin.service.list', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_groups = ServiceGroup::all();
        return view('pages.admin.service.create', ['service_groups' => $service_groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->context = $request->input('context');
        $service->method = $request->input('method');
        $service->production_uri = $request->input('production_uri');
        $service->sandbox_uri = $request->input('sandbox_uri');
        $service->service_group_id = $request->input('service_group');
        $service->active = ($request->input('active')=="on")?1:0;
        $service->approved = ($request->input('approved')=="on")?1:0;
        if($service->save()){
            createSessionFlash('Service Create','SUCCESS','Service create successfully');
        } else {
            createSessionFlash('Service Create','FAIL','Error in Service create');
        }
        return redirect('admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('pages.admin.service.show',['service'=>$service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $service_groups = ServiceGroup::all();
        return view('pages.admin.service.edit', ['service' => $service,'service_groups' => $service_groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $service = Service::find($id);
        if($service!=null) {
            $service->name = $request->input('name');
            $service->description = $request->input('description');
            $service->context = $request->input('context');
            $service->method = $request->input('method');
            $service->production_uri = $request->input('production_uri');
            $service->sandbox_uri = $request->input('sandbox_uri');
            $service->service_group_id = $request->input('service_group');
            $service->active = ($request->input('active') == "on") ? 1 : 0;
            $service->approved = ($request->input('approved') == "on") ? 1 : 0;
            if ($service->save()) {
                createSessionFlash('Service Create', 'SUCCESS', 'Service update successfully');
            } else {
                createSessionFlash('Service Create', 'FAIL', 'Error in Service update');
            }
        } else {
            createSessionFlash('Service Update','FAIL','Invalid Service');
        }
        return redirect('admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Service::find($id)->delete();
        if ($delete) {
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);
    }

    public function changeStatus($id, $status)
    {
        $service = Service::find($id);
        if ($service != null) {
            $service->active = $status;
            if ($service->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Change the status"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }

    public function changeApprove($id, $status)
    {
        $service = Service::find($id);
        if ($service != null) {
            $service->approved = $status;
            if ($service->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Changed"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }


}
