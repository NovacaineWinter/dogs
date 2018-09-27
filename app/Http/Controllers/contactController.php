<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactController extends Controller
{
    public function receiveMessage(Request $request){

    	$this->validate(request(),[
    		'fname'		=>	'required',
    		'lname'		=>	'required',
    		'email'		=>	'required|email',
    		'message'	=>	'required'
    	]);

    	$message = \App\contactMessage::create([
    		'fname'=>$request->get('fname'),
    		'lname'=>$request->get('lname'),
    		'email'=>$request->get('email'),
    		'message'=>$request->get('message')
    	]);
    	$message->sendEmail();

    	return 'ok';
    }
}
