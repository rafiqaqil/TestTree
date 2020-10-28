<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserViews extends Controller
{
     
       public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function ShowMyDM3()
    {
         
        
        $user = auth()->user();
        $profile = $user->profile();
        
        
        $Mine = \App\Models\DM3tree::all()->where('user_id',$user->id);
        //dd($Mine);
        
        
        $Total =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.9;
        //dd('USD ',$Total*.8);
        return view('UserViews.indexDM3', compact('profile','user','Mine','Total'));
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
        $profile = $user->profile();
        
        
        $Mine = \App\Models\DM5tree::all()->where('user_id',$user->id);
        //dd($Mine);
        
        
        $Total =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
        //dd('USD ',$Total*.8);
        return view('UserViews.indexDM5', compact('profile','user','Mine','Total'));
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
         //dd($Mine->logs);
        return view('UserViews.indexSponsor', compact('user','Mine','Total'));
        
        
        
       
        
 
          
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
