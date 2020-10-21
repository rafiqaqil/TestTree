<?php

namespace App\Http\Controllers;

use App\Models\widthdraw;
use Illuminate\Http\Request;

class WidthdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
          public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function CreateWidthdraw()
    {
        $user = auth()->user();
        $profile = $user->profile();
        return view('Widthdraw.createW', compact('profile','user'));
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreWidthdraw()
    {
        
         $data = request()->validate([

              'AMOUNT' => 'required',
              'Type' => 'required',
              
        ]);
         
        $user = auth()->user();
        $data['user_id'] = $user->id;
        //dd($data);
        widthdraw::create($data);
        
        $all = widthdraw::all();
        dd($all);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function MyWidthdraw()
    {
      
        
           $user = auth()->user();   $profile = $user->profile()->first();
           
           //dd($profile);
         $alldata = widthdraw::all()->where('user_id',$user->id);
         $alldataApproved =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',0);
         
         $Negative =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','==',100)->sum('AMOUNT');
         
         
          $TDM5 =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TSPN = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');
         
          
          //dd($FinalBalance);
         $FinalBalance = $TDM5+ $TDM3 +$TSPN - $Negative;
         
     
           return view('Widthdraw.myRecords',compact('alldata','user','alldataApproved','profile','TDM5','TSPN','TDM3','Negative','FinalBalance'));       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(widthdraw $widthdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, widthdraw $widthdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(widthdraw $widthdraw)
    {
        //
    }
}
