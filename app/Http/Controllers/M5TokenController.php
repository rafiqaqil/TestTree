<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class M5TokenController extends Controller
{
       public function index(){
               
                $user = auth()->user();   $profile = $user->profile()->first();
                
                 return view('M5.index',compact('profile'));
           }
}
