<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicViewController extends Controller
{
      public function index()
    {
          
          $maxid = \App\Models\User::max('id');
          
          //dd($maxid);
           $dataToShow =  \Illuminate\Support\Facades\DB::table('users')
                   ->where('users.id','>=',$maxid-6)
                   ->join('profiles','users.id','=','profiles.user_id')
                   ->select('country','username','profiles.id','profiles.name','users.created_at')->orderBy('users.created_at', 'DESC')->get();
           
           //dd($dataToShow);
           
          
          $data3 = \App\Models\DM3tree::all();
          $data5 = \App\Models\DM5tree::all();
          
          $redeem = \App\Models\DM3tree::all()->sum('balance')*0.10;
          $reentry = \App\Models\DM5tree::all()->sum('balance')*0.20;
          $data6 = \App\Models\sponsor::all();
          
         //dd($data3->first(),$data3->count(),$data3->count(),$redeem,$reentry);
           
           //$topsponsor = \App\Models\sponsor::orderBy('balance','DESC')->where('user_id','>=','8')->take(10)->get();
           
           
             $topsponsor = \Illuminate\Support\Facades\DB::select('select * from sponsors WHERE user_id > 11  AND  CAST(logs as SIGNED INTEGER) >= 400 AND  CAST(logs as SIGNED INTEGER) != 1200 ORDER BY CAST(logs as SIGNED INTEGER) DESC  LIMIT 10');
             //dd($newss);
             
             
          //dd($groupsale);
          $users = \App\Models\User::orderBy('created_at','desc')->take(10)->get('username');
          $TotalEarnings = \App\Models\Profile::all()->sum('membership_type');
          $TotalW = \App\Models\widthdraw::all()->sum('AMOUNT');
          
         //dd("All Data To show is here, " ,$data3,$data5,$users,$dataToShow); 
                 
          $pool = \App\Models\Profile::where('affiliate_paid','1')->where('membership_type' , '1200')->get()->shuffle();
          
          $random = 117;
          
         
               
               

        return view('publicview.index', compact('dataToShow','data3','data5','users','TotalEarnings','TotalW','pool','data6','random','topsponsor','redeem','reentry'));  
    }
    
    
    
    
     public function AdminFullView()
    {
         if (auth()->user() == null) 
            return redirect('/login'); 
    
    
            if ((auth()->user()->email_verified_at) == null) 
            return redirect('/home');   
          $maxid = \App\Models\User::max('id');
          
          //dd($maxid);
           $dataToShow =  \Illuminate\Support\Facades\DB::table('users')
                   ->where('users.id','>=',$maxid-6)
                   ->join('profiles','users.id','=','profiles.user_id')
                   ->select('country','username','profiles.id','profiles.name','users.created_at')->orderBy('users.created_at', 'DESC')->get();
           
           //dd($dataToShow);
           
          
          $data3 = \App\Models\DM3tree::all();
          $data5 = \App\Models\DM5tree::all();
          
          $redeem = \App\Models\DM3tree::all()->sum('balance')*0.10;
          $reentry = \App\Models\DM5tree::all()->sum('balance')*0.20;
          $data6 = \App\Models\sponsor::all();
           $sponsorPayable = \App\Models\sponsor::all()->sum('balance');
            $groupsaleTotal = \App\Models\sponsor::all()->sum('logs');
           //dd($sponsorPayable);
         //dd($data3->first(),$data3->count(),$data3->count(),$redeem,$reentry);
           
           //$topsponsor = \App\Models\sponsor::orderBy('balance','DESC')->where('user_id','>=','8')->take(10)->get();
           
           
             $topsponsor = \Illuminate\Support\Facades\DB::select('select * from sponsors WHERE user_id > 11  AND  CAST(logs as SIGNED INTEGER) >= 400 AND  CAST(logs as SIGNED INTEGER) != 1200 ORDER BY CAST(logs as SIGNED INTEGER) DESC  LIMIT 10');
             //dd($newss);
             
             
          //dd($groupsale);
          //11 SPECIAL USERS ARE NOT PAYING THE MEBERSHIP SO IT DOESNT COUNT
          $users = \App\Models\User::orderBy('created_at','desc')->take(10)->get('username');
          $TotalEarnings = \App\Models\Profile::all()->where('user_id','>',11)->where('membership_paid','1')->sum('membership_type');
          $TotalW = \App\Models\widthdraw::all()->where('STATUS','==',100)->sum('AMOUNT');
          
         //dd("All Data To show is here, " ,$data3,$data5,$users,$dataToShow); 
                 
          $pool = \App\Models\Profile::where('affiliate_paid','1')->where('membership_type' , '1200')->get()->shuffle();
          
          $random = 117;
          
         
               
               

        return view('publicview.AdminFullView', compact('dataToShow','data3','data5','users','TotalEarnings','TotalW','pool','data6','random','topsponsor','redeem','reentry','sponsorPayable','groupsaleTotal'));  
    }
}
