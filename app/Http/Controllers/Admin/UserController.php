<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('username', '!=', 'admin')->paginate(10);
        return view('pages.admin.user.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->first_name = trim($request->input('first_name'));
        $user->last_name = trim($request->input('last_name'));
        $user->username = trim($request->input('username'));
        $user->active = ($request->input('active') == "on") ? 1 : 0;
        $user->password = bcrypt(trim($request->input('password')));
        $user->email = trim($request->input('email'));
        $user->mobile = trim($request->input('mobile'));
        if ($user->save()) {
            createSessionFlash('User Create', 'SUCCESS', 'User create successfully');
        } else {
            createSessionFlash('User Create', 'FAIL', 'Error in User create');
        }
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('pages.admin.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if ($user != null) {
            if ($request->input("password") != null) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:6|max:50|confirmed',
                    'password_confirmation' => 'required',
                ], [
                    'password.required' => 'Password is required',
                    'password.min' => 'Password minimum character length is 6',
                    'password.max' => 'Password max character length is 50',
                    'password.confirmed' => 'Password confirmation is invalid',
                    'password_confirmation.required' => 'Password Confirmation is required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $user->password = bcrypt(trim($request->input('password')));
            }

            $user->first_name = trim($request->input('first_name'));
            $user->last_name = trim($request->input('last_name'));
            $user->username = trim($request->input('username'));
            $user->active = ($request->input('active') == "on") ? 1 : 0;
            $user->email = trim($request->input('email'));
            $user->mobile = trim($request->input('mobile'));
            if ($user->save()) {
                createSessionFlash('User Update', 'SUCCESS', 'User update successfully');
            } else {
                createSessionFlash('User Update', 'FAIL', 'Error in User update');
            }
        } else {
            createSessionFlash('User Update', 'FAIL', 'Invalid user');
        }
        return redirect('admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::find($id)->delete();
        if ($delete) {
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);

    }

    public function changeStatus($id, $status)
    {
        $user = User::find($id);
        if ($user != null) {
            $user->active = $status;
            if ($user->save()) {
                return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Change the status"]);
            }
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Change Status"]);
    }
}
