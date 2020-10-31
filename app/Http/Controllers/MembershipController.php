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
        $profile = $user->profile()->first();
        //dd($profile);
        return view('UserViews.mymembership', compact('profile','user'));  
    }
    
    
    
    public function ActivateAccount()
    { 
               
        $user = auth()->user();
        $profile = $user->profile;
      
        
        return view('UserViews.UnActivated', compact('profile','user'));
    }
    
    
      public function ConfirmPayment()
    {               
        $user = auth()->user();
        $profile = $user->profile;
      
         $temp = \App\Models\Profile::find($profile->id);
         $data = request()->validate(['payment_type' => 'required',]);
     
       $temp['payment_type']=$data['payment_type'];
       
       
        $temp->save();
       
        
         
        
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
