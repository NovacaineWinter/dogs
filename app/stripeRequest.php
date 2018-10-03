<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DrewM\MailChimp\MailChimp;

class stripeRequest extends Model
{
    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }

    public function events(){
    	return $this->hasMany('\App\stripeEvent','request_id');
    }

    public function foo($user,$plan){

    	switch($user->dogSize){
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


    	try
		{
			$subscription = \Stripe\Subscription::create(array(
				"customer" => $user->stripe_id,
				"items" => array(
					array(
					"plan" => $plan->stripe_id,
					"quantity" => 1,
					),
				)
			));

			$sub 			= new \App\stripeSubscription;
			$sub->stripe_id = $subscription->id;
			$sub->user_id 	= $user->id;
			$sub->save();

			$mailchimp = new MailChimp(env('MAILCHIMP_API_KEY'));

			$mailchimp_list_id = env('MAILCHIMP_LIST_ID');

			$result = $mailchimp->post("lists/".$mailchimp_list_id."/members", [
				'email_address' => 	$user->email,
				'first_name'	=> 	$user->firstName,
				'last_name'		=>	$user->lastName,
				'dog_size_name'	=>	$dog_size_name,
				'plan_name'		=>	$plan->title,
				'status'        => 	'subscribed',
			]);


			if($mailchimp->success()){
				$user->subscribed_to_mailchimp=true;
			}else{
				$user->subscribed_to_mailchimp=false;
			}

			return json_encode(array('status'=>'subscribed'));


		}
		catch(Exception $e)
		{
		  error_log("unable to sign up customer:" . $_POST['stripeEmail'].
		    ", error:" . $e->getMessage());
			return json_encode(array('status'=>'error'));
		}

    }

}
