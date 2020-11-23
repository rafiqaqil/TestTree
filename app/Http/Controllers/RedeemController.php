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
              $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.1;
              $TDM3 = 100;
            $balance = \App\Models\payment::where('user_id',$user->id)
                    ->where('DETAIL','REDEEM_DM3')
                    ->where('STATUS','!=','CANCELED')->sum('AMOUNT');;
            
            //dd($balance);
            
            if(($TDM3 - ($balance+ $data['AMOUNT'])) < 0)
                return \Illuminate\Support\Facades\Redirect::back()->withErrors(['Balance is not enough. Your balance is '.($TDM3 - $balance)]);
         
            $data['user_id']= $user->id;
            $data['DETAIL']= "REDEEM_DM3";
            $data['WAY']='OUT';
            
         //dd($data);
        
        
     $new =  \App\Models\payment::create($data);
     
     dd($new);
        
        
        return view('redeem.mywallet', compact('profile','user'));
    }
    
       
}
