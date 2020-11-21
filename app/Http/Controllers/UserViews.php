<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserViews extends Controller
{
     
       public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
 
     public function logoutNowToLink()
    {
        $user = auth()->user();
        $profile = $user->profile();
        $username = $user->username;
        auth()->logout();
        return redirect('/register/'.$username);
    }
    public function ShowMyDM3()
    {
        $user = auth()->user();
        $profile = $user->profile();
        $Mine = \App\Models\DM3tree::all()->where('user_id',$user->id);
        //dd($Mine);
        $Total =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
        
        $Redeem =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.1;
        
        
        //dd('USD ',$Total*.8);
        return view('UserViews.indexDM3', compact('profile','user','Mine','Total','Redeem'));
    }
     public function OneOfMyDM3($TheDM3)
    {
         
         $check = \App\Models\DM3tree::find($TheDM3)->user_id;
         $user = auth()->user();
         if($check != $user->id)
             return redirect('/ShowMyDM3');
             
         //dd($TheDM3);
        $shops = \App\Models\DM3tree::descendantsAndSelf($TheDM3)->toTree()->first();
        $jsondata = json_encode($shops);      
        $jsondata = trim($jsondata, '[]');
        
         $all = \App\Models\DM3tree::descendantsAndSelf($TheDM3)->count();
         $lastnode = \App\Models\DM3tree::descendantsAndSelf($TheDM3)->max('id');
         //dd($lastnode);
         $levels = \App\Models\DM3tree::withDepth()->find($lastnode);
        return view('UserViews.DM3MiniTree', compact('shops','jsondata','all','levels'));
    }
    
    
    
        
    public function ShowMyDM5()
    {
         
        
        $user = auth()->user();
        $profile = $user->profile()->first();
        
        
        $Mine = \App\Models\DM5tree::all()->where('user_id',$user->id);
        //dd($Mine);
        
        
        $Total =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
         
         if(isset($profile->D1))
         $RENTRIES_DONE = $profile->D1;
         else
             $RENTRIES_DONE = 0;
         
         //dd($RENTRIES_DONE*200);
         $reentry =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.2-($RENTRIES_DONE*200);
         
         if($profile->D2 == null)
         $REENTRY_STATUS = 1;
         else
         {
             if($profile->D2 >$profile->D1)
             {
                 $REENTRY_STATUS = 0;
             }
             else
             {
                 $REENTRY_STATUS = 1;
             }
             
         }
         
        //dd('USD ',$Total*.8);
        return view('UserViews.indexDM5', compact('profile','user','Mine','Total','reentry','REENTRY_STATUS'));
    }
    
    
    public function ApplyReentry()
    {
         return view('UserViews.redm5'); 
    }
    
     public function StoreReentry()
    {
         
          $user = auth()->user();
        $profile = $user->profile()->first();
        
         $data = request()->validate([
              'Type' => 'required',        
        ]);
         
         
         //dd($data);
             if($data['Type'] == 'USDT' ){
            \Illuminate\Support\Facades\Mail::raw('Reentry Request : '.$user->username."-  CHECK PAYMENT ON ".$data['Type']. ' ACCOUNT -- Phone :'. $user->phone."  email :".$user->email.'      USDT ACCOUNT :'.  $profile->usdt_wallet, function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("Reentry Request to USDT");
            });
           }else
           {
                \Illuminate\Support\Facades\Mail::raw('Reentry Request : '.$user->username."-  CHECK PAYMENT ON ".$data['Type']. ' ACCOUNT -- Phone :'. $user->phone."  email :".$user->email.'  Merchantrade ACCOUNT : ' .$profile->merchantrade_acc, function ($message){
            $message->to(env('NOTI_MAILBOX'))->subject("Reentry Request to Merchantrade");
            });
           }
           //D1 IS THE CREDITED AMMOUNT
            if(isset($profile->D1)){
         $RENTRIES_DONE = $profile->D1;
         $RENTRIES_pending = $profile->D1+1;
            }
         else{
             $RENTRIES_DONE = 0;
             $RENTRIES_pending = 1;
         }
           $profile['D1'] = $RENTRIES_DONE;
           //D2 IS THE PENDING REENTRY
          $profile['D2'] = $RENTRIES_pending;
           
           $profile->save();
           
           
           
         
          return redirect('/ShowMyDM5'); 
    }
    
    
    
    
    
         public function OneOfMyDM5($TheDM5)
    {
             
         $check = \App\Models\DM5tree::find($TheDM5)->user_id;
         $user = auth()->user();
         if($check != $user->id)
             return redirect('/ShowMyDM5');
         //dd($TheDM3);
        $shops = \App\Models\DM5tree::descendantsAndSelf($TheDM5)->toTree()->first();
        $jsondata = json_encode($shops);      
        $jsondata = trim($jsondata, '[]');
        
         $all = \App\Models\DM5tree::descendantsAndSelf($TheDM5)->count();
         $lastnode = \App\Models\DM5tree::descendantsAndSelf($TheDM5)->max('id');
         //dd($lastnode);
         $levels = \App\Models\DM5tree::withDepth()->find($lastnode);
        return view('UserViews.DM5MiniTree', compact('shops','jsondata','all','levels'));
    }
    
    
    
        
      public function ShowMySponsor()
      {
         $user = auth()->user();
        $profile = $user->profile();
           
         //dd($user);
         $Mine = \App\Models\sponsor::all()->where('user_id',$user->id)->first();
         $Total = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');
         $sponsorCount = \App\Models\sponsor::descendantsAndSelf($Mine->id)->count();
         //dd($sponsorCount);
        return view('UserViews.indexSponsor', compact('user','Mine','Total','sponsorCount'));
 
      }
      
         
      public function ShowMySponsorTree()
      {
          
                      $user = auth()->user()->id;
         //dd($user);
         $aku = \App\Models\sponsor::all()->where('user_id',$user)->first();
           
          $chart = \App\Models\sponsor::descendantsAndSelf($aku->id);

        $all = \App\Models\sponsor::descendantsAndSelf($aku->id)->count();
        //dd( $jsondata);
         $levels = \App\Models\sponsor::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('UserViews.SponsorGoogleTree', compact('all','levels','chart')); 
      }
      
    
    
}
