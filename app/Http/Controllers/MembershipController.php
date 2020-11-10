<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    
      public function index()
    {
         
        $FinalBalance = self::checkWallet();
        //dd($FinalBalance);
        $user = auth()->user();
        $profile = $user->profile()->first();
        //dd($profile);
        return view('UserViews.mymembership', compact('profile','user','FinalBalance'));  
    }
    
    
        public function checkWallet()
    {         
            $user = auth()->user();   $profile = $user->profile()->first();
         
           //dd($profile);
         $alldata =    \App\Models\widthdraw::all()->where('user_id',$user->id)->where('STATUS','=',0);
         $alldataApproved =     \App\Models\widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',0);
         $Negative =     \App\Models\widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
          $TDM5 =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.9;
          $TSPN = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');    
          $transfersIN = \App\Models\transfer::all()->where('to_user_id',$user->id)->where('STATUS','==',1)->sum('AMOUNT');
          $transfersOUT = \App\Models\transfer::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
         $Transfers = $transfersIN -$transfersOUT;
          $FinalBalance = $TDM5+ $TDM3 +$TSPN + $transfersIN - $transfersOUT- $Negative;
     
        return $FinalBalance; 
    }
    
    public function ActivateAccount()
    { 
                $FinalBalance = self::checkWallet();
        $user = auth()->user();
        $profile = $user->profile;
      
        
        return view('UserViews.UnActivated', compact('profile','user','FinalBalance'));
    }
    
    
      public function ConfirmPayment()
    {               
        $user = auth()->user();
        $profile = $user->profile;
      
         $temp = \App\Models\Profile::find($profile->id);
         $data = request()->validate(['payment_type' => 'required',]);
     
       $temp['payment_type']=$data['payment_type'];
       
       
        $temp->save();
        
        
        //echo $temp['payment_type'];
        
      
        
        
               if($temp['placement_payment_type'] == 'USDT'){
            //dd('Success');
            \Illuminate\Support\Facades\Mail::raw('Activation Payment : '.$user->username."-".$data['payment_type']. ' -- '.$profile->membership_type.'  Phone :'. $user->phone."  email :".$user->email.'      USDT ACCOUNT :'.$profile->usdt_wallet , function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("Activation Payment USDT");
            });
        }
        else
        {
             //dd('Success');
            \Illuminate\Support\Facades\Mail::raw('Activation Payment  : '.$user->username."-".$data['payment_type']. ' -- '.$profile->membership_type.'  Phone :'. $user->phone."  email :".$user->email.'      MERCHANTRADE ACCOUNT :'.$profile->merchantrade_acc, function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("Activation Payment MERCHANTRADE");
            });
            
        }
         //dd('Nope');
          
        
      return redirect('/ActivateAccount');
    }
    
    
    
      public function ConfirmPlacementPayment()
    {               
        $user = auth()->user();
        $profile = $user->profile;
      
         $temp = \App\Models\Profile::find($profile->id);
         $data = request()->validate(['placement_payment_type' => 'required',]);
       
       $temp->placement_payment_type=$data['placement_payment_type'];
         //dd($temp);
       
       
        $temp->save();
       
        
         //echo $temp['payment_type'];
        
        if($temp['placement_payment_type'] == 'USDT'){
            //dd('Success');
            \Illuminate\Support\Facades\Mail::raw('Plan Payment  : '.$user->username."-".$data['placement_payment_type']. ' -- '.$profile->membership_type.'  Phone :'. $user->phone."  email :".$user->email.'      USDT ACCOUNT :'.$profile->usdt_wallet , function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("Plan Payment USDT");
            });
        }
        else
        {
             //dd('Success');
            \Illuminate\Support\Facades\Mail::raw('Plan Payment  : '.$user->username."-".$data['placement_payment_type']. ' -- '.$profile->membership_type.'  Phone :'. $user->phone."  email :".$user->email.'      MERCHANTRADE ACCOUNT :'.$profile->merchantrade_acc, function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("Plan Payment MERCHANTRADE");
            });
            
        }
        
        
        
         //dd('Nope');
         
        
      return redirect('/MyMembership');
    }
    
    public function buyMembershipX()
    { 
        $user = auth()->user();
        $profile = $user->profile->id;
        $temp = \App\Models\Profile::find($profile);
        $temp['membership_type']=10;
         //dd($temp['membership_type']);
        $temp->save();
          $profile = $temp;
        //return view('membership.index', compact('profile','user'));  
          return redirect('/MyMembership');
    }
        public function buyMembershipX1()
       { 
        $user = auth()->user();
        $profile = $user->profile->id;
        $temp = \App\Models\Profile::find($profile);
        $temp['membership_type']=200;
         //dd($temp['membership_type']);
        $temp->save();
         $profile = $temp;
        //return view('membership.index', compact('profile','user'));
             return redirect('/MyMembership');
    }
    
        public function buyMembershipX5()
       { 
        $user = auth()->user();
        $profile = $user->profile->id;
        $temp = \App\Models\Profile::find($profile);
        $temp['membership_type']=1200;
         //dd($temp['membership_type']);
        $temp->save();
       $profile = $temp;
        //return view('membership.index', compact('profile','user'));  
            return redirect('/MyMembership');
    }
       public function buyMembershipClear()
       { 
        $user = auth()->user();
        $profile = $user->profile->id;
        $temp = \App\Models\Profile::find($profile);
        
        
        if($temp->membership_paid==0){
            $temp['membership_type']=0;
         //dd($temp['membership_type']);
        $temp->save();
        }
        
         $profile = $temp;
       // return view('membership.index', compact('profile','user'));  
             return redirect('/MyMembership');
    }
    
    
    
    
      public function UpdateSponsor(\App\Models\Profile $profile)
    { 
        $user = auth()->user();
    
            $data = request()->validate([

              'affiliate_sponsor' => 'exists:users,username']);
           
            
            
            
            
            
        $profile['affiliate_sponsor']=$data['affiliate_sponsor'];
         //dd($temp['membership_type']);
        $profile->save();
        return redirect('/MyMembership');
        //return view('UserViews.mymembership', compact('profile','user'))->with('message', 'Successfully Updated!');;  
    }
}
