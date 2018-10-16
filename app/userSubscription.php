<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userSubscription extends Model
{
 
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
}
