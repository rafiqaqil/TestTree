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
                   ->select('country','username','profiles.id','profiles.name')->get();
           
          
          $data3 = \App\Models\DM3tree::all();
          $data5 = \App\Models\DM5tree::all();
          $data6 = \App\Models\sponsor::all();
          
          $users = \App\Models\User::orderBy('created_at','desc')->take(5)->get('username');
          $TotalEarnings = \App\Models\Profile::all()->sum('membership_type');
          $TotalW = \App\Models\widthdraw::all()->sum('AMOUNT');
          
         //dd("All Data To show is here, " ,$data3,$data5,$users,$dataToShow); 
                 
          $pool = \App\Models\Profile::where('affiliate_paid','1')->where('membership_type' , '1200')->get()->shuffle();
          
          $random = 117;
               
               

        return view('publicview.index', compact('dataToShow','data3','data5','users','TotalEarnings','TotalW','pool','data6','random'));  
    }
}
