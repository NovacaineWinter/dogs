<?php

use Illuminate\Database\Seeder;

class cancellationReasonOptions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$reasons = array(
    		'Cutting back on expenses',
    		'Delivery not often enough',
    		'Does not represent good value for money',
    		'Dog does not like the treats',
    		'Not happy with customer service',
    		'Cancelling to take out another subscription',
    		'Taking a temporary break from the boxes',
    		'Moving to a competitor product',
    		'I do not have a dog anymore',
    		'Was a gift for someone else'
    	);

    	foreach($reasons as $reason){
    		$a = new \App\cancellationReasonOptions;
    		$a->name = $reason;
    		$a->save();
    	}
    }
}
