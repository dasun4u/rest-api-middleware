<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MessageRequest;
use App\ReceiveMessage;
use App\SendMessage;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $receive_messages = ReceiveMessage::whereRaw("find_in_set('$user_id',receiver_id)")->paginate(10);
        return view('pages.admin.message.received_list', ['receive_messages' => $receive_messages]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMessages()
    {
        $send_messages = SendMessage::where('sender_id', Auth::id())->paginate(10);
        return view('pages.admin.message.sent_list', ['send_messages' => $send_messages]);
    }

    public function sendMessageShow($id)
    {
        $message = SendMessage::find($id);
        return view('pages.admin.message.send_show', ['message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->except(Auth::id());
        return view('pages.admin.message.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $receivers_ids = $request->input('to');
        $sent_message = new SendMessage();
        $sent_message->sender_id = Auth::id();
        $sent_message->receivers_id = implode(",",$receivers_ids);
        $sent_message->title = $request->input('title');
        $sent_message->message = $request->input('message');
        if($sent_message->save()){
            $receive_messages_data = [];
            $receive_messages_array = [];
            foreach ($receivers_ids as $receivers_id){
                $receive_messages_data["send_message_id"] = $sent_message->id;
                $receive_messages_data["receiver_id"] = $receivers_id;
                $receive_messages_data["is_read"] = 0;
                $receive_messages_data["created_at"] = Carbon::now()->toDateTimeString();
                $receive_messages_data["updated_at"] = Carbon::now()->toDateTimeString();
                array_push($receive_messages_array,$receive_messages_data);
            }
            $receive_message_create = ReceiveMessage::insert($receive_messages_array);
            if($receive_message_create) {
                createSessionFlash('Message Create', 'SUCCESS', 'Message create successfully');
            } else {
                createSessionFlash('Message Create', 'FAIL', 'Error in Message create');
            }
        } else {
            createSessionFlash('Message Create', 'FAIL', 'Error in Message create');
        }
        return redirect('admin/messages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receive_message = ReceiveMessage::find($id);
        $receive_message->update(["is_read"=>1]);
        $send_message_id = $receive_message->send_message_id;
        $message = SendMessage::find($send_message_id);
        return view('pages.admin.message.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
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
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ReceiveMessage::find($id)->delete();
        if ($delete) {
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        }
        return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);
    }
}
