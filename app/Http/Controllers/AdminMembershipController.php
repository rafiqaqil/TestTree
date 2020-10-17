<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;

class AdminMembershipController extends Controller
{
  
        public function manageNewPlans()
    {
         
        $alldataApproved = Profile::all()->where('membership_paid',1);
        //dd($alldataApproved);
           $user = auth()->user();
           $alldata = Profile::all()->where('membership_paid',0)->where('membership_type','!=',0);
           
           //dd($alldata);
           return view('admin.newplans',compact('alldata','user','alldataApproved'));       
    
        
    }
    
    
     public function ApprovePlanPayment(Profile $profile)
     {
         //dd($profile);
         $profile['membership_paid']=1;
         //dd($temp['membership_type']);
        $profile->save();
          
           return redirect('/manageNewPlans');       
    
        
    }
}
