<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stripeProduct extends Model
{
    public function plans(){
    	return $this->hasMany('\App\stripePlan','product_id');
    }
}
