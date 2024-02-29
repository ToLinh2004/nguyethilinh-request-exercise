<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterControlller extends Controller
{
    
    public function postRegister(Request $request){
        $allRequest=$request->all();
        return view('resultRegister',compact('allRequest'));
    }
}
