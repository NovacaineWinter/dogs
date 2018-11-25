<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;
class userNotification extends Model
{
    use Excludable;
    
	protected $fillable=['stripe_id','title'];

    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }
}
