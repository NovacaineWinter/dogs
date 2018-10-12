<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stripeEvent extends Model
{

	protected $fillable = ['title', 'typeReference'];

    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }

}
