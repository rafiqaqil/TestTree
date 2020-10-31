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
         $user = auth()->user();   $profile = $user->profile()->first();
           
           //dd($profile);
         $alldata = widthdraw::all()->where('user_id',$user->id)->where('STATUS','=',0);
         $alldataApproved =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',0);
         
         $Negative =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
         
         
          $TDM5 =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TSPN = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');
         
          
          //dd($FinalBalance);
         $FinalBalance = $TDM5+ $TDM3 +$TSPN - $Negative;
         
        
        
        
        
        
        
        
         $data = request()->validate([

              'AMOUNT' => 'required|numeric',
              'Type' => 'required',
              
        ]);
        
        
        //-------------------------------------------------------------------------
         if($FinalBalance-$data['AMOUNT'] >= 0)
         {
        
         
        $user = auth()->user();
        $userProfile = \App\Models\Profile::find($user->id);
        
        //dd($userProfile);
        $data['Name'] = $userProfile->name;
        $data['Phone'] = $userProfile->phone;  
        $data['USDT'] = $userProfile->usdt_wallet;  
        $data['Merch'] = $userProfile->merchantrade_acc;  
            
        
        $data['user_id'] = $user->id;
       
        widthdraw::create($data);
        
        return redirect('/Show/MyWidthdraw');
         }
         else{
          return redirect('/Show/MyWidthdraw')->withErrors(['Not Enough Balance', 'Not Enough Balance']);
         }
        //dd($all);
        
         
       
       
    }
    
    public function Cancel($id)
        {
         $user = auth()->user();
         
            $with = widthdraw::find($id);
            
            //dd($with);
            if($user->id != $with->user_id)
                return redirect('/Show/MyWidthdraw');
            $with['STATUS'] = 9;
            $with->save();
           return redirect('/Show/MyWidthdraw');
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
         $alldata = widthdraw::all()->where('user_id',$user->id)->where('STATUS','=',0);
         $alldataApproved =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',0);
         
         $Negative =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
         
         
          $TDM5 =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.9;
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
