<?php

use Illuminate\Database\Seeder;

class seedStripe extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));

    	$stripeProduct = new \App\stripeProduct;
    	$stripeProduct->name = "Toys and Treats Box | Monthly";
    	$stripeProduct->type = "service";


        $product =\Stripe\Product::create(array(
			"name" => $stripeProduct->name,
			"type" => "service",
		));

		$stripeProduct->stripe_id = $product->id;
		$stripeProduct->active = true;
		$stripeProduct->save();

		$stripePlan = new \App\stripePlan;

		$stripePlan->nickname ="Standard plan - the first one to market";
		$stripePlan->product_id =$stripeProduct->id;  //local id, not stripe
		$stripePlan->amount =999;
		$stripePlan->currency ="gbp";
		$stripePlan->interval ="month";
		$stripePlan->active =true;

		$plan = \Stripe\Plan::create(array(
			"nickname" 	=> $stripePlan->nickname,
			"product" 	=> $stripeProduct->stripe_id,
			"amount" 	=> $stripePlan->amount,
			"currency" 	=> $stripePlan->currency,
			"interval" 	=> $stripePlan->interval,
		));

		$stripePlan->stripe_id =$plan->id;
		$stripePlan->save();
    }
}
