<?php

namespace App\Http\Controllers;
use App\Models\widthdraw;
use Illuminate\Http\Request;

class AdminWithdrawController extends Controller
{
   
    
    public function index()
    {
         
        $user = auth()->user();
        $profile = $user->profile()->first();
           //dd($profile);
         $alldata = widthdraw::all()->where('STATUS','==',0);
         $alldataApproved =  widthdraw::all()->where('STATUS','!=',0);
         
         $Negative =  widthdraw::all()->where('STATUS','==',100)->sum('AMOUNT');
         
         
          $TDM5 =  \App\Models\DM5tree::all()->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->sum('balance')*0.8;
          $TSPN = \App\Models\sponsor::all()->sum('balance');
         
          
          //dd($FinalBalance);
         $FinalBalance = $TDM5+ $TDM3 +$TSPN - $Negative;
         
     
           return view('admin.WithdrawPanel',compact('alldata','user','alldataApproved','profile','TDM5','TSPN','TDM3','Negative','FinalBalance'));
    }
    
    
    public function Credited($id)
    {
        $with = widthdraw::find($id);
        $with['STATUS'] = 100;
        $with->save();
       return redirect('/ManageWithdrawal');
    }
    
    
     public function Cancel($id)
    {
        $with = widthdraw::find($id);
        $with['STATUS'] = 9;
        $with->save();
       return redirect('/ManageWithdrawal');
    }
}
