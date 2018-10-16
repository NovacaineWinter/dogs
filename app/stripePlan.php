<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stripePlan extends Model
{
    public function product(){
    	return $this->belongsTo('\App\stripeProduct','product_id');
    }

    public function subscriptions(){
    	return $this->hasMany('\App\userSubscription','plan_id');
    }
}
