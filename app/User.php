<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \DrewM\MailChimp\MailChimp;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function pendingSubscriptions(){
        return $this->subscriptions()->where('has_been_activated','=',0);
    }

    public function notifications(){
        return $this->hasMany('\App\userNotification','user_id');
    }

    public function subscriptions(){
        return $this->hasMany('\App\userSubscription','user_id');
    }

    public function stripeEvents(){
        return $this->hasMany('\App\stripeEvent','user_id');
    }

    public function paymentMethods(){
        return $this->hasMany('\App\userPaymentSource','user_id');
    }

    public function activeSubscriptions(){
        return $this->subscriptions()->where('is_active','=',1);
    }

    public function activeNotifications(){
        return $this->notifications()->where('is_unread','=',1);
    }

    public function cancellationReasons(){
        return $this->hasMany('\App\cancellationReason','user_id');
    }

/*  
    Account Status stuff ==============================================================

    0  =  not yet active
    1  =  active and up to date
    2  =  Delinquent on payments
    3  =  no active subscriptions
*/

    public function activate(){
        $this->account_status = 1;
        $this->save();
    }
    
    public function isDelinquent(){
        $this->account_status = 2;
        $this->save();    
    }


/*
=========================================================================================
*/

    public function updatePaymentSources($sources){
        foreach($sources as $source){
            if($this->paymentMethods()->where('stripe_id','=',$source['id'])->count()==0){
                $this->paymentMethods()->create(array(
                    'stripe_id' =>$source['id'],
                    'lastFour'  =>$source['last4'],
                    'exp_month' =>$source['exp_month'],
                    'exp_year'  =>$source['exp_year']
                ));
            }
        }
    }


    public function notifyExpiringPaymentMethod($stripeEvent){
        $this->notifications()->create(array(
            'stripe_id'=>$stripeEvent->id,
            'title' =>'Payment Method Expiring Soon'
        ));

        //send email
    }

    public function alertUpcomingPayment(){

    }
    
    public function alertPaymentFailed($stripeEvent){
        $this->notifications()->create(array(
            'stripe_id'=>$stripeEvent->id,
            'title' =>'Payment Failed'
        ));

        //send email
    }


    public function checkForActiveSubscriptions(){
        $active = false;
        foreach($this->subscriptions() as $sub){
            if($sub->is_active){
                $active = true;
            }
        }
        if(!$active){
            $this->account_status = 3;
        }
    }

    public function setDefaultCard($card_id){
        foreach($this->paymentMethods()->get() as $card){
            if($card->stripe_id == $card_id){
                $card->default = true;                
            }else{
                $card->default = false;                                
            }
            $card->save();
        }
    }

    public function subscripeToMailchimpList($plan,$dog){

        switch($dog['size']){
            case 1:
                $dog_size_name = 'Small Dog';
                break;
            case 2:
                $dog_size_name = 'Medium Dog';
                break;
            case 3:
                $dog_size_name = 'Large Dog';
                break;
        }

        $mailchimp = new MailChimp(env('MAILCHIMP_API_KEY'));

        $mailchimp_list_id = env('MAILCHIMP_LIST_ID');

        $result = $mailchimp->post("lists/".$mailchimp_list_id."/members", [
            'email_address' =>  $this->email,
            'first_name'    =>  $this->firstName,
            'last_name'     =>  $this->lastName,
            'dog_size_name' =>  $dog_size_name,
            'plan_name'     =>  $plan->title,
            'status'        =>  'subscribed',
        ]);


        if($mailchimp->success()){
            $this->subscribed_to_mailchimp=true;
        }else{
            $this->subscribed_to_mailchimp=false;
        }
        $this->save();
    }
}
