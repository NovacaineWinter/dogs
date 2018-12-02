<?php

use Illuminate\Database\Seeder;

class giftVouchers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oneBox  					= new \App\voucher;
        $oneBox->is_active 			= true;
        $oneBox->num_of_boxes 		= 1;
        $oneBox->price 				= 1497;
        $oneBox->price_string 		= '£14.97';
        $oneBox->title 				= 'Voucher for 1 Month';
        $oneBox->description 		= 'A single Toys and Treats box <br> &nbsp;';
        $oneBox->img 				= '/img/1box.png';        
        $oneBox->discount 			= '';
        $oneBox->save();


        
        $threeBoxes  				= new \App\voucher;
        $threeBoxes->is_active 		= true;
        $threeBoxes->num_of_boxes 	= 3;
        $threeBoxes->price 			= 4247;
        $threeBoxes->price_string 	= '£42.47';
        $threeBoxes->title 			= 'Voucher for 3 Months*';
        $threeBoxes->description 	= 'Three Toys and Treats boxes <br>*One box delivered every 4 weeks';
        $threeBoxes->img 			= '/img/3box.png'; 
        $threeBoxes->discount 		= '-5%';
        $threeBoxes->save();



        $sixBoxes  					= new \App\voucher;
        $sixBoxes->is_active 		= true;
        $sixBoxes->num_of_boxes 	= 6;
        $sixBoxes->price 			= 7997;
        $sixBoxes->price_string 	= '£79.97';
        $sixBoxes->title 			= 'Voucher for 6 Months*';
        $sixBoxes->description 		= 'Six Toys and Treats boxes <br>*One box delivered every 4 weeks';
        $sixBoxes->img 				= '/img/6box.png'; 
        $sixBoxes->discount 			= '-10%';
        $sixBoxes->save();
    }
}
