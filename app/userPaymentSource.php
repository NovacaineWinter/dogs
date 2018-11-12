<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;
class userPaymentSource extends Model
{
    use Excludable;

	protected $fillable = ['stripe_id','lastFour','exp_month','exp_year','brand'];

    public function user(){
    	return $this->belongsTo('\App\User','user_id');
    }
}
