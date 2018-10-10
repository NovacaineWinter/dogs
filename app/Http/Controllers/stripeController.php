<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stripeController extends Controller
{

    public function webhooks(Request $request){
    	return $request->get('type');
    }

    public $status = 'init';

    public $errorMessage = '';


    public function createNewSubscription($user,$plan,$stripeData){

    	\Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));

    	try {

	    	//create the customer in stripe from the token_id
	    	$customer = \Stripe\Customer::create(array(
				"email" => $request->get('email'),
				"source" => $stripeData['id'],
			));
	    	$user->stripe_id 	= $customer->id;
	    	$user->save();


	    	//add the newly created customer to a plan to create a subscription
			$subscription = \Stripe\Subscription::create(array(
				"customer" => $user->stripe_id,
				"items" => array(
					array(
					"plan" => $plan->stripe_id,
					"quantity" => 1,
					),
				)
			));

		   $this->status = json_encode(array('status'=>'subscribed'))
    		
    	} catch (Exception $e) {

		   $this->errorMessage = $e->getMessage();
		   $this->status = json_encode(array('status'=>'error'))

		}

		//create the subscription within our app
		$sub 			= new \App\userSubscription;
		$sub->stripe_id = $subscription->id;
		$sub->user_id 	= $user->id;
		$sub->save();

    }
}
