<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(seedStripe::class);
        $this->call(cancellationReasonOptions::class);
    	$this->call(giftVouchers::class);
    }
}
