<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \DrewM\MailChimp\MailChimp;
use \swiftmailer\swiftmailer;
use App\Traits\Excludable;

class User extends Authenticatable
{
    use Excludable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];





    //basic relations - used programatically 

    public function notifications(){
        return $this->hasMany('\App\userNotification','user_id');
    }

    public function subscriptions(){
        return $this->hasMany('\App\userSubscription','user_id');
    }

    public function stripeEvents(){
        return $this->hasMany('\App\stripeEvent','user_id');
    }

    public function paymentMethods(){
        return $this->hasMany('\App\userPaymentSource','user_id');
    }

    public function redeemedVouchers(){
        return $this->hasMany('\App\userVoucher','redeemer_id');
    }





/* for front end users */

    public function pendingSubscriptions(){
        return $this->subscriptions()->where('has_been_activated','=',0)->exclude(['stripe_id','has_been_activated','is_active','created_at','updated_at']);
    }

    public function myEvents(){
        return $this->stripeEvents()->exclude('typeReference');
    }

    public function myPaymentMethods(){
        return $this->paymentMethods()->exclude(['stripe_id']);
    }

    public function myPrimaryPaymentMethod(){
        return $this->hasMany('\App\userPaymentSource','user_id')->where('default','=',1)->exclude(['stripe_id']);
    }

    public function activeSubscriptions(){
        return $this->subscriptions()->where('is_active','=',1)->exclude(['stripe_id','has_been_activated','is_active','created_at','updated_at']);
    }

    public function activeNotifications(){
        return $this->notifications()->where('is_unread','=',1)->exclude(['stripe_id','created_at','updated_at']);
    }

    public function cancellationReasons(){
        return $this->hasMany('\App\cancellationReason','user_id');
    }

    public function invoices(){
        return $this->hasManyThrough('\App\userInvoice','\App\userSubscription','user_id','subscription_id');
    }

    public function myInvoices(){
        return $this->invoices();
        //return $this->invoices()->exclude(['stripe_id']);
    }





/*  
    Account Status stuff ==============================================================

    0  =  not yet active
    1  =  active and up to date
    2  =  Delinquent on payments
    3  =  no active subscriptions
*/

    public function activate(){
        $this->account_status = 1;
        $this->save();
    }
    
    public function isDelinquent(){
        $this->account_status = 2;
        $this->save();    
    }


/*
=========================================================================================
*/




    public function updatePaymentSources($sources){
        foreach($sources as $source){
            if($this->paymentMethods()->where('stripe_id','=',$source['id'])->get()->isEmpty()){
                $this->paymentMethods()->create(array(
                    'stripe_id' =>$source['id'],
                    'lastFour'  =>$source['last4'],
                    'exp_month' =>$source['exp_month'],
                    'exp_year'  =>$source['exp_year'],
                    'brand'     =>$source['brand']
                ));
            }
        }
    }

