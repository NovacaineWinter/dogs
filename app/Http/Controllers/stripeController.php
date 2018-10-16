<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stripeController extends Controller
{
    
    //public attributes

    public $status = 'init';

    public $errorMessage = '';




    public function webhooks(Request $request){
    	switch($request->get('type')){
    		

    		case 'customer.created':
    			//data already returned in the create new subscription method below

    			$user = \App\User::where('email','=',$request->get('data')['object']['email'])->first();

    			//log stripe event
    			$user->stripeEvents()->create(['title'=>'User Account Created','typeReference'=>'customer.created']);

    			//update user info from data
    			$user->updatePaymentSources($request->get('data')['object']['sources']['data']);
    			$user->setDefaultCard($request->get('data')['object']['default_source']);

    			return 'customer created ok';
    			break;


    		case 'customer.updated':
    			$user = \App\User::where('email','=',$request->get('data')['object']['email'])->first();
    			$user->stripeEvents()->create([
    				'title'=>'Account Details Updated',
    				'typeReference'=>'customer.updated',
    			]);
    			$user->updatePaymentSources($request->get('data')['object']['sources']['data']);
    			$user->setDefaultCard($request->get('data')['object']['default_source']);
    			if ($request->get('data')['object']['delinquent']){
    				$user->isDelinquent();
    			}else{
    				$user->activate();
    			}
    			return 'customer updated ok';
    			break;





    		case 'customer.source.expiring':    	
    			$source = \App\userPaymentSource::where('stripe_id','=',$request->get('data')['object']['id'])->first();
                $stripeEvent = $source->user()->first()->stripeEvents()->create([
                    'title'=>'Warning -  Payment Method Expiring soon',
                    'typeReference'=>'customer.source.expiring',
                ]);
    			$source->user()->first()->notifyExpiringPaymentMethod($stripeEvent);
    			return 'warned user';
    			break;

    		case 'customer.source.deleted':    	
    			$source = \App\userPaymentSource::where('stripe_id','=',$request->get('data')['object']['id'])->first();
    			$source->delete();
    			$source->user()->first()->stripeEvents()->create([
    				'title'=>'Deleted Payment Method',
    				'typeReference'=>'customer.source.deleted',
    			]);
    			return 'source Deleted Ok';
    			break;


    		case 'customer.source.created':    	
    			/* So far this webhook doesnt seem to want to give me info regarding who owns the source.....irritating */

/*    			$source = \App\userPaymentSource::where('stripe_id','=',$request->get('data')['object']['id']);
    			$source->delete();
    			$source->user->stripeEvents()->create([
    				'title'=>'Deleted Payment Method',
    				'typeReference'=>'customer.source.deleted',
    			]);*/
    			break;








    		case 'customer.subscription.created':
    			//data already returned in the create new subscription method below
    			$sub = \App\userSubscription::where('stripe_id','=',$request->get('data')['object']['id'])->first();	
                $sub->is_active = true;
    			$sub->has_been_activated = true;
    			$sub->user()->first()->stripeEvents()->create([
    				'title'=>'Subscribed To Plan',
    				'typeReference'=>'customer.subscription.created',
    			]);
    			$sub->user()->first()->activate();
    			return 'customer subscription created ok';
    			break;
    			
    		case 'customer.subscription.updated':
				$sub = \App\userSubscription::where('stripe_id','=',$request->get('data')['object']['id'])->first();	
    			$sub->user()->first()->stripeEvents()->create([
    				'title'=>'Subscription Updated -'.$request->get('data')['object']['plan']['nickname'],
    				'typeReference'=>'customer.subscription.updated',
    			]);
    			return 'Subscription Updated';
    			break;

    		case 'customer.subscription.deleted':
    			$sub = \App\userSubscription::where('stripe_id','=',$request->get('data')['object']['id'])->first();	
    			$sub->is_active = false;
    			$sub->save();
    			$sub->user()->first()->stripeEvents()->create([
    				'title'=>'Subscription Cancelled',
    				'typeReference'=>'customer.subscription.deleted',
    			]);
    			$sub->user()->first()->checkForActiveSubscriptions();

    			return 'Subscription deleted';
    			break;


    		case 'charge.succeeded':
    			//not currently doing anything with this as we get the "invoice.payment_succeeded" webhook
    			return 'acknowleged charge succeeded';
    			break;


    		case 'invoice.upcoming':
    			$user = \App\User::where('stripe_id','=',$request->get('data')['object']['customer'])->first();
    			$user->alertUpcomingPayment(); 
    			$user->stripeEvents()->create([
    				'title'=>'Notification of upcoming payment',
    				'typeReference'=>'invoice.upcoming',
    			]);   			
    			return 'Invoice upcoming notified';
    			break;


    		case 'invoice.created':
    			//stripe runs this webhook approx 1hr before attempting to pay the invoice - can create invoice before paying it
    				//very important we respond in the affirmative to this webhook or stripe will not process the payment
    			$sub = \App\userSubscription::where('stripe_id','=',$request->get('data')['object']['subscription'])->first();
    			$sub->invoices()->create(array(
    				'stripe_id'=>$$request->get('data')['object']['id'],
    				'paid'=>false,
    				'amount_due'=>$request->get('data')['object']['amount_due'],
    				'pdf_link'=>$request->get('data')['object']['invoice_pdf']
    			));

    			$sub->user()->first()->stripeEvents()->create([
    				'title'=>'Invoice created',
    				'typeReference'=>'invoice.created',
    			]);
    			return 'Invoice created OK';
    			break;



    		case 'invoice.payment_succeeded':
    			$invoice = \App\userInvoices::where('stripe_id','=',$request->get('data')['object']['id'])->first();
    			$invoice->paid = $request->get('data')['object']['paid'];
    			$invoice->amount_due = $request->get('data')['object']['amount_due'];
    			$invoice->pdf_link = $request->get('data')['object']['invoice_pdf'];
    			$invoice->save();

    			$invoice->subscription()->first()->user()->first()->stripeEvents()->create([
    				'title'=>'Invoice paid Successfully',
    				'typeReference'=>'invoice.payment_succeeded',
    			]);
    			break;



    		case 'invoice.payment_failed':
    			$invoice = \App\userInvoices::where('stripe_id','=',$request->get('data')['object']['id'])->first();
    			$invoice->paid = $request->get('data')['object']['paid'];
    			$invoice->amount_due = $request->get('data')['object']['amount_due'];
    			$invoice->pdf_link = $request->get('data')['object']['invoice_pdf'];
    			$invoice->save();

    			$stripeEvent = $invoice->subscription()->first()->user()->first()->stripeEvents()->create([
    				'title'=>'Subscription Payment Failed',
    				'typeReference'=>'invoice.payment_failed',
    			]);

    			$invoice->subscription()->first()->user()->first()->alertPaymentFailed($stripeEvent);
    			break;
          




    		case 'charge.dispute.created':

    			break;

    		case 'charge.dispute.updated':

    			break;
    	}
    }



    public function createNewSubscription($user,$plan,$dog,$stripeData){

    	\Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));

    	try {

	    	//create the customer in stripe from the token_id
	    	$customer = \Stripe\Customer::create(array(
				"email" => $user->email,
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

		   $this->status = json_encode(array('status'=>'subscribed'));
    		
    	} catch (Exception $e) {

		   $this->errorMessage = $e->getMessage();
		   $this->status = json_encode(array('status'=>'error'));

		}

		//create the subscription within our app
		$sub 			= new \App\userSubscription;
		$sub->stripe_id = $subscription->id;
		$sub->user_id 	= $user->id;
		$sub->plan_id	= $plan->id;
        $sub->dog_name  = $dog['name'];
        $sub->dog_size  = $dog['size'];
		$sub->save();

    }
}
