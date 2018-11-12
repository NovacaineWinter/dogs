<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;
class stripeEvent extends Model
{
    use Excludable;

	protected $fillable = ['title', 'typeReference'];

    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }

}
