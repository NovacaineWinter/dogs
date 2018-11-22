<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactMessage extends Model
{
	
	protected $fillable =['message','fname','lname','email'];

    
	public function writeEmail(){
		return \View::make('emailTemplates.contactUsFormSubmitted',['message'=>$this])->render();
	}


    public function sendEmail(){

		$headers = array(
		  'From: "Toys and Treats" <hello@ToysAndTreats.co.uk>' ,
		  'Reply-To: "Toys and Treats" <hello@ToysAndTreats.co.uk>',
		  'X-Mailer: PHP/' . phpversion() ,
		  'MIME-Version: 1.0' ,
		  'Content-type: text/html; charset=iso-8859-1'
		);

		$headers = implode( "\r\n" , $headers );

		//alert the admin staff at NBC

		//$adminEmail = 'info@nottinghamboatco.com';
		$adminEmail = 'matt.v.hartley@gmail.com';
		$adminSubject = 'New message submitted on ToysandTreats.com';

		$adminMessage = $this->writeEmail();

		return mail($adminEmail,$adminSubject,$adminMessage,$headers);


    }
}
