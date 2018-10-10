<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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


    public function subscriptions(){
        return $this->hasMany('\App\userSubscription','user_id');
    }

    public function stripeEvents(){
        return $this->hasMany('\App\stripeEvent','user_id');
    }


    public function subscripeToMailchimpList($plan){

        switch($this->dogSize){
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
