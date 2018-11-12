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
}
