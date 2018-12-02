<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vuePublic extends Controller
{
    public function plans(Request $request){
    	return \App\stripePlan::where('active','=',1)->get();
    }

    public function subscribeNowForDeliveryOn(){
        //mirrored code in userSubscription Model
        $weekNumber = date('W');        
        $deliverySlot= (($weekNumber%4)+1)%4;

        $secondsInWeek = 7 * 24 * 60 * 60;
        $secondsToWednesdayMidday = ((24 * 2) + 12)* 60 * 60;
        $weekOfDelivery =  ((floor(($weekNumber)/4)*4 ) + $deliverySlot)-1;   //need to subtract 1 because week 1 is really week 0
        $secondsToStartOfWeek = $secondsInWeek * $weekOfDelivery;
        $secondsToDelivery = $secondsToStartOfWeek + $secondsToWednesdayMidday;

        $startOfYear = strtotime('01-01-'.date('Y').' 00:00:00');

        $deliveryTimestamp = $startOfYear + $secondsToDelivery;
        return date('D jS M Y',$deliveryTimestamp);
 
    }


    public function vouchers(){
        return \App\voucher::where('is_active','=',1)->get();
    }


    public function voucherCode(Request $request){

        if($request->has('code')){
            $voucher = \App\userVoucher::where('voucher_code','=',$request->get('code'))->first();
            if($voucher != ''){

                if($voucher->expired){
                    return view('voucherExpired');
                }elseif($voucher->is_redeemed){
                    return view('voucherAlreadyUsed');
                }else{
                    return view('voucherCode')->with('voucher',$voucher);
                }
            }else{
                return view('voucherNotFound');
            }
        }else{
            return view('voucherNotFound');
        }

    }
}
