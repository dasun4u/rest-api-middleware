<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        "application_id",
        "service_id",
        "approved",
        "approved_by",
        "approved_at",
        "subscribed_by"
    ];

    public function application()
    {
        return $this->belongsTo('App\Application', 'application_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo('App\User', 'approved_by', 'id');
    }

    public function subscribedBy()
    {
        return $this->belongsTo('App\User', 'subscribed_by', 'id');
    }
}
