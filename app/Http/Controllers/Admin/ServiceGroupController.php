<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\ServiceGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceGroupRequest;

class ServiceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = ServiceGroup::paginate(10);
        return view('pages.admin.service-group.list', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.service-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceGroupRequest $request)
    {
        $group = new ServiceGroup();
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->context = $request->input('context');
        $group->active = ($request->input('active')=="on")?1:0;
        if($group->save()){
            createSessionFlash('Service Group Create','SUCCESS','Service Group create successfully');
        } else {
            createSessionFlash('Service Group Create','FAIL','Error in Service Group create');
        }
        return redirect('admin/serviceGroups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = ServiceGroup::find($id);
        return view('pages.admin.service-group.show', ['group' => $group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = ServiceGroup::find($id);
        return view('pages.admin.service-group.edit', ['group' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceGroupRequest $request, $id)
    {
        $group = ServiceGroup::find($id);
        if($group!=null) {
            $group->name = $request->input('name');
            $group->description = $request->input('description');
            $group->context = $request->input('context');
            $group->active = ($request->input('active') == "on") ? 1 : 0;
            if ($group->save()) {
                createSessionFlash('Service Group Update','SUCCESS','Service Group update successfully');
            } else {
                createSessionFlash('Service Group Update','FAIL','Error in Service Group update');
            }
        } else {
            createSessionFlash('Service Group Update','FAIL','Invalid Service Group');
        }
        return redirect('admin/serviceGroups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ServiceGroup::find($id)->delete();
        if ($delete) {
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);
    }

    public function changeStatus($id, $status)
    {
        $group = ServiceGroup::find($id);
        if ($group != null) {
            $group->active = $status;
            if ($group->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Change the status"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }

    public function getServicesByGroupID($id)
    {
        if($id==0){
            $services = Service::select('id','name')->get()->toArray();
        } else {
            $services = Service::select('id','name')->where('service_group_id',$id)->get()->toArray();
        }
        return response()->json(["id" => $id, "status" => "SUCCESS", "data" => $services]);
    }
}
