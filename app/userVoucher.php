<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use \swiftmailer\swiftmailer;
use Illuminate\Support\Str;

class userVoucher extends Model
{
	public function sendOutVoucher(){
		//send an email with the voucher code

		try {

			//$text= "Hi there!  \r\n\r\n Thanks for buying a Toys and Treats gift voucher, we think they make great gifts for any dog lover. \r\n\r\n We have attached your voucher in PDF form or you can view your voucher on the link below:  \r\n\r\n".url("voucher-code?code=".$this->voucher_code)." \r\n\r\n We hope they love their gift!  \r\n\r\n The team at Toys and Treats";

			$text= "Hi there!  \r\n\r\n Thanks for buying a Toys and Treats gift voucher, we think they make great gifts for any dog lover. \r\n\r\n Your voucher code is: ".$this->voucher_code.". You can view your voucher using the link below:  \r\n\r\n \r\n\r\n We hope they love their gift!  \r\n\r\n The team at Toys and Treats";

 			$mandrill = new \Mandrill(env('MANDRILL_API_KEY'));

            $message = array(
               /* 'html' => '<p>Example HTML content</p>',*/
                'text' => $text,
                'subject' => 'Gift Voucher Code | Toys and Treats',
                'from_email' => 'hello@toysandtreats.co.uk',
                'from_name' => 'The Team | Toys and Treats',
                'to' => array(
                    array(
                        'email' => $this->giver_email,
                        'name' =>'',
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
            echo $result;
           
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }


	}

	public function generateCode(){

		if($this->voucher_code == ''){
			$this->voucher_code = strtoupper(Str::random(6));
			$this->save();		
		}		
	}

	public function generatePDF(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		    CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => json_encode(array("source" => url('/voucher-code?code='.$this->voucher_code), "landscape" => false, "use_print" => false)),		   
		    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
		    CURLOPT_USERPWD => env('PDF_API_KEY')
		));

		$response = curl_exec($curl);	
	
		Storage::put('public/'.$this->voucher_code.'.pdf', $response);
		$this->pdf = Storage::url('public/'.$this->voucher_code.'.pdf');
		$this->save();
	}
}
