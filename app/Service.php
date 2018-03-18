<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceGroup;

class Service extends Model
{
    public function group(){
        return $this->belongsTo('App\ServiceGroup','service_group_id','id');
    }
}
