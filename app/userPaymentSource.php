<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userPaymentSource extends Model
{

	protected $fillable = ['stripe_id','lastFour','exp_month','exp_year'];

    public function user(){
    	return $this->belongsTo('\App\User','user_id');
    }
}
