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
         
        $user = auth()->user();
        $profile = $user->profile();
        //dd($profile);
        
        return view('membership.index', compact('profile','user'));
    
        
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
        return view('membership.index', compact('profile','user'));  
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
        return view('membership.index', compact('profile','user'));  
    }
    
        public function buyMembershipX5()
       { 
        $user = auth()->user();
        $profile = $user->profile->id;
        $temp = \App\Models\Profile::find($profile);
        $temp['membership_type']=1000;
         //dd($temp['membership_type']);
        $temp->save();
       $profile = $temp;
        return view('membership.index', compact('profile','user'));  
    }
       public function buyMembershipClear()
       { 
        $user = auth()->user();
        $profile = $user->profile->id;
        $temp = \App\Models\Profile::find($profile);
        $temp['membership_type']=0;
         //dd($temp['membership_type']);
        $temp->save();
         $profile = $temp;
        return view('membership.index', compact('profile','user'));  
    }
    
    
}
