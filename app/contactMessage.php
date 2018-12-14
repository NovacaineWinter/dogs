<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \swiftmailer\swiftmailer;

class contactMessage extends Model
{
	
	protected $fillable =['message','fname','lname','email'];

    
	public function writeEmail(){
		return \View::make('emailTemplates.contactUsFormSubmitted',['message'=>$this])->render();
	}
    
	public function confirmEmail(){
		return \View::make('emailTemplates.confirmContactUsMessage',['message'=>$this])->render();
	}


    public function sendEmail(){	


    	//admin message
		try {

            $mandrill = new \Mandrill(env('MANDRILL_API_KEY'));

            $message = array(
                'text' => $this->writeEmail(),
                'subject' => 'New message submitted on ToysandTreats.co.uk',
                'from_email' => 'hello@toysandtreats.co.uk',
                'from_name' => 'The Team | Toys and Treats',
                'to' => array(
                    array(
                        'email' => 'hello@toysandtreats.co.uk',
                        'name' =>   'Admin',
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $this->email),
                'important' => true,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',             
            
            );

            $result = $mandrill->messages->send($message);

           
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }



        //confirm message to person contacting
		try {

            $mandrill = new \Mandrill(env('MANDRILL_API_KEY'));

            $message = array(
                'text' => $this->confirmEmail(),
                'subject' => 'Message submitted | Toys and Treats',
                'from_email' => 'hello@toysandtreats.co.uk',
                'from_name' => 'The Team | Toys and Treats',
                'to' => array(
                    array(
                        'email' => $this->email,
                        'name' =>   $this->fname.' '.$this->lname,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'hello@toysandtreats.co.uk'),
                'important' => true,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',             
            
            );

            $result = $mandrill->messages->send($message);

           
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }        


    }
}
