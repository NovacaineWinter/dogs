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

    public function trialEnds(){

    	$secondsInDay = 24 * 60 * 60;

    	// t <- days in the given month integer
    	// j <- current day of the month integer
    	$remaining = date('t') - date('j'); 
    	
    	$midnightThisMorning = strtotime(date('Y-m-d'));

    	//take us to the first of the next month at mid day - need to add a day and a half in seconds
    	$dayAndAHalf = (24 + 12) * 60 * 60;

    	//timestamp of time trial is due to end
    	$midDayOnFirstOfNextMonth = $midnightThisMorning + ($remaining * $secondsInDay) + $dayAndAHalf;
    	
    	return $midDayOnFirstOfNextMonth;
    }
}
