<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userNotification extends Model
{
	protected $fillable=['stripe_id','title'];

    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }
}
