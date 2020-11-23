<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedeemController extends Controller
{
    //Save Redeem on user profile -> D4
    public function __construct()
    {
        $this->middleware('auth');
    }
    
       public function index(){
               
         $user = auth()->user();   $profile = $user->profile()->first();
           
       
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.1;
          
       $redeemed = ($profile->D4 + 0);
          $FinalBalance = $TDM3 - $redeemed;
         //dd($FinalBalance);
                 return view('redeem.mywallet',compact('FinalBalance','profile','redeemed'));
           }
    
    public function create()
    {
        
          $user = auth()->user();   $profile = $user->profile()->first();

        return view('redeem.create', compact('profile','user'));
    }
    
    
      public function store()
    { $user = auth()->user();   $profile = $user->profile()->first();
            $data = request()->validate([

              'AMOUNT' => 'required|numeric',
              'TYPE' => 'required',
              
        ]);
         
         dd($data);
        
        
     $new = App\Models\payment::create([
         
                ]);
     
     dd($new);
        
        
        return view('redeem.mywallet', compact('profile','user'));
    }
    
       
}
