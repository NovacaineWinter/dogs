<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stripeController extends Controller
{
    
    //public attributes

    public $status = 'init';

    public $errorMessage = '';


    public function publicKeyAPI(){
        return env('STRIPE_PUBLIC');
    }


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
                /*Had a guess at coding this - i think the example shows the webhook for when a user has a 
                bank account set, not a card, so the example data is slightly different. hoping this just works off the bat.*/

    			$source = new \App\userPaymentSource;

                $user = \App\User::where('stripe_id','=',$request->get('data')['object']['customer'])->first();

                $source->user_id = $user->id;
                $source->stripe_id = $request->get('data')['object']['id'];
                $source->brand = $request->get('data')['object']['brand'];
                $source->lastFour = $request->get('data')['object']['last4'];
                $source->exp_month = $request->get('data')['object']['exp_month'];
                $source->exp_year = $request->get('data')['object']['exp_year'];
    			$source->save();

    			$source->user()->stripeEvents()->create([
    				'title'=>'Added New Payment Card',
    				'typeReference'=>'customer.source.created',
    			]);
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
                $sub->save();
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
    			
    			$sub->user()->first()->stripeEvents()->create([
    				'title'=>'Subscription Cancelled',
    				'typeReference'=>'customer.subscription.deleted',
    			]);

                $sub->cancelSubscription();
    			$sub->user()->first()->checkForActiveSubscriptions();

    			return 'Subscription deleted';
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
          

    		case 'charge.succeeded':
    			//not currently doing anything with this for subscriptions as we get the "invoice.payment_succeeded" webhook

                //this is applicable to gift voucher purchases only

    			return 'acknowleged charge succeeded';
    			break;



            case 'charge.dispute.created':

                break;

            case 'charge.dispute.updated':

                break;
        }
    }


    public function buyGiftVoucher(Request $request){

        $this->validate(request(),[
            'token'     =>  'required',
            'voucher'   =>  'required'  
        ]);
        

        \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));
        
        $voucherType = \App\voucher::find($request->get('voucher'));
        try {

            $charge = \Stripe\Charge::create([
                'amount' => $voucherType->price,
                'currency' => 'gbp',
                'description' => 'Gift Voucher | Toys and Treats',
                'source' => $request->get('token')['id'],
                'statement_descriptor' => 'Voucher|Toys & Treats',
            ]);

            $voucher                = new \App\userVoucher;
            $voucher->voucher_id    = $request->get('voucher');
            $voucher->giver_email   = $request->get('token')['email'];
            $voucher->price         = $voucherType->price;
            $voucher->num_of_boxes  = $voucherType->num_of_boxes;
            $voucher->generateCode();
            $voucher->generatePDF();
            $voucher->save();
            $voucher->sendOutVoucher();


            return json_encode(array('status'=>true,'vouchercode'=>$voucher->voucher_code));

        } catch (Exception $e) {

           $this->errorMessage = $e->getMessage();
           $this->status = json_encode(array('status'=>'error'));

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

                //experimental
            $user->updatePaymentSources($customer->sources->data);
            $user->setDefaultCard($customer->default_source);
                //end experimental
	    	$user->save();


            $charge = \Stripe\Charge::create([
                'amount' => $plan->amount,
                'currency' => 'gbp',
                'description' => 'First Month | Toys and Treats',
                'customer' => $customer->id,
                'statement_descriptor' => 'FirstBox|Toys & Treats',
            ]);


	    	//add the newly created customer to a plan to create a subscription
                //this will not generate any charge until the 1st of the following month
			$subscription = \Stripe\Subscription::create(array(
				"customer" => $user->stripe_id,
				"items" => array(
					array(
					"plan" => $plan->stripe_id,
					"quantity" => 1,
					),
                ),
                "trial_end" => $plan->trialEnds(),
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
        $sub->delivery_slot = $sub->calculateDeliverySlot();
		$sub->save();
        $user->sendWelcomeEmail($sub);

    }
}
