<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicViewController extends Controller
{
      public function index()
    {
          
           $dataToShow =  \Illuminate\Support\Facades\DB::table('users')
                   ->where('users.id','>=',6)
                   ->join('profiles','users.id','=','profiles.user_id')
                   ->select('country','username','profiles.id','profiles.name')->get();
           
          
          $data3 = \App\Models\DM3tree::all();
          $data5 = \App\Models\DM5tree::all();
          
          $users = \App\Models\User::all()->get('username');
          $TotalEarnings = \App\Models\Profile::all()->sum('membership_type');
          $TotalW = \App\Models\widthdraw::all()->sum('AMOUNT');
          
         //dd("All Data To show is here, " ,$data3,$data5,$users,$dataToShow); 
                 
         
               

        return view('publicview.index', compact('dataToShow','data3','data5','users','TotalEarnings','TotalW'));  
    }
}
