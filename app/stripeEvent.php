<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stripeEvent extends Model
{

    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }


    public function request(){
    	return $this->belongsTo('\App\stripeRequest','request_id');
    }

}
