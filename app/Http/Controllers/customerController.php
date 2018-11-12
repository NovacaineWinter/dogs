<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class customerController extends Controller
{


/*
    ===============================================================================
    ==========================   Raw Data API stuff   =============================
    ===============================================================================
*/


    public function allCancellationReasons(){
        return \App\cancellationReasonOptions::where('is_active','=',1)->get();
    }


    public function logout(){
        if(\Auth::check()){
            \Auth::logout();
            return 'ok';
        }else{
            return 'already logged out';
        }
    }

    public function loggedInDetails(Request $request){
        if(\Auth::check()){

            $u = \App\User::find($request->user()->id);

            return $u::with([
                'pendingSubscriptions',
                'activeSubscriptions.planPublic',
                'activeNotifications',
                'myPaymentMethods',
                'myInvoices',
                'myEvents',
                'myPrimaryPaymentMethod'

            ])->exclude([
                'subscribed_to_mailchimp',
                'account_status',
                'stripe_id',
                'created_at',
                'updated_at'

            ])->where('id','=',$request->user()->id)->first();
        }
    }



/*
    ===============================================================================
    ==========================   Update API stuff        ==========================
    ===============================================================================
*/



    public function makeCardPrimary(Request $request){

        $this->validate(request(),[
            'userId'    =>  'required',
            'cardId'    =>  'required'  
        ]);

        if (\Auth::check()){
            // The user is logged in...
            if(\Auth::user()->id == $request->get('userId')){
                foreach(\App\User::find(1)->paymentMethods()->get() as $card){

                    if($card->id == $request->get('cardId')){                    
                        $card->default=true;
                        $card->save();
                    }else{
                        $card->default=false;
                        $card->save();
                    }
                }
                return 'ok';
            }else{
                abort(500);
                //something nefarious going on
            }
        }
    }

    public function deleteCard(Request $request){
         $this->validate(request(),[
            'userId'    =>  'required',
            'cardId'    =>  'required'  
        ]);
        if (\Auth::check()){
            // The user is logged in...
            if(\Auth::user()->id == $request->get('userId')){
                $card = \App\userPaymentSource::find($request->get('cardId'));
                $card->delete();
                return 'ok';
            }
        }
    }

    public function updateDogDetails(Request $request){

        if($request->has('dog_name') && $request->has('dog_size') && $request->has('sub_id')){
            $sub = \App\userSubscription::find($request->get('sub_id'));
            $sub->dog_size = $request->get('dog_size');
            $sub->dog_name = $request->get('dog_name');
            $sub->save();
            return 'ok';
        }else{
            abort(420);
        }
    }

    public function addSubscriptionToAccount(Request $request){
        $this->validate(request(),[
            'userId' =>  'required',
            'dogName'    =>  'required',            
            'dogSize'    =>  'required',            
            'planId'    =>  'required'            
        ]);

        if (\Auth::check()){
            // The user is logged in...
            if(\Auth::user()->id == $request->get('userId')){

                $user = \App\User::find($request->get('userId'));

                $plan = \App\stripePlan::find($request->get('planId'));

                \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));

                try {

                  
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
                $sub            = new \App\userSubscription;
                $sub->stripe_id = $subscription->id;
                $sub->user_id   = $user->id;
                $sub->plan_id   = $plan->id;
                $sub->dog_name  = $request->get('dogName');
                $sub->dog_size  = $request->get('dogSize');
                $sub->save();


            }else{
                //naughty naughty, someone is trying to play games
                abort(500);
            }
        }
    }


    public function cancelSubscription(Request $request){
        //verification of data
        $this->validate(request(),[
            'reason_id' =>  'required',
            'sub_id'    =>  'required'            
        ]);


        //sort out internal stuff - record the reason why
        $sub = \App\userSubscription::find($request->get('sub_id'));
        $sub->user()->first()->cancellationReasons()->create(array(
            'reason_id'=>$request->get('reason_id'),
            'plan_id'  =>$sub->plan_id
        ));  
        $sub->is_active=0;
        $sub->save();

        return 'ok';
        //sort out stripe
        /*\Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));
        $subscription = \Stripe\Subscription::retrieve($sub->stripe_id);
        $subscription->cancel();
*/
        //the webhook should take care of the rest

    }

    

    public function updateUser(Request $request){
        $this->validate(request(),[
            'userId'=>  'required',  
            'firstName' =>  'required',           
            'lastName' =>  'required',           
            'lineOne' =>  'required',           
            'lineTwo' =>  'required',           
            'lineThree' =>  'required',           
            'city' =>  'required',           
            'county' =>  'required',           
            'postcode' =>  'required',           
        ]);         

        $user = \App\User::find($request->get('userId'));
        $user->firstName = $request->get('firstName');
        $user->lastName = $request->get('lastName');
        $user->lineOne = $request->get('lineOne');
        $user->lineTwo = $request->get('lineTwo');
        $user->lineThree = $request->get('lineThree');
        $user->city = $request->get('city');
        $user->county = $request->get('county');
        $user->postcode = $request->get('postcode');
        $user->name = $request->get('firstName').' '.$request->get('lastName');
        $user->save();
        
    }



/*
    ===============================================================================
    ==========================   Signup stuff         =============================
    ===============================================================================
*/    



    public function checkEmail(Request $request){
        if($request->has('email')){

            if(\App\User::where('email','=',$request->get('email'))->count()==0){
                return 'ok';
            }else{
                abort(499);
            }
        }else{
            abort(420); 
        }
    }

    public function signup(Request $request){
        $this->validate(request(),[
            'dogName'       =>  'required',
            'dogSize'       =>  'required',
            'firstName'     =>  'required',
            'lastName'      =>  'required',
            'email'         =>  'required|email',           
            'password'      =>  'required',
            'lineOne'       =>  'required',         
            'postcode'      =>  'required',
            'stripeData'    =>  'required',
            'planSelected'  =>  'required',
        ]);
        

        
        $plan = \App\stripePlan::find($request->get('planSelected'));

        $dog = array(
            'name'  =>  $request->get('dogName'),
            'size'  =>  $request->get('dogSize')
        );

        $user = new \App\User;
        $user->name         = $request->get('firstName').' '.$request->get('lastName');
        $user->firstName    = $request->get('firstName');
        $user->lastName     = $request->get('lastName');
        $user->email        = $request->get('email');
        $user->password     = \Hash::make($request->get('password'));       
        $user->lineOne      = $request->get('lineOne');
        $user->lineTwo      = $request->get('lineTwo');
        $user->lineThree    = $request->get('lineThree');
        $user->city         = $request->get('city');
        $user->county       = $request->get('county');
        $user->postcode     = $request->get('postcode');
        $user->stripe_id    = 'tba';
        $user->save();

        $user->subscripeToMailchimpList($plan,$dog);

        $stripe = new \App\Http\Controllers\stripeController;

        $stripe->createNewSubscription($user,$plan,$dog,$request->get('stripeData'));    

        return $stripe->status;
    }




}
