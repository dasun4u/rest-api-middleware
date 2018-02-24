<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * Get the createdBy record associated with the user.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
}
