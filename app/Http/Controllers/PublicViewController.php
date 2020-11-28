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
          $data6 = \App\Models\sponsor::all();
          
         /// dd($data6);
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
          
         
               
               

        return view('publicview.index', compact('dataToShow','data3','data5','users','TotalEarnings','TotalW','pool','data6','random','topsponsor'));  
    }
}
