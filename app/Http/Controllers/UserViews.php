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
        
        
        $Total =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance');
        //dd('USD ',$Total*.8);
        return view('UserViews.indexDM3', compact('profile','user','Mine'));
    }
     public function OneOfMyDM3($TheDM3)
    {
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
        
        
        $Total =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance');
        //dd('USD ',$Total*.8);
        return view('UserViews.indexDM5', compact('profile','user','Mine'));
    }
         public function OneOfMyDM5($TheDM5)
    {
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
    
}
