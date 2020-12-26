<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class M5TokenController extends Controller
{
       public function index(){
               
                $user = auth()->user();   $profile = $user->profile()->first();
                $FinalBalance = $profile->membership_type*10;
                 return view('m5token.index',compact('FinalBalance','profile'));
           }
}
