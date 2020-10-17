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
        $profile = $user->profile();
        
        dd($profile->membership_type);
        $profile->membership_type=10;
        $profile->save();
        return view('membership.index', compact('profile','user'));  
    }
        public function buyMembershipX1()
    { 
           $user = auth()->user();
        $profile = $user->profile();
        
        dd($profile);
        $profile->membership_type=10;
        $profile->save();
        return view('membership.index', compact('profile','user'));  
    }
    
        public function buyMembershipX5()
    { 
        $user = auth()->user();
        $profile = $user->profile();
        $profile["membership_type"]=1000;
        $profile->save();
        return view('membership.index', compact('profile','user'));  
    }
    
    
    
}
