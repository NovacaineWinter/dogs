<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;

class userSubscription extends Model
{
    use Excludable;
 
	protected $fillable = ['title','typeReference'];	    				

    public function user(){
    	return $this->belongsTo('\App\User','user_id');
    }

    public function invoices(){
    	return $this->hasMany('\App\userInvoice','subscription_id');
    }

    public function plan(){
    	return $this->belongsTo('\App\stripePlan','plan_id');
    }

    public function planPublic(){
        return $this->plan()->exclude(['stripe_id','created_at','updated_at','product_id','active','currency','interval']);
    }

    public function cancelSubscription(){
        $this->is_active = 0;
        $this->save();
        $this->user()->first()->subscriptionCancelEmail($this);
    }

    public function nextDispatchTimestamp(){
        $weekNumber = date('W');
        $secondsInWeek = 7 * 24 * 60 * 60;
        $secondsToWednesdayMidday = ((24 * 2) + 12)* 60 * 60;
        $weekOfDelivery = (((floor(($weekNumber-1)/4))) + $this->delivery_slot);
        $secondsToStartOfWeek = $secondsInWeek * $weekOfDelivery;
        $secondsToDelivery = $secondsToStartOfWeek + $secondsToWednesdayMidday;
        
        $startOfYear = strtotime('01-01-'.date('Y').' 00:00:00');

        $deliveryTimestamp = $startOfYear + $secondsToDelivery;
        return $deliveryTimestamp;
    }


    public function nextDispatchString(){
       return $this->nextDispatchTimestamp();

    }

    public function calculateDeliverySlot(){
        //called on subscription event
        $weekNumber = date('W');        
        return (($weekNumber%13)+1)%4   

    }
}
