<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMasterView extends Controller
{
        
    
         public function __construct()
    {
        $this->middleware('auth');
    }
    
        public function index()
    {
         if ((auth()->user()->email_verified_at) == null) 
            return redirect('/home');    
            
          $user = auth()->user();
          
          
       $alldataApproved = \App\Models\Profile::all()->where('id','>',6);
       
        //dd($alldataApproved);
       
        $alldata = $alldataApproved;
        //dd($alldata);
           
        return view('audit.index',compact('alldata','user','alldataApproved'));      
    }
        
        public function showUser($userProfile)
    {
         if ((auth()->user()->email_verified_at) == null) 
            return redirect('/home');    
            
          $user = \App\Models\User::find($userProfile);
          
          //dd($user);
          
          
       $alldataApproved = \App\Models\Profile::find($userProfile);
       
       //dd($alldataApproved);
        //dd($alldataApproved);
       
        $alldata = $alldataApproved;
        //dd($alldata);
           
      
         $sponsorTotal = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');
 
        
        $DM5_IDs = \App\Models\DM5tree::all()->where('user_id',$user->id);
        $DM5_Bal =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
        
        $DM3_IDs = \App\Models\DM3tree::all()->where('user_id',$user->id);
        $DM3_Bal =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
        //dd('USD ',$Total*.8);
        
       $sponsored = \App\Models\Profile::all()->where('affiliate_sponsor',$user->username);
        //dd($sponsored);

        $Withdraw = \App\Models\widthdraw::all()->where('user_id',$user->id);
                
                
        return view('audit.ShowOne',compact('Withdraw','alldata','user','alldataApproved','DM5_IDs','DM5_Bal','DM3_IDs','DM3_Bal','sponsorTotal','sponsored'));      
    }
        public function ShowOneSponsorTree($userProfile)
      {
          
                       
         //dd($user);
         $aku = \App\Models\sponsor::all()->where('user_id',$userProfile)->first();
           
          $chart = \App\Models\sponsor::descendantsAndSelf($aku->id);

        $all = \App\Models\sponsor::descendantsAndSelf($aku->id)->count();
        //dd( $jsondata);
         $levels = \App\Models\sponsor::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('UserViews.SponsorGoogleTree', compact('all','levels','chart'));  
      }
      
      
    
    
    
}
