<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vuePublic extends Controller
{
    public function plans(Request $request){
    	return \App\stripePlan::where('active','=',1)->get();
    }
}
