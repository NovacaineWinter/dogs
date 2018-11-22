<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cancellationReason extends Model
{
    protected $fillable=['reason_id','plan_id'];

    public function why(){
    	return $this->belongsTo('\App\cancellationReasonOptions','reason_id');
    }
}
