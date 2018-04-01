<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveMessage extends Model
{
    protected $fillable = ["send_message_id","receiver_id","is_read"];

    public function sendMessage()
    {
        return $this->belongsTo('App\SendMessage', 'send_message_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }
}
