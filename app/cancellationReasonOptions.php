<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cancellationReasonOptions extends Model
{
    public function cancellations(){
    	return $this->hasMany('\App\cancellationReason');
    }
}
