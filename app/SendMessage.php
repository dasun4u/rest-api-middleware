<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMessage extends Model
{
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    public function receiversDetails()
    {
        $receivers_ids = $this->receivers_id;
        $receivers_id_array = explode(",",$receivers_ids);
        $users = User::whereIn('id',$receivers_id_array)->get();
        return $users;
    }
}
