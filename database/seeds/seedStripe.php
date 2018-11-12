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





    	$stripeProductA = new \App\stripeProduct;
    	$stripeProductA->name = "Toys and Treats | Waggy Tail Box ";
    	$stripeProductA->type = "service";


        $product =\Stripe\Product::create(array(
			"name" => $stripeProductA->name,
			"type" => "service",
		));

		$stripeProductA->stripe_id = $product->id;
		$stripeProductA->active = true;
		$stripeProductA->save();

		$stripePlanA = new \App\stripePlan;

		$stripePlanA->nickname ="Waggy Tail Box plan";
		$stripePlanA->product_id =$stripeProductA->id;  //local id, not stripe
		$stripePlanA->amount =1497;
		$stripePlanA->currency ="gbp";
		$stripePlanA->interval ="week";
		$stripePlanA->active =true;
		$stripePlanA->price_string ='£14.97 / box';
		$stripePlanA->size ="medium";
		$stripePlanA->title ='Waggy Tail Box';
		$stripePlanA->description ='A surprise box filled with doggie fun and happiness. Delivered to your pampered pooch every four weeks. Get those tails wagging!';
		$stripePlanA->img ='/img/box.png';


		$plan = \Stripe\Plan::create(array(
			"nickname" 	=> $stripePlanA->nickname,
			"product" 	=> $stripeProductA->stripe_id,
			"amount" 	=> $stripePlanA->amount,
			"currency" 	=> $stripePlanA->currency,
			"interval" 	=> $stripePlanA->interval,
			"interval_count"=>4
		));

		$stripePlanA->stripe_id =$plan->id;
		$stripePlanA->save();



/*


    	$stripeProductB = new \App\stripeProduct;
    	$stripeProductB->name = "Toys and Treats | Pampered Pooch Box | Monthly";
    	$stripeProductB->type = "service";


        $product =\Stripe\Product::create(array(
			"name" => $stripeProductB->name,
			"type" => "service",
		));

		$stripeProductB->stripe_id = $product->id;
		$stripeProductB->active = true;
		$stripeProductB->save();

		$stripePlanB = new \App\stripePlan;

		$stripePlanB->nickname ="Pampered Pooch Box plan";
		$stripePlanB->product_id =$stripeProductB->id;  //local id, not stripe
		$stripePlanB->amount =1499;
		$stripePlanB->currency ="gbp";
		$stripePlanB->interval ="month";
		$stripePlanB->size ="medium";
		$stripePlanB->price_string ='£14.99 / Month';
		$stripePlanB->active =true;
		$stripePlanB->title ='Pampered Pooch Box';
		$stripePlanB->description ='For the dogs that want a small selection of toys and treats, 100% excitement every month.';
		$stripePlanB->img ='/img/box.png';


		$plan = \Stripe\Plan::create(array(
			"nickname" 	=> $stripePlanB->nickname,
			"product" 	=> $stripeProductB->stripe_id,
			"amount" 	=> $stripePlanB->amount,
			"currency" 	=> $stripePlanB->currency,
			"interval" 	=> $stripePlanB->interval,
		));

		$stripePlanB->stripe_id =$plan->id;
		$stripePlanB->save();





    	$stripeProductC = new \App\stripeProduct;
    	$stripeProductC->name = "Toys and Treats | Ultimate Box | Monthly";
    	$stripeProductC->type = "service";


        $product =\Stripe\Product::create(array(
			"name" => $stripeProductC->name,
			"type" => "service",
		));

		$stripeProductC->stripe_id = $product->id;
		$stripeProductC->active = true;
		$stripeProductC->save();

		$stripePlanC = new \App\stripePlan;

		$stripePlanC->nickname ="ultimate box plan";
		$stripePlanC->product_id =$stripeProductC->id;  //local id, not stripe
		$stripePlanC->amount =1999;
		$stripePlanC->currency ="gbp";
		$stripePlanC->interval ="month";
		$stripePlanC->price_string ='£19.99 / Month';
		$stripePlanC->size ="large";
		$stripePlanC->active =true;

		$stripePlanC->title ='Ultimate Box';
		$stripePlanC->description ='Your dog will be spoilt for choice. More toys, more treats and nothing but the best.';
		$stripePlanC->img ='/img/box.png';


		$plan = \Stripe\Plan::create(array(
			"nickname" 	=> $stripePlanC->nickname,
			"product" 	=> $stripeProductC->stripe_id,
			"amount" 	=> $stripePlanC->amount,
			"currency" 	=> $stripePlanC->currency,
			"interval" 	=> $stripePlanC->interval,
		));

		$stripePlanC->stripe_id =$plan->id;
		$stripePlanC->save();

*/


    }
}
