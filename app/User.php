<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \DrewM\MailChimp\MailChimp;
use \swiftmailer\swiftmailer;
//include_once "swift_required.php";
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
            if($this->paymentMethods()->where('stripe_id','=',$source['id'])->count()==0){
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


    public function notifyExpiringPaymentMethod($stripeEvent){
        $this->notifications()->create(array(
            'stripe_id'=>$stripeEvent->id,
            'title' =>'Payment Method Expiring Soon'
        ));

        //send email
    }

    public function alertUpcomingPayment(){

    }
    
    public function alertPaymentFailed($stripeEvent){
        $this->notifications()->create(array(
            'stripe_id'=>$stripeEvent->id,
            'title' =>'Payment Failed'
        ));

        //send email
    }


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



   /* public function email_smtp($subject,$text){

     
        //*   Needs swiftmail package from composer
       

        $from = array('hello@toysandtreats.com' =>'The Team | Toys and Treats');
        
     
        
        $to = $this->email;
        $html = "<em>Mandrill speaks <strong>HTML</strong></em>";

        $transport = new \Swift_SmtpTransport('smtp.mandrillapp.com', 587);
        $transport->setUsername(env('MANDRILL_USERNAME'));
        $transport->setPassword(env('MANDRILL_PASSWORD'));
        $swift = new \Swift_Mailer($transport);

        $message = new \Swift_Message($subject);
        $message->setFrom($from);
        $message->setBody($html, 'text/html');
        $message->setTo($to);
        $message->addPart($text, 'text/plain');

        if ($recipients = $swift->send($message, $failures))
        {
            echo 'Message successfully sent!';
        } else {
            echo "There was an error:\n";
            print_r($failures);
        }
    }

*/


    public function email($subject,$text){
        try {

            $mandrill = new \Mandrill(env('MANDRILL_API_KEY'));

            $message = array(
                'html' => '<p>Example HTML content</p>',
                'text' => $text,
                'subject' => $subject,
                'from_email' => 'hello@toysandtreats.com',
                'from_name' => 'The Team | Toys and Treats',
                'to' => array(
                    array(
                        'email' => $this->email,
                        'name' =>   $this->firstName.' '.$this->lastName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'hello@toysandtreats.com'),
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
            print_r($result);
            /*
            Array
            (
                [0] => Array
                    (
                        [email] => recipient.email@example.com
                        [status] => sent
                        [reject_reason] => hard-bounce
                        [_id] => abc123abc123abc123abc123abc123
                    )
            
            )
            */
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }
}
