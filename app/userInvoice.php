<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;
    
class userInvoice extends Model
{
    use Excludable;
    
    protected $fillable =['stripe_id','paid','amount_due','pdf_link'];

    public function subscription(){
    	return $this->belongsTo('\App\userSubscription','subscription_id');
    }
}
