<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;
class stripePlan extends Model
{
	
    use Excludable;

    public function product(){
    	return $this->belongsTo('\App\stripeProduct','product_id');
    }

    public function subscriptions(){
    	return $this->hasMany('\App\userSubscription','plan_id');
    }
}
