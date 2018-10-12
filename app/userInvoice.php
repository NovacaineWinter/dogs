<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userInvoice extends Model
{
    protected $fillable =['stripe_id','paid','amount_due','pdf_link'];

    public function subscription(){
    	return $this->belongsTo('\App\userSubscription','subscription_id');
    }
}
