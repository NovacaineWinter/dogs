<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminUser extends Model
{
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
                        'name' =>   'Admins',
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

            $result = $mandrill->messages->send($message);

           
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }
}