/*
==========================================================================================
==========================================================================================
==========================================================================================
==========================================================================================
                                    ******     Emails ******

*/

    public function notifyExpiringPaymentMethod($stripeEvent){
        $this->notifications()->create(array(
            'stripe_id'=>$stripeEvent->id,
            'title' =>'Payment Method Expiring Soon'
        ));
        $subject = 'Payment Method Expiring Soon | Toys and Treats';
        $message = 'Hi '.$this->firstName.", \r\n\r\n Hope your dog is enjoying Toys and Treats, we have noticed that the card details you have saved for your Toys and Treats subscription is about to expire. Could you spare a moment to log in and update your payment method so that your subscription is uninterrupted. \r\n\r\n You can do this by logging in to your account on  \r\n\r\n https://toysandtreats.co.uk/login \r\n\r\n Thanks for your time, \r\n\r\n The team at Toys and Treats";
        $this->email($subject,$message);
    }

    public function alertUpcomingPayment(){
        $subject = 'Upcoming Payment | Toys and Treats';
        $message = 'Hi '.$this->firstName.", \r\n\r\n Hope your dog is enjoying Toys and Treats, we just thought we would drop you an email to tell you that payment for your next box is about to come out of your account, this means your dog is soon to get their gift box delivery. Exciting times!. You don't need to do anything, everything will be taken care of for you.\r\n\r\n You can view the details we have on file for you by logging in to your account on  \r\n\r\n https://toysandtreats.co.uk/login \r\n\r\n Hope your dog loves their next delivery, \r\n\r\n The team at Toys and Treats";
        $this->email($subject,$message);
    }
    
    public function alertPaymentFailed($stripeEvent){
        $this->notifications()->create(array(
            'stripe_id'=>$stripeEvent->id,
            'title' =>'Payment Failed'
        ));

        $subject = 'Card Payment Failed | Toys and Treats';
        $message = 'Hi '.$this->firstName.", \r\n\r\n Hope your dog is enjoying Toys and Treats, Unfortunatley we have not been able to process payment for your upcoming gift box, can you spare a moment to check the card details we have on file for you? We won't be able to dispatch your next delivery until the payment has succeeded.  \r\n\r\n You can do this by logging in to your account on  \r\n\r\n https://toysandtreats.co.uk/login \r\n\r\n Really hope this doesn't cause too much inconvenience, \r\n\r\n The team at Toys and Treats";
        $this->email($subject,$message);
    }

    public function sendWelcomeEmail($subscription){
        $subject = 'Welcome to Toys and Treats';
        $message = 'Hi '.$this->firstName.", \r\n\r\n We are very happy to welcome you to Toys and Treats. We're sure that ".$subscription->dog_name." must be very excited to recieve their first gift box. \r\n\r\n You can log in to your account at any time by visiting toysandtreats.co.uk and clicking login at the top of the page or by visiting the following link \r\n\r\n https://toysandtreats.co.uk/login \r\n\r\n Your first box is scheduled for dispatch on ".$subscription->nextDispatchString().".  \r\n\r\n If you have any questions, queries or just want to talk dogs, message us at hello@toysandtreats.co.uk or message us on social media. \r\n\r\n Wishing your dog the very happiest of times,  \r\n\r\n The team at Toys and Treats";
        $this->email($subject,$message);
    }


    public function subscriptionCancelEmail($subscription){
        $subject = 'Subscription Cancelled | Toys and Treats';
        $message = 'Hi '.$this->firstName.", \r\n\r\n this is a quick email to confirm that your subscription for ".$subscription->dog_name." has been cancelled. We do hope that you have enjoyed receiving Toys and Treats boxes and hope to see you again in the future.  \r\n\r\n Best Wishes, \r\n\r\n The team at Toys and Treats.";
        $this->email($subject,$message);
    }



/*
==========================================================================================
==========================================================================================
==========================================================================================
==========================================================================================
*/


    public function checkForActiveSubscriptions(){
        $active = false;
        foreach($this->subscriptions() as $sub){
            if($sub->is_active){
                $active = true;
            }
        }
        if(!$active){
            $this->account_status = 3;
        }
    }

    public function setDefaultCard($card_id){
        foreach($this->paymentMethods()->get() as $card){
            if($card->stripe_id == $card_id){
                $card->default = true;                
            }else{
                $card->default = false;                                
            }
            $card->save();
        }
    }

    public function subscripeToMailchimpList($plan,$dog){

        switch($dog['size']){
            case 1:
                $dog_size_name = 'Small Dog';
                break;
            case 2:
                $dog_size_name = 'Medium Dog';
                break;
            case 3:
                $dog_size_name = 'Large Dog';
                break;
        }

        $mailchimp = new MailChimp(env('MAILCHIMP_API_KEY'));

        $mailchimp_list_id = env('MAILCHIMP_LIST_ID');

        $result = $mailchimp->post("lists/".$mailchimp_list_id."/members", [
            'email_address' =>  $this->email,
            'first_name'    =>  $this->firstName,
            'last_name'     =>  $this->lastName,
            'dog_size_name' =>  $dog_size_name,
            'plan_name'     =>  $plan->title,
            'status'        =>  'subscribed',
        ]);


        if($mailchimp->success()){
            $this->subscribed_to_mailchimp=true;
        }else{
            $this->subscribed_to_mailchimp=false;
        }
        $this->save();
    }

  

    public function email($subject,$text){
        try {

            $mandrill = new \Mandrill(env('MANDRILL_API_KEY'));

            $message = array(
               /* 'html' => '<p>Example HTML content</p>',*/
                'text' => $text,
                'subject' => $subject,
                'from_email' => 'hello@toysandtreats.co.uk',
                'from_name' => 'The Team | Toys and Treats',
                'to' => array(
                    array(
                        'email' => $this->email,
                        'name' =>   $this->firstName.' '.$this->lastName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'hello@toysandtreats.co.uk'),
                'important' => false,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',             
            
            );

/*            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = 'example send_at';*/
            //$result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
            $result = $mandrill->messages->send($message);

           
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }
}
